<?php

namespace App\Http\Controllers\SubjectMatter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //

    public function index(){
        return view('sm.home_sm');
    }
}
