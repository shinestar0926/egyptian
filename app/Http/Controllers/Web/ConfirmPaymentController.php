<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Contacts;
use App\UserShopingCart;
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
use App\clients_payments;
use App\Password_resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use App;
use App\Cart;

class ConfirmPaymentController extends Controller
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
       
        $title = 'Confirm Payment';
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $anotherproducts = UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
        $totalQty=0;
       foreach ($anotherproducts as $row) {
        $totalQty += $row['qty'];
       }
       $total_price2=0;
       $total_price=0;



      return view('web.confirm payment.confirm_payment',['title'=>$title,'anotherproducts'=>$anotherproducts,'totalQty'=>$totalQty,'total_price2'=>$total_price2,'total_price'=>$total_price]);

    } //end of inde





    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    public function store(Request $request)
    {
        $rules = [
            'iban' => 'required',
        ];


        $request->validate($rules);
        $request_data = $request->all();
        $data2['client_name'] =Auth::guard('website')->user()->first_name ." " .Auth::guard('website')->user()->last_name;
        $data2['client_email'] =Auth::guard('website')->user()->email;
        $data2['totalQty'] =$request_data['totalQty'];
        $data2['total_price'] =$request_data['total_price'];
        $data['orderpayment_id']=DB::table('order_payments')->insertGetId($data2);

        for ($i = 0; $i < count($request_data['product_qty']); $i++) {
            $data['product_qty'] = $request_data['product_qty'][$i];
            $data['product_weight'] = $request_data['product_weight'][$i];
            $data['product_id'] = $request_data['product_id'][$i];
            $data['ingot_id']=$request_data['ingot_id'][$i];
            $data['price_per_gram'] = $request_data['price_per_gram'][$i];
            $data['category_name'] = $request_data['category_name'][$i];
            $data['product_name'] = $request_data['product_name'][$i];

            $data['total_price'] =$request_data['total_price'];
            $data['shipping_address'] =$request_data['shipping_address'];
            $data['totalQty'] =$request_data['totalQty'];
            $data['iban'] =$request_data['iban'];
            $data['delivery_type'] =$request_data['delivery_type'];
            $data['client_phone'] =Auth::guard('website')->user()->phone;
            $data['client_email'] =Auth::guard('website')->user()->email;
            $data['client_name'] =Auth::guard('website')->user()->first_name ." " .Auth::guard('website')->user()->last_name;
            $data['client_id'] =Auth::guard('website')->user()->id;
           $data['paid_at'] =date("d-m-Y H:i:s");

            DB::table('clients_payments')->insertGetId($data);

        ///////////////////points///////////////////
        $points['client_id']=Auth::guard('website')->user()->id;
        $points['client_name']=Auth::guard('website')->user()->first_name . '' . Auth::guard('website')->user()->last_name ;
        $points['client_phone']=Auth::guard('website')->user()->phone;
        $points['client_email']=Auth::guard('website')->user()->email;
        $points['created_at']=date('Y-m-d H:i:s');
        $points['points']= $request->totalQty * $request_data['product_weight'][$i] * 1000;
        $points['totalpoints']=$points['points'] + DB::table('clients_points')->where(array('client_id'=>Auth::guard('website')->user()->id))->sum('points');
        DB::table('clients_points')->insertGetId($points);
        //////////////////////////////////////////////
            }



            $delete=  UserShopingCart::where(array('client_id'=>Auth::guard('website')->user()->id))->delete();

            if ($this->sendEmail(Auth::guard('website')->user()->email) == null) {

               session()->flash('success',"Paymenten Is Confirmed And Message sent To your Email.");

                return redirect()->route('fakka.index');

            } else {
              $error = "A Network Error occurred. Please try again..";

              return redirect()->route('fakka.index')->with(['error' => $error]);
            }


    }

    public function sendEmail($user)
    {

        $send =   Mail::send(
            'web.confirm payment.linkreset',
            ['user' => $user],
            function ($message) use ($user) {
                $message->to($user);
                $message->subject("$user, confirmation .");
            }
        );
    }

    public function  getRemoveItem($id)
    {

        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) >0){
            session()->put('cart',$cart);
        }else{
            session()->forget('cart',$cart);
        }

        return redirect()->route('fakka.confirm_payment.index');

    }







}
