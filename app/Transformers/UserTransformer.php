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
            'displayName' => $user->displayName,
            'firstName' => $user->firstName,
            'lastName' => $user->lastName,
            'middleName' => $user->middleName,
            'title' => $user->title,
            'cityPhone' => $user->cityPhone,
            'localPhone' => $user->localPhone,
            'mobilePhone' => $user->mobilePhone,
            'department' => $user->department,
            'office' => $user->office,
            'mail' => $user->mail,
            'externalMail' => $user->externalMail,
            'enabled' => $user->enabled
        ];
    }
}
