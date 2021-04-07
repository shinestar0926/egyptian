<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = [
        'image','title','description'
    ];
}
