<?php
// CourseKraft Project - Michael Parent - COMP 370
// PreferencesController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TranscriptController;

class PreferencesController extends Controller
{  
    public function submit(Request $request)
    {
        $request->session()->put("transcript", $request->input());

        return(view ("preferences"));
        /*
        $preferedCourses = new TranscriptController();

        $preferedCourses->submit($request);
        */

    }


}