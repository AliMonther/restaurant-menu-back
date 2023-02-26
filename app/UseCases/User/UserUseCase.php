<?php


namespace App\UseCases\User;


use App\Repositories\DiscountRepository;
use App\Repositories\UserRepository;
use App\UseCases\BaseUseCase;

abstract class UserUseCase extends BaseUseCase
{

    protected $userRepo;
    protected $discountRepo;

    public function __construct(UserRepository $userRepo , DiscountRepository $discountRepo)
    {

        $this->userRepo = $userRepo;
        $this->discountRepo = $discountRepo;
    }

}
