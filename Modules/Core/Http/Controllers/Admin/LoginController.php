<?php

namespace Modules\Core\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Entities\Admin;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email',$request->email)->first();
        if (! $admin) {
            return back()->withInput($request->only('email','remember'))->withErrors(['message' => 'User not found']);
        }

        if (! Hash::check($request->password,$admin->password)) {
            return back()->withInput($request->only('email','remember'))->withErrors(['message' => 'Password not valid']);
        }

        if(Auth::guard('admin')->login($admin,$request->get('remember'))){
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput($request->only('email','remember'))->withErrors(['msg' => "Can't login"]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}
