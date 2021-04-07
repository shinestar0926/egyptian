<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model
{
    use Translatable; // 2. To add translation methods

    protected $guarded = ['id'];

    public $translatedAttributes = ['name', 'description'];
    protected $appends = ['image_path', 'profit_percent'];


    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);

    }//end of image path attribute

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        if($profit > 0){
            $profit_percent = $profit * 100 / $this->purchase_price;
        }else{
            $profit_percent = 1;
        }
        
        return number_format($profit_percent, 2);

    }//end of get profit attribute

    public function category()
    {
        return $this->belongsTo(Category::class)->with('CategoryTranslation');

    }//end fo category

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');

    }//end of orders*/


    

    public function ProductTranslation()
    {
        return $this->hasMany(ProductTranslation::class);

    }//end of products
    

    

}//end of model
