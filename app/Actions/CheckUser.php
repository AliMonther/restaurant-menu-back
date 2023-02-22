<?php


namespace App\Actions;


use App\Constants\UserConstants;
use App\Repositories\UserRepository;

class CheckUser
{


    public function __construct()
    {

    }

    public function execute($data){

        if(auth()->attempt(['email'=>$data['email'] , 'password'=>$data['password']])){
            return true;

        }
        throw new \Exception(UserConstants::EMAIL_OR_PASSWORD_INCORRECT , '401');
    }

}
