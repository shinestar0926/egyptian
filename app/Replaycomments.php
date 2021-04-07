<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replaycomments extends Model
{
    protected $fillable = [
        'postscomments_id','replaytext','clients_id','approve',
    ];

    public function Postscomments()
    {
        return $this->belongsTo(Postscomments::class,'postscomments_id','id')->with('posts');

    }
    public function Client()
    {
        return $this->belongsTo(Client::class,'clients_id','id');

    }
}
