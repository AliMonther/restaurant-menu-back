<?php


namespace App\Actions;


class CreateToken
{
    public function execute($user){

        return $user->createToken('tasks-pr');

    }
}
