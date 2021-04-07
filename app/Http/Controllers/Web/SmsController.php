<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public function sendMessage(Request $request)
    {
        //  dd($request->phone);
        //$numbers = range(1, 4);

        ///save random number with phone in db
        /* Nexmo::message()->send([
            'to'   => '+20'.$request->phone,
            'from' => '+201099922302',
            'text' => 'sms from laravel.'
        ]);*/

        echo $request->phone;
    }
}
