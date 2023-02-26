<?php


namespace App\Actions\DiscountCreator;

class CategoryDiscountCreator implements IDiscountCreator , IEnableDiscount
{

    protected $discountRepo;
    protected $discountValue;
    protected $category;

    public function __construct($data)
    {
        $this->category = $data['model'];
        $this->discountRepo = $data['discountRepository'];
        $this->discountValue = $data['discountValue'];
        $this->addDiscount();
    }

    public function addDiscount()
    {
            if($this->ableToAddDiscount(['category'=>$this->category])){
                return $this->discountRepo->create([
                    'value'=> $this->discountValue,
                    'discountable_type'=>get_class($this->category),
                    'discountable_id'=> $this->category->id,
                ]);

            }
            return null;

    }

    public function ableToAddDiscount($data){
        if(!$this->discountValue){
            $parent = $data['category']->parent;
            if($parent && $parent->discount){
                $this->discountValue = $parent->discount->value;
                return true;
            }
                $menu = $data['category']->menu;
                if($menu->discount){
                    $this->discountValue = $menu->discount->value;
                    return true;
                }
                return false;

        }
        return true;

    }
}
