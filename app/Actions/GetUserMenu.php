<?php


namespace App\Actions;


use Illuminate\Support\Facades\Auth;

class GetUserMenu
{
    public static function execute(){
        return Auth::user()->menu;
    }
}
