<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('admin.login');
    }

    public function doLogin(Request $request){
        $check = $request->only('name', 'password');
        if (Auth::attempt($check)){
            //
            return redirect('/admin/dashboard');
        }else{
            return redirect('/login');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }

}
