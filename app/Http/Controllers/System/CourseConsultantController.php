<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseConsultantController extends Controller
{
    //

    function dashboard(){
        return view('modules.course_consultant.dashboard');
    }
}
