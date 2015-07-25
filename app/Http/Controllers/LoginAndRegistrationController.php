<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Article;
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
           return Redirect::intended('home');;
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

    public function create()
    {
        try {
            $request = Request::all();
            $article = new Article();
            $article->username = Auth::user()->name;
            $article->title = Request::get('title');
            $article->description = Request::get('description');
            $article->content = Request::get('content');
            $article->save();
            return array('value'=>'success');
        }
        catch(Exception $e) {
            return array('value'=>'error','error'=>$e);
        }
    }

    public function getArticleList()
    {
        $articles =Article::all();

        return view('itemRows')->with(['articles'=>$articles]);
    }

    public function getArticle($id)
    {
        $article =Article::find($id);

        if($article!=null)
            return array('title'=>$article->title,'content'=>$article->content);
        else
            return null;
    }

    public function updateArticle($id)
    {
        try {
            $article = Article::find($id);
            $request = Request::all();
            $article->title = Request::get('title');
            $article->description = Request::get('description');
            $article->content = Request::get('content');
            $article->save();

            return 'success';
        }
        catch(Exception $e)
        {
            return 'error';
        }
    }

    public function deleteArticle($id)
    {
        try {
            $article = Article::find($id);

            if($article!=null)
                $article->delete();
            else
                return 'error';

            return 'success';
        }
        catch(Exception $e)
        {
            return 'error';
        }
    }


}
