<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description','product_id'];

    public function Product()
    {
        return $this->belongsTo(Product::class);

    }

    public function UserShopingCart()
    {
        return $this->hasMany(UserShopingCart::class,'product_id','product_id');

    }

}//end of model
