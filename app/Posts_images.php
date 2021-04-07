<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts_images extends Model
{

    protected $fillable = ['posts_id','image'];
    public function posts()
    {
        return $this->belongsTo(posts::class)->with('category');

    }//end fo category
}
