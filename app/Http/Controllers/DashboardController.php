<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $module = 'dashboard';
        return view('admin.dashboard', ['module'=>$module]);
    }
}
