<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    use ApiResourceTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(request $request)
    {
        $credentials = request(['mobile', 'password']);
        $mobile=$request->mobile;
//$password=Hash::make(request('password'));

        if (! $token = auth('api')->attempt($credentials )) {
            return $this->apiResponse(null,'',500,'رقم الموبيل او الرقم السري خطأ',0);
            //return response()->json(['error' => 'Unauthorized'], 401);
        }
        $data['token'] =$token;
     $data['user']=  User::where(array('mobile'=>$mobile))->first();
     
     return $this->apiResponse($data,'',200,'success',0);
        //return $this->respondWithToken($token,$credentials);
    }

  public function loginwithouttoken()
    {
        $credentials = request(['mobile', 'password']);
        $token = auth('api')->attempt($credentials);
         return $this->respondWithToken($token,$credentials);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function register(Request $request)
    {
        
          
        $validator = Validator::make($request->all(), [
             'email' => 'required|unique:users',  
              'mobile' => 'required|unique:users',
         ]);
           

           if($validator->passes()){
             if (request('image')) {

            Image::make(request('image'))
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . request('image')->hashName()));

            $post['image'] = request('image')->hashName();
                }else{
                    $post['image'] = 'noimage';
                }
                        
        $create=User::create([
            'first_name'=>request('name'),
            'email'=>request('email'),
             'fame'=>request('fame'),
            'mobile'=>request('mobile'),
            'city'=>request('city'),
            'governorate'=>request('governorate'),
            'password'=>Hash::make(request('password')),
            'image'=>$post['image'],
        ]);
        
     
      Session::put('user_id',$create->id);
            return $this->login(request());
           }else{
            
            return $this->apiResponse(null,'',500,'برجاء مراجعه البيانات المدخله مع التاكد ان الايميل او الموبيل غير مسجلين من قبل',0);
           }

     //  return $this->apiResponse(request('mobile'),200);
          
    
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }
    public function payload()
    {
        return $this->respondWithToken(auth('api')->payload());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$data='')
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
           // 'expires_in'   => auth('api')->factory()->getTTL() * 60,
             'data' => $data,
             'itemsCount' => 0,
             'success' => 'true',
             'statusCode' => 200,
             'message' => 'Login Successful',


        ]);
    }
}
