<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest.admin')->except('logout');

        $this->middleware('guest')->except('logout');
    }
    protected function redirectTo()
    {
        return '/';
//        return '/admin/ok';
    }
    public function showAdminLoginForm()
    {
        return view('admin_login');
    }

    public function adminLogin(Request $request)
    {
        $messages = [
            'email.required' =>  trans('Validation.user.email.required'),
            'email.email' =>  trans('Validation.user.email.email'),
            'password.required' => trans('Validation.user.password.required'),
            'password.min' => trans('Validation.user.password.min'),

        ];
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ],$messages);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin/Dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function login(Request $request)
    {
        $messages = [
            'email_login.required' =>  trans('Validation.user.email.required'),
            'email_login.email' =>  trans('Validation.user.email.email'),
            'password_login.required' => trans('Validation.user.password.required'),
            'password_login.min' => trans('Validation.user.password.min'),

        ];
        $this->validate($request, [
            'email_login'   =>[ 'required','email', function ($attribute, $value, $fail) {
                $email = User::where('email', $value)->first();
                if ($email == null) {
                    $fail(' این ایمیل ثبت نشده');
                }
            }],
            'password_login' => ['required','min:6']

        ],$messages);

        if (Auth::attempt(['email' => $request->email_login, 'password' => $request->password_login], $request->get('remember'))) {

            return redirect()->intended('/');
        }
        return back()->withInput($request->only('email_login', 'remember','password_login'));
    }
}
