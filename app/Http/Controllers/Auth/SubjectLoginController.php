<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\SubjectMatter;

class SubjectLoginController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = '/sm/home';
    protected $redirectAfterLogout = '/sm/login';
    protected $guard = 'subject_matter';

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

    // login from for subject matter
    public function showLoginForm()
    {
        return view('auth.subject_matter.login_sm');
    }

    public function login(Request $request)
    {
 
        if (auth()->guard('subject_matter')->attempt(['username' => $request->username,'password' => $request->password])) {
            return redirect()->route('home.sm');
        }
        return back()->withErrors(['username' => 'username atau password salah.']);
    }
    public function logout(Request $request)
    {
        //dd(Auth::guard('subject_matter')->check());
        Auth::guard('subject_matter')->logout();
       //$this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('sm.login');
    }
}
