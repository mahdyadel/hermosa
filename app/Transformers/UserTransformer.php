<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'mobile'    => $user->mobile,
            'birthdate' => $user->birthdate,
            'country'      => [
                'id'   => $user->country->id,
                'name' => $user->country->name
            ],
            'city'      => [
                'id'   => $user->city->id,
                'name' => $user->city->name
            ]
        ];
    }
}
