<?php

namespace App\Http\Controllers\api\v1;

use App\User;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request) {
     
         $login =  $request->validate([
             'email'=>'required',
             'password'=>'required'
         ]);
            if(!Auth::attempt( $login )) {

                $data = ['error'=>'Invalid attempt.'];
                return response()->json($data, 401);
            }
            $appToken = Auth::user()->createToken('appToken')->accessToken;

            $data['data'] = [
                'auth' => Auth::user(),
                'token'=>$appToken
            ];

            return response()->json($data, 200);
    }


    public function me(Request $request) {
        $data['data'] = Auth::user();
        return response()->json($data, 200);

    }


    private function createAccount() {

    }

    public function register(Request $request) {

      
       // dd($request->all());
        $login =  $request->validate([
            'name'=>'required|min:5|max:15|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|max:15'
        ]);

        try {

            /** create user  */
            $user = User::create([
                'name'        => $request->name,
                'email'        => $request->email,
                'password'     => bcrypt($request->password)
            ]);
       
             $data = [
                 'message' => 'Account created',
                 'error'=> 0
             ];

             return response()->json($data, 200);


        }catch(Exception $e){
            Log::error('Error occurred whiles creating a message', [
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => 'Error creating account', 
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    public function logout(Request $request) {

        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['error'=>0,'message'=>'Successfully logged out'], 200);
        }
        
    }

    public function myprofile(Request $request) {

        $user = Auth::user();
        $user = User::with('accounts')->where('id',$user->id)->first();
        $data['data'] = $user;
        return response()->json($data, 200);
    }
    public function profiles(Request $request) {

        return response()->json([
            ['id'=>1,'name'=>'jon'],
            ['id'=>2,'name'=>'marry'],
            ['id'=>3,'name'=>'thomas'],
            ['id'=>4,'name'=>'jennifer'],
            ['id'=>5,'name'=>'anna'],
            ['id'=>6,'name'=>'simon'],
        ]);

    }
}
