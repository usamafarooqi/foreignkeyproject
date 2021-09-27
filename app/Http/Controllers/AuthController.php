<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function register(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }
    function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if (!$user||!Hash::check($request->password, $user->password)) {
            return response([
                "message"=>"credential not valid"
            ],404);
        }
        else {

        //     $token = $user->createToken('token')->plainTextToken;
        //     $cookie = Cookie("jwt",$token,60*24);
        //    return response( [
        //         'user' => "success",
            
        //     ])->withCookie($cookie);
        // }
        $token = JWTAuth::attempt($request->only("email","password"));
           $user = Auth::user();
           return ["user"=>$user,"token"=>$token];
     
        
    }
    function logout(){
        $cookie = Cookie::forget("jwt");
        return response([
            "message"=>"success",
        ])->withCookie($cookie);
    }
}

}