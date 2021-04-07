<?php

namespace App\Http\Controllers\Dashboard;

use App\Alerts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $clients = Alerts::when($request->search, function($q) use ($request){

            return $q->where('email', 'like', '%' . $request->search . '%');

        })->latest()->paginate(8);

        return view('dashboard.subscription.index', compact('clients'));

    }//end of index

  
  

    public function destroy( $id)
    {
       
        Alerts::where('id',$id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.subscription.index');

    }//end of destroy
    public function contact_mail(Request $request)
    {
              // dd($request);

                if ($this->sendResetEmail($request->email, $request->content,$request->subject) == null) {
                      $error="Email has been sent to your email address.";
                      return $error;
                     // return redirect()->route('fakka.resetpassword')->with( ['error' => $error] );
                } else {
                    $error="A Network Error occurred. Please try again..";
                    return $error;
                   // return redirect()->route('fakka.resetpassword')->with( ['error' => $error] );
                  
                }
            }


    


        public function sendResetEmail($user,$content,$subject){
           
         $send =   Mail::send(
                'dashboard.Contacts.content',
                ['user'=>$user,'content'=>$content,'subject'=>$subject],
                function($message) use ($user,$subject){
                    
                    $message->to($user);
                    $message->subject("$subject");

                }
            );



        }
}//end of controller
