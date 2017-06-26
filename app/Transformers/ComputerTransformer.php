<?php

namespace App\Transformers;

use App\Models\Computer;
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
            'name' => $computer->getName(),
            'lastLoggedOnUserAccount' => $computer->getLastLoggedOnUserAccount()
        ];
    }
}
