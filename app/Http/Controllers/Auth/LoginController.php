<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'txt_username' => 'required|exists:users,username',
            'txt_password' => 'required',
        ],[
            'txt_username.required'=> 'Username is required', 
            'txt_username.exists'=> 'Wrong Credentials',
            'txt_password.required'=> 'Password is required'
        ]);
        $checkData = array(
            'username' => $credentials["txt_username"],
            'password' => $credentials["txt_password"]
        );

        $check = Auth::attempt($checkData);
        if (!$check) {
            $error = "Wrong Credentials";
            return redirect('login')->with('login_error', $error);
        }

        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
