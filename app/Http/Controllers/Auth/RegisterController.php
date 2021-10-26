<?php

namespace App\Http\Controllers\Auth;

use App\admins;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'roll_id' => '1',
            'password' => Hash::make($data['password']),
        ]);
    }
    protected function create_admin(array $data)
    {
        return admins::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'roll_id' =>$data['roll'] ,
            'is_super' =>'1',
            'password' => Hash::make($data['password']),
        ]);
    }

//    protected function redirectTo()
//    {
////        return 'admin/ok';
//    }
//     function register($request)
//    {
//        $this->validator($request)->validate();
//
//
//
////         $this->guard()->login($user);
////        redirect()->route('home');
//       $this->registered($request, $user) ?: true;
//        return $f;
//        return $f;
//    }
//    public static function __callStatic($method, $parameters)
//    {
//        return (new static)->$method($parameters);
//    }
   public function registers_admin($request,$roll){
       if ($roll == 'user') {
        event(new Registered($user=$this->create($request)));
       ($user) ? true:false ;
       }
       else{
           event(new Registered($user=$this->create_admin($request)));
           ($user) ? true:false ;
       }


   }
    protected function redirectTo()
    {
        return '/';
//        return '/admin/ok';
    }


}
