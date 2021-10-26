<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 08.09.2021
 * Time: 23:42
 */

namespace App\Helper;


class Helper
{
    public static function Result($value) {
        return $value ?  response()->json(['success' => trans('Validation.success'),]): response()->json(['error' =>  trans('Validation.error')]);
    }
    public static function Result_bool($value):bool {
        return $value ?  true:false;
    }
    public static function Result_exist($value) {
        return $value ?  $value :false;
    }
}