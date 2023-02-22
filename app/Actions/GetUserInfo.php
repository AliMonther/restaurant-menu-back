<?php


namespace App\Actions;


use App\Repositories\UserRepository;

class GetUserInfo
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function execute($data){
       return $this->userRepo->findAttributes(['email'=>$data['email']]);

    }
}
