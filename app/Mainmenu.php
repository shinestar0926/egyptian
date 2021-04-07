<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainmenu extends Model
{
    protected $fillable = [
        'categories_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id','id')->with('CategoryTranslation');

    }//end fo category

    public function CategoryTranslation()
    {
        return $this->belongsTo(CategoryTranslation::class,'categories_id','id');

    }//end fo category
    
}
