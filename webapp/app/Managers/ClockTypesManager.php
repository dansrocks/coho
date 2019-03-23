<?php

namespace App\Managers;

use App\Models\ClockType;

/**
 * Class ClockTypesManager
 *
 * @package App\Managers
 */
class ClockTypesManager
{
    /**
     * @return mixed
     */
    public function getTypes()
    {
        $types = [];
        foreach (ClockType::select('name')->get() as $type) {
            $types[] = $type->getAttribute('name');
        }

        return $types;
    }
}
