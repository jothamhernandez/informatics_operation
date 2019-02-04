<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    function dashboard(){
        return view('modules.admin.dashboard');
    }

    function center(){
        return view('modules.admin.center');
    }
}
