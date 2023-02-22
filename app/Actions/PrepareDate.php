<?php


namespace App\Actions;


use Carbon\Carbon;

class PrepareDate
{
    public static function execute($date){
        return $date->toDateTimeString();
    }
}
