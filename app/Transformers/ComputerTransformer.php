<?php

namespace App\Transformers;

use App\Models\Ad\Computer;
use League\Fractal\TransformerAbstract;

class ComputerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Computer $computer
     * @return array
     */
    public function transform(Computer $computer)
    {
        return [
            'name' => $computer->name,
            'lastLoggedOnUserAccount' => $computer->lastLoggedOnUserAccount
        ];
    }
}
