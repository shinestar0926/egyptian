<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts_vedios extends Model
{
    protected $fillable = ['posts_id','vedios'];
    public function posts()
    {
        return $this->belongsTo(posts::class);

    }//end fo category
}
