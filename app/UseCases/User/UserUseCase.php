<?php


namespace App\UseCases\User;


use App\Repositories\UserRepository;
use App\UseCases\BaseUseCase;

abstract class UserUseCase extends BaseUseCase
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {

        $this->userRepo = $userRepo;
    }

}
