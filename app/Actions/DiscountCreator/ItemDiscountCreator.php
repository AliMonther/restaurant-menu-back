<?php


namespace App\Actions\DiscountCreator;


class ItemDiscountCreator implements IDiscountCreator , IEnableDiscount
{
    protected $discountRepo;
    protected $discountValue;
    protected $item;
    protected $categories;


    public function __construct($data)
    {

        $this->item = $data['model'];
        $this->discountRepo = $data['discountRepository'];
        $this->discountValue = $data['discountValue'];
        $this->categories = $data['categories'];
        $this->addDiscount();
    }

    public function addDiscount()
    {
        if($this->ableToAddDiscount(['item'=>$this->item , 'categories'=>$this->categories , 'repo'=>$this->discountRepo])){

            return $this->discountRepo->create([
                'value'=> $this->discountValue,
                'discountable_type'=>get_class($this->item),
                'discountable_id'=> $this->item->id,
            ]);

        }
        return null;
    }

    public function ableToAddDiscount($data)
    {

        if(!$this->discountValue){

                $categoriesIds = $data['categories'];
                $itemCategoriesDiscounts = $data['repo']->getCategoriesDiscounts($categoriesIds);
                if($itemCategoriesDiscounts){
                    $this->discountValue = min($itemCategoriesDiscounts);
                    return true;
                }
                return false;
        }
        return true;
    }
}
