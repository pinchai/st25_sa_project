<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $module = 'user';
        return view('admin.user', ['module'=>$module]);
    }

    public function getUser(Request $request){
        $data = DB::table('users')
            ->select('*')
            ->get();

        return response()->json($data);
    }

    public function addUser(Request $request){
        $data = DB::table('users')
            ->insert(
                [
                    'name'=>$request->username,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                ]
            );

        return response()->json($data);
    }

    public function deleteUser(Request $request){
        $user = DB::table('users')
            ->where('id', $request->id)
            ->delete();
        return response()->json(
            [
                'status'=>'delete successfully'
            ]
        );
    }

    public function editUser(Request $request){
        $user = DB::table('users')
            ->where('id', $request->id)
            ->update(
                [
                    'name'=>$request->username,
                    'email'=>$request->email,
                    // 'role'=>$request->role
                ]
            );
        return response()->json(
            ['status'=>'update success']
        );
    }
}
