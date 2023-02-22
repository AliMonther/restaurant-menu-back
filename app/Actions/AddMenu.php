<?php


namespace App\Actions;


use App\Repositories\MenuRepository;
use function Termwind\ValueObjects\p;

class AddMenu
{

    protected $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    public function execute($userInfo , $data){

        return $this->menuRepo->create([
            'user_id' => $userInfo->id,
            'name' => $data['menu_name'],
        ]);
    }
}
