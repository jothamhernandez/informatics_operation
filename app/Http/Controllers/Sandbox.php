<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class Sandbox extends Controller
{
    //
    function testing(Request $request){
        return response()->json(User::getPossibleRoles());
    }
}
