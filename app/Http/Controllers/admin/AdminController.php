<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // go to admin login page 
    public function loginPage()
    {
        return view('auth.adminlogin');
    }
    // go to admin home page 
    public function index()
    {
        return view('adminHome');
    }

    // login function 
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(Auth::guard('admins')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,

        ])){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.loginPage');

        }    

    }

}
