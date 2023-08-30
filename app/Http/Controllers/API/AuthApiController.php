<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
        ]);
        $user = user::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=> bcrypt($data['password']),
        ]);
        $token = $user->createToken("myToken")->plainTextToken ;
        $response =[
            "message"=> "welcome new user",
            "user"=> $user,
            "token"=>  $token,
        ];
        return response($response ,200);
    }

    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
          $user = User::where("email",'=',$data['email'])->first();
          if(!$user || !Hash::check($data['password'] , $user->password)){
            return response("please enter right email or password");
          }

        $token = $user->createToken("myToken")->plainTextToken ;
        $response =[
            "message"=> "welcome login user ",
            "user"=> $user,
            "token"=>  $token,
        ];
        return response($response ,200);
    }
    
    public function logout(){
        // auth()->user()->tokens()->delete();
        return[
            "message" =>"Delete done",
        ];
    }
}
