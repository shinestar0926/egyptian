<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Contacts;
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
use App\Category;
use App\Mainmenu;
use App\Product;
use App\Archives;
use App\Client;


use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

use App;
use PDF;



class ProfileController  extends Controller
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

        $title = 'Profile ';
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;

        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
        return view('web.profile.profile', compact('allmunes', 'categories','Archives'));
      
      
         
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

            'image' => 'required',
        ];

        $request->validate($rules);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/clients/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }
        if (!empty($request_data['image'])) {
            $update = Client::where('id', $request->id)->update([
                'image' => $request_data['image'],

            ]);
        }


        return redirect()->route('mediacare.profile.index');
    }




    public function resetpassword(Request $request)
    {
        $title = 'Reset Password';
        if (isset(Auth::guard('website')->user()->id)) {
            $anotherproducts = UserShopingCart::where(array('client_id' => Auth::guard('website')->user()->id))->with('client')->with('category')->with('product')->with('ProductTranslation')->get();
            // DB::table('user_shoping_carts')->where('created_at','>=', date("Y-m-d H:i:s", strtotime("+2 hours")))->where('client_id',Auth::guard('website')->user()->id)->delete();
        } else {
            $anotherproducts = [];
        }
        $total_price2 = 0;
        $total_price = 0;
        return view('web.clients.resetpassword', compact('title', 'anotherproducts', 'total_price2', 'total_price'));
    }
    public function update_address(Request $request, $id)
    {
        $data['address'] = $request->address;
        $update = Client::where('id', $id)->update($data);

        if ($update == 1) {
            return "updated";
        } else {

            return "error";
        }
    }


    public function delete_image(Request $request)
    {

        $update = Client::where('id', $request->id)->update([
            'image' => null,

        ]);
        //  $update= Client::where('id',$request->id)->delete('image');
        if ($update == 1) {
            return "updated";
        } else {

            return "error";
        }
    }

    public function newpassword(Request $request)
    {

        $email2 = Client::where('id', $request->id)->first();
        $email = $email2->email;
        //  dd($email->email);
        $title = 'new password';
        $anotherproducts = [];
        $title = 'Profile ';
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;


        return view('web.clients.newpassword', compact('allmunes', 'categories'))->with('email', $email);

      
    } //end of newpassword



    public function confirmpass(Request $request)
    {
        $email = Auth::guard('website')->user()->email;
        if (Auth::guard('website')->attempt(['email' => $email, 'password' => $request->password])) {
            echo "true";
        } else {
            echo 'false';
        }
    }



  


    public function sendnetofyEmail($user)
    {

        $send =   Mail::send(
            'web.profile.physicalbancenotify',
            ['user' => $user],
            function ($message) use ($user) {
                $message->to($user);
                $message->subject("$user, Wallet transaction.");
            }
        );
    }
 

    





    public function sendEmail($user, $id)
    {
        $send =   Mail::send(
            'web.profile.confirmLink',
            ['user' => $user, 'id' => $id],
            function ($message) use ($user, $id) {
                $message->to($user);
                $message->subject("Wallet Money  .");
            }
        );
    }


  




    

    
}
