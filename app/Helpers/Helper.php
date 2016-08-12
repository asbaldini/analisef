<?php

namespace AnaliseF\Helpers;
use AnaliseF\User;

/**
 * Created by PhpStorm.
 * User: joca
 * Date: 11/08/16
 * Time: 22:37
 */
class Helper
{

    public static function getComboEngineers()
    {
        $userModel = new User();
        $combo_engineers = $userModel
            ->where('role', '=', 'engineer')
            ->where('status', '=', 1)
            ->pluck('name', 'id')
            ->toArray();

        return $combo_engineers;
    }
}