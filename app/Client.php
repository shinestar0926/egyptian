<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

class Client  extends Authenticatable
{
    protected $guard = 'website';
    protected $table = 'clients';
    protected $fillable = [
        'first_name','last_name', 'email', 'password','image'
    ];

    protected $casts = [
        'phone' => 'array'
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get name attribute

    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders

  public function routeNotificationForNexmo(){
      return $this->phone;
  }



  public function Postscomments()
  {
      return $this->hasMany(Postscomments::class,'clients_id','id');

  }
  public function Replaycomments()
  {
      return $this->hasMany(Replaycomments::class,'clients_id','id');

  }
}//end of model
