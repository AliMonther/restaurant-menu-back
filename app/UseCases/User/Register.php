<?php


namespace App\UseCases\User;


use App\Actions\AddMenu;
use App\Actions\AddUser;
use App\Actions\CreateToken;
use App\Repositories\DiscountRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use App\UseCases\BaseUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Actions\DiscountCreator\DiscountCreatorFactory;

class Register extends UserUseCase
{
    protected $menuRepo;

    public function __construct(UserRepository $userRepo , DiscountRepository $discountRepo , MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
        parent::__construct($userRepo , $discountRepo);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data)
    {
        DB::beginTransaction();
        try{

            $data['password']=Hash::make($data['password']);

            $data['remember_token'] = Str::random(10);

            $menuName = $data['menu_name'];

            unset($data['menu_name']);

            $user = $this->userRepo->create($data);

            $token =(new CreateToken())->execute($user);;

            $menu = $this->menuRepo->create([
                'user_id' => $user->id,
                'name' => $menuName,
            ]);

            $factory = new DiscountCreatorFactory();

            $discount = isset($data['menu_discount']) ? $data['menu_discount'] : null;

            $factoryData = [
                'discountType'=>'menu',
                'model'=>$menu,
                'discountValue'=>$discount,
                'discountRepository'=>$this->discountRepo,
            ];

            $factory->create($factoryData);

            DB::commit();
            return [
                'user'=>$user,
                'token'=>$token,
            ];
        }
        catch (\Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage(),500);
        }

    }
}
