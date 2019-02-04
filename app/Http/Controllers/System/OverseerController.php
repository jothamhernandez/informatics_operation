<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OverseerController extends Controller
{
    //

    function dashboard(){
        return view('modules.overseer.dashboard');
    }
}
