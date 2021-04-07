<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

class Contacts  extends Model
{
   
    protected $fillable = [
        'name','email', 'message'
    ];

 

 
}//end of model
