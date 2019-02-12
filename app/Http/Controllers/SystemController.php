<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    //
    public function forgotPassword(){
        return view('pages/forgotpass');
    }
}
