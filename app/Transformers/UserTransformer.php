<?php

namespace App\Transformers;

use App\Models\Ad\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'account' => $user->account,
            'name' => $user->name,
        ];
    }
}
