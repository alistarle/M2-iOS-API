<?php

namespace App\Transformers;

use App\Models\Session;
use League\Fractal\TransformerAbstract;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class SessionTransformer extends TransformerAbstract
{

    const status = [
        "CREATED", "PENDING", "VALIDATED", "BEGINNED", "FINISHED"
    ];

    /**
     * A Fractal transformer.
     *
     * @param Session $session
     * @return array
     */
    public function transform(Session $session) : array
    {
        $data = [
            "id" => $session->id,
            "distance" => $session->distance,
            "departure" => $session->departure,
            "arrival" => $session->arrival,
            "sessionDate" => $session->sessionDate,
            "begin" => $session->begin,
            "end" => $session->end,
            "rate" => $session->rate,
            "description" => $session->description,
            "status" => self::status[$session->status],
            "creator_id" => $session->creator_id
        ];

        if($session->monitor)
            $data["monitor"] = Fractal::create()->item($session->monitor->user, new UserTransformer())->serializeWith(new ArraySerializer())->toArray()["data"];

        if($session->student)
            $data["student"] = Fractal::create()->item($session->student->user, new UserTransformer())->serializeWith(new ArraySerializer())->toArray()["data"];

        return $data;
    }
}
