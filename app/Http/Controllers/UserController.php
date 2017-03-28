<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Monitor;
use App\Models\Rate;
use App\Models\Student;
use App\Transformers\SessionTransformer;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Fractalistic\ArraySerializer;

/**
 * @resource User Routes
 *
 * Routes who describes all user interaction, like registering, display profile, edit profile and rate profile
 */
class UserController extends Controller
{
    /**
     * Get Profile
     *
     * Return profile of the currently logged in user, otherwise the user given in parameters
     *
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function profile(Request $request, User $user)
    {
        $user = ($user->id) ? $user : $request->user();
        return fractal($user, new UserTransformer())->serializeWith(new ArraySerializer())->respond();
    }

    /**
     * Update User Profile
     *
     * Update the currently logged in user profile, ability to update custom field for monitor or student
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update(UserRequest $request)
    {
        $user = $request->user();
        $user->update($request->all());
        if($request->password)
            $user->password = bcrypt($request->password);

        if($user->role instanceof Monitor)
            $user->role->update($request->all());

        $user->save();
        return fractal($user, new UserTransformer())->serializeWith(new ArraySerializer())->respond();
    }

    /**
     * Create User
     *
     * Create a new User ( Monitor or Student )
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function register(UserRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        if(!$user->avatar)
            $user->avatarUrl = env("APP_URL")."/img/default_avatar.png";

        $role = ($request->role == "monitor") ? new Monitor : new Student ;

        $role->save();

        $user->role()->associate($role);
        $user->save();
        return fractal($user, new UserTransformer())->serializeWith(new ArraySerializer())->respond();
    }

    /**
     * Get User History
     *
     * Return detailed list of session of the given user
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function board(Request $request, User $user)
    {
        $user = ($user->id) ? $user : $request->user();

        if($user->id != $request->user()->id && !$request->user()->role instanceof Monitor)
            return new JsonResponse("Vous devez être moniteur pour consulter un historique", 401);
        if($user->id != $request->user()->id && $user->role instanceof Monitor)
            return new JsonResponse("Vous ne pouvez pas consulter l'historique d'un autre moniteur", 401);

        return fractal()->collection($user->role->sessions)->transformWith(new SessionTransformer())->serializeWith(new ArraySerializer())->toArray();
    }

    /**
     * Rate Monitor
     *
     * Rate the given user with the mark passed in parameters, note that the user must be a monitor
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function rate(Request $request, User $user)
    {
        if($user->id == $request->user()->id)
            return new JsonResponse("Vous ne pouvez pas vous noter vous-meme", 401);
        if(!$user->role instanceof Monitor)
            return new JsonResponse("Vous ne pouvez noter qu'un moniteur", 422);
        if(!$request->has("mark") || $request->get("mark") > 5 || $request->get("mark") < 0)
            return new JsonResponse("Valeur de notation invalide", 422);

        $rate = $user->role->rates()->where('student_id',$request->user()->role->id)->first();
        if($rate)
            $rate->update(["rate" => $request->get("mark")]);
        else
            $user->role->rates()->save(new Rate(["rate" => $request->get("mark"), "student_id", $request->user()->role->id]));
    }
}
