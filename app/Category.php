<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Category extends Model
{
    use Translatable; // 2. To add translation methods

    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products

    public function CategoryTranslation()
    {
        return $this->hasMany(CategoryTranslation::class);

    }//end of products

    public function UserShopingCart()
    {
        return $this->hasMany(UserShopingCart::class,'category_id','id');

    }

    public function Mainmenu()
    {
        return $this->hasMany(Mainmenu::class,'categories_id','id');

    }//end of Mainmenu

   
  
    public function posts()
    {
        return $this->hasMany(posts::class);

    }//end of products

    public function Importantselectionposts()
    {
        return $this->hasMany(Importantselectionposts::class,'categories_id','id');

    }//end of Mainmenu




}//end of model
