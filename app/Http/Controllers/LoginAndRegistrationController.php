<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
class LoginAndRegistrationController extends Controller
{
    public function testing()
    {
       return 'ok';
    }

   public function login()
   {

       $request=Request::all();
       $username = Request::get('username');
       $password = Request::get('password');

       $credentials = array('name'=>$username,'password'=>$password);

       if (Auth::attempt($credentials)) {
           return Redirect::intended('home');
       }

       return Redirect::intended('/')->with('error','error');

   }

   public function home()
   {
       if (!Auth::check()) {
           return Redirect::intended('/');
       }

       return view('home');
   }

   public function signup()
   {
       try {
           $user = new User();
           $user->name = Input::get('username');
           $user->password = bcrypt(Input::get('password'));
           $user->email = Input::get('email');
           $user->save();

           return 'success';
       }
       catch(Exception $e){

           return array('error'=>'Could not sign you up dawg!!');
       }
   }

}
