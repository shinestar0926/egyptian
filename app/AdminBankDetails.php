<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminBankDetails extends Model
{
    protected $fillable = [
        'iban','bank_name', 
    ];
}
