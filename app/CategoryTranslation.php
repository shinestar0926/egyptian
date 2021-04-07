<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];


    public function Category()
    {
        return $this->belongsTo(Category::class);

    }

    

    

}//end of model
