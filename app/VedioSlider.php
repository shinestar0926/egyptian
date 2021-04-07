<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VedioSlider extends Model
{
    protected $fillable = ['posts_id'];
    public function posts()
    {
        return $this->belongsTo(posts::class);

    }//end fo posts
}
