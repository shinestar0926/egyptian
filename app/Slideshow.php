<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{

    protected $fillable = ['posts_id'];
    public function posts()
    {
        return $this->belongsTo(posts::class)->with('category');;

    }//end fo posts
}
