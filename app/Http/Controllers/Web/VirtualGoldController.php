<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Contacts;
use App\VirtualDetails;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Password_resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Password;
use App;

class VirtualGoldController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //  protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index(Request $request)
    {
        $title = 'Virtual Gold';

        $anotherproducts=[];
        return view('web.virtual gold.virtual_gold', compact('title','anotherproducts'));
    } //end of inde




    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    public function store(Request $request)
    {

        // dd($request);

    }

    public function Virtualdetails(Request $request)
    {
        $post['total_quantity']=$request->quantity;
        $post['total_quantity2'] =$request->quantity;
        $post['client_id']=Auth::guard('website')->user()->id;
        $post['client_name']=$request->fullname;
        $post['Phone']=$request->Phone;
        $post['email']=$request->email;
        $post['quantity']=$request->quantity;
        $post['price']=$request->price;

        $post['recet_no'] = rand(1, 9999999);
        $post['certificate_no'] = rand(1, 7456995);
        $post['created_at'] =date('Y-m-d H:i:s');  
        $post['added_at'] =date('Y-m-d  0:0:0');  

        $quantitys= VirtualDetails::where(array('client_id'=>Auth::guard('website')->user()->id,'deleted'=>0))->get();
        if ($quantitys !=null) {
            foreach ($quantitys as $quantity) {
                $post['total_quantity'] +=$quantity->quantity;
                if(!empty($quantity->total_quantity2 )){
                $post['total_quantity2']=$quantity->total_quantity2 + $request->quantity ;
                }else{
                    $post['total_quantity2'] +=$quantity->quantity;
                }
            }
        }else{
            $post['total_quantity'] =$request->quantity;
            $post['total_quantity2'] =$request->quantity;
        }
       // $post['created_at']=$request->price;

        $id=DB::table('virtual_details')->insertGetId($post);
        $this->sendconfirmEmail($post['email'],$id);

        ///////////////////points///////////////////
        $points['client_id']=Auth::guard('website')->user()->id;
        $points['client_name']=Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name ;
        $points['client_phone']=Auth::guard('website')->user()->phone;
        $points['client_email']=Auth::guard('website')->user()->email;
       $points['created_at']=date('Y-m-d H:i:s'); 
        $points['points']= $request->quantity * 1000;
        $points['totalpoints'] = $points['points'] + DB::table('clients_points')->where(array('client_id' => Auth::guard('website')->user()->id))->sum('points');

        DB::table('clients_points')->insertGetId($points);
        //////////////////////////////////////////////
        echo $id;

    }
    public function sendconfirmEmail($user, $id)
    {

        $recet_no= VirtualDetails::where(array('id'=>$id))->first('recet_no');
        $send =   Mail::send(
            'web.virtual gold.confirmLink',
            ['user' => $user, 'recet_no' => $recet_no],
            function ($message) use ($user, $recet_no) {
                $message->to($user);
                $message->subject("Recet Number .");
            }
        );
    }

    public function getVirtualdetails(Request $request)
    {
        $VirtualDetails = VirtualDetails::where(array('id'=>$request->id))->first();
        echo( $VirtualDetails);
    }
    public function Virtualpaynow(Request $request)
    {
        $data['iban']=$request->iban;
        $data['paid']=1;
        $update= VirtualDetails::where(array('id'=>$request->id))->update($data);
       $price= VirtualDetails::where(array('id'=>$request->id))->first()->price;
        echo( $price);
    }














}
