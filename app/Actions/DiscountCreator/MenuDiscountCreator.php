<?php


namespace App\Actions\DiscountCreator;



class MenuDiscountCreator implements IDiscountCreator
{

    protected $discountRepo;
    protected $discountValue;
    protected $menu;

    public function __construct($data)
    {
        $this->menu = $data['model'];
        $this->discountRepo = $data['discountRepository'];
        $this->discountValue = $data['discountValue'];

        $this->addDiscount();
    }

    public function addDiscount()
    {
        if($this->discountValue){

        return $this->discountRepo->create([
                'value'=> $this->discountValue,
                'discountable_type'=> get_class($this->menu),
                'discountable_id'=> $this->menu->id,
            ]);

        }

        return null;
    }
}
