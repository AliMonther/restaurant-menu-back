<?php

namespace App\Http\Controllers;

use App\Constants\UserConstants;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Http\Resources\auth\UserResource;
use App\UseCases\User\Login;
use App\UseCases\User\Register;

class AuthController extends Controller
{


    public function register(RegisterRequest $request , Register $register){

        $result = $register->execute($request->all());

        return $this->success(new UserResource($result['user'],$result['token']),UserConstants::REGISTER_SUCCESSFULLY , 201);

    }


    public function login(LoginRequest $request , Login $login){

        $result = $login->execute($request->all());

        return $this->success(new UserResource($result['user'],$result['token']) ,UserConstants::Login_SUCCESSFULLY ,200);

    }

}
