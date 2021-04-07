<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Client;
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
use App\Password_resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use App;
use App\Archives;
use App\Alerts;

class RegisterController extends Controller
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

        $this->middleware('guest:website')->except(['guard', 'logout', 'updatenewpass']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index(Request $request)
    {
        $title = 'Register';
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;
        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();

        return view('web.clients.register', compact('allmunes', 'categories','Archives'));
    } //end of inde


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    public function store(Request $request)
    {

        // dd($request);
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:clients',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            //'password_confirmation' => 'required_with:password|same:password',

             'terms' => 'required',


        ];
        // dd($rules);
        $request->validate($rules);
        $request_data = $request->all();


        Client::create([
            'first_name' => $request_data['first_name'],
            'last_name' => $request_data['last_name'],
            'email' => $request_data['email'],
            'password' => Hash::make($request_data['password']),
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('mediacare.login');
    }

    public function login(Request $request)
    {
        $title = 'Register';
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;
        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
        return view('web.clients.login', compact('allmunes', 'categories','Archives'));
    }

    public function postlogin(Request $request)
    {


        if (Auth::guard('website')->attempt(['email' => $request->email, 'password' => $request->password])) {
            //  dd(auth('website')->user());

            return redirect()->route('mediacare.index');
        } else {
            $error = "Email Or Password Is Wrong";


            return redirect()->route('mediacare.login')->with(['error' => $error]);
        }
    }





    public function resetpassword(Request $request)
    {
        $title = 'Register';
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;
        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();

        return view('web.clients.resetpassword', compact('allmunes', 'categories','Archives'));
    }


    public function forgetpassword(Request $request)
    {
        $user = DB::table('clients')->where('email', '=', $request->email)
            ->first();
        //   dd($user);
        //Check if the user exists
        if ($user != null) {
            if (count(array($user)) < 1) {
                return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
            }
            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);

            //Get the token just created above
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();

            if ($this->sendResetEmail($request->email, $tokenData->token) == null) {
                $error = "A reset link has been sent to your email address.";

                return redirect()->route('mediacare.resetpassword')->with(['error' => $error]);
            } else {
                $error = "A Network Error occurred. Please try again..";

                return redirect()->route('mediacare.resetpassword')->with(['error' => $error]);
            }
        } else {
            $error = "There Is No User For This Email.";
            return redirect()->route('mediacare.resetpassword')->with(['error' => $error]);
        }
    }


    public function sendResetEmail($user, $code)
    {

        $send =   Mail::send(
            'web.clients.linkreset',
            ['user' => $user, 'code' => $code],
            function ($message) use ($user) {
                $message->to($user);
                $message->subject("$user, reset your password .");
            }
        );
    }


    public function newpassword($code)
    {

        $email = Password_resets::where('token', $code)->first()->email;

        // dd($email);
        $title = 'new password';
        $anotherproducts = [];
        $title = 'Register';
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;
        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
        return view('web.clients.newpassword', compact('email', 'allmunes', 'categories','Archives'));
    } //end of newpassword


    public function updatenewpass(Request $request)
    {
        $rules = [

            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ];
        $request->validate($rules);
        $request_data = $request->all();

        $password = Hash::make($request_data['password']);

        Client::where('email', $request_data['email'])
            ->update(['password' => $password]);

        session()->flash('success', "Password updated Successfully ");
        return redirect()->route('mediacare.login');
    }
    public function guard()
    {
        return Auth::guard('website');
    }
    public function logout(Request $request)
    {
        //dd( $request);
        Auth::guard('website')->logout();
        return redirect()->route('mediacare.login');
    }
}
