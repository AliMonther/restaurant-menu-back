<?php


namespace App\UseCases\User;


use App\Actions\AddMenu;
use App\Actions\AddUser;
use App\Actions\CreateToken;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends UserUseCase
{
    protected $menuRepo;

    public function __construct(UserRepository $userRepo , MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
        parent::__construct($userRepo);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data)
    {
        $data['password']=Hash::make($data['password']);

        $data['remember_token'] = Str::random(10);

        $menuName = $data['menu_name'];

        unset($data['menu_name']);

        $user = $this->userRepo->create($data);

        $token =(new CreateToken())->execute($user);;

         $this->menuRepo->create([
            'user_id' => $user->id,
            'name' => $menuName,
        ]);

        return [
            'user'=>$user,
            'token'=>$token,
        ];
    }
}
