<?php


namespace App\UseCases\User;


use App\Actions\CheckUser;
use App\Actions\CreateToken;
use App\Actions\GetUserInfo;
use App\Constants\UserConstants;
use App\UseCases\BaseUseCase;

class Login extends UserUseCase
{

    public function execute($data){

             (new CheckUser())->execute($data);

            $user =  $this->userRepo->findAttributes(['email'=>$data['email']]);
            $token =  (new CreateToken())->execute($user);
            return [
                'user'=>$user,
                'token'=>$token,
            ];

    }
}
