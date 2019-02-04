<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CenterManagerController extends Controller
{
    //
    public function dashboard(){
        return view('modules.center_manager.dashboard');
    }
}
