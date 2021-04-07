<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postscomments extends Model
{
    protected $fillable = [
        'posts_id','clients_id','comment','approve'
    ];

    public function posts()
    {
        return $this->belongsTo(posts::class);

    }
    public function Client()
    {
        return $this->belongsTo(Client::class,'clients_id','id');

    }

    public function Replaycomments()
    {
        return $this->hasMany(Replaycomments::class,'postscomments_id','id')->where('approve',1)->with('Client');

    }

}
