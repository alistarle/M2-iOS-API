<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Models\Monitor;
use App\Models\Session;
use App\Models\Student;
use App\Transformers\SessionTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Fractalistic\Fractal;

/**
 * @resource Session
 *
 * Longer description
 */
class SessionController extends Controller
{
    /**
     * Create a new session
     *
     * @param SessionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(SessionRequest $request)
    {
        $session = new Session($request->all());
        $session->status = 0;
        $session->user()->associate($request->user());
        $request->user()->role->sessions()->save($session);
        return fractal($session, new SessionTransformer())->respond();
    }

    /**
     * If no parameters => Return list of potential matching
     * If match query parameter => Return amount of matching sessions
     * If unmatch query parameter => Return amount of matching sessions
     *
     * @param Request $request
     * @param Session $session
     * @return array
     */
    public function match(Request $request, Session $session)
    {
        //Check query string parameter to create or not arrays of result
        $matchingAmount = $request->matching;
        $unmatchingAmount = $request->unmatching;
        $data["matching"] = Session::addSelect(DB::raw("st_distance(departure,POINT(".$session->departure.")) as distance"))
                                ->role($request->user())
                                ->statusCreated()
                                ->where("id","!=", $session->id)
                                ->distance($request->user()->range_km, $session->departure)
                                ->price($request->user()->price)
                                ->orderBy('distance')
                                ->limit($matchingAmount)
                                ->get();
        $data["unmatching"] = Session::addSelect(DB::raw("st_distance(departure,POINT(".$session->departure.")) as distance"))
                                ->role($request->user())
                                ->statusCreated()
                                ->where("id","!=", $session->id)
                                ->whereNotIn("id",$data["matching"]->pluck("id"))
                                ->orderBy('distance')
                                ->limit($unmatchingAmount)
                                ->get();

        return [
            "matching" => Fractal::create()->collection($data["matching"], new SessionTransformer())->toArray()["data"],
            "unmatching" => Fractal::create()->collection($data["unmatching"], new SessionTransformer())->toArray()["data"]
        ];
    }

    /**
     * Update the given session ( state, description, participants, etc...)
     *
     * @param SessionRequest $request
     * @param Session $session
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SessionRequest $request, Session $session)
    {
        //if passing from CREATED to PENDING
        if($session->status == 0) {
            if($request->user()->role instanceof Monitor) {
                if ($session->monitor)
                    return new JsonResponse("Cette session possède déjà un moniteur", 401);
                $session->monitor()->associate($request->user()->role);
            } else {
                if ($session->student)
                    return new JsonResponse("Cette session possède déjà un élève", 401);
                $session->student()->associate($request->user()->role);
            }
            Session::find($request->session_id)->delete();
        }

        //if passing from PENDING to VALIDATED
        if($session->status == 1) {
            if ($request->user()->id != $session->creator_id)
                return new JsonResponse("Seul le créateur de la séance peut valider la requète", 401);
        }

        //if passing from VALIDATED to BEGINNED or FINISHED
        if($session->status >= 2)
            if(!$request->user()->role instanceof Monitor)
                return new JsonResponse("Vous devez être moniteur pour commencer ou terminer une séance", 401);

        $session->update($request->all());

        if($session->status == 1 && $request->cancel) {
            if($session->monitor->user->id == $session->creator_id) //If the monitor is the creator
                $session->student()->associate(null); //Let's remove the student
            else
                $session->monitor()->associate(null);
            $session->status = $session->status - 1;
        } else {
            $session->status = $session->status + 1;
        }
        $session->save();
        $session->setRelations([]);
        return fractal($session, new SessionTransformer())->respond();
    }
}
