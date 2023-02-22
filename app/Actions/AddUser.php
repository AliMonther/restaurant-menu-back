<?php


namespace App\Actions;


use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddUser
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function execute($data){

        $data['password']=Hash::make($data['password']);

        $data['remember_token'] = Str::random(10);

        $user = $this->userRepo->create($data);

        $token =(new CreateToken())->execute($user);

        return [
            'user'=>$user,
            'token'=>$token,
        ];
    }

}
