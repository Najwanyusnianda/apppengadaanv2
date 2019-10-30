<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class SmLoginController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = '/teacher/home';


    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }
    /**

     */
    public function guard()
    {
     return Auth::guard('subject_matter');
    }

    // login from for teacher
    public function showLoginForm()
    {
        return view('auth.subject_matter.login_sm');
    }
}
