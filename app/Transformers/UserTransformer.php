<?php

namespace App\Transformers;

use App\Models\Monitor;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user) : array
    {
        $data = [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "phone" => $user->phone,
            "address" => $user->address,
            "city" => $user->city,
            "cp" => $user->cp,
            "avatarUrl" => $user->avatarUrl,
            "rang_km" => $user->range_km,
            "price" => $user->price
        ];

        if($user->role instanceof Monitor)
        {
            $data["type"] = "monitor";
            $data["vehicule"] = [
                "brand" => $user->role->vehiculeBrand,
                "model" => $user->role->vehiculeModel,
                "year" => $user->role->vehiculeYear
            ];
        } else {
            $data["type"] = "student";
        }

        return $data;
    }
}
