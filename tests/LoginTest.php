<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function test_set_up_auth()
    {
        Session::start();

        $credentials = array(
            'username'=>'ksjoshi88',
            'password'=>'team_b2',
            '_token'=>csrf_token());
        Auth::attempt($credentials);

    }

    public function test_login_true()
    {
        Session::start();

        $credentials = array(
        'username'=>'ksjoshi88',
        'password'=>'team_b2',
        '_token'=>csrf_token());

        $this->call('POST','/login',$credentials);

        $this->assertRedirectedTo('home');
        //$this->assertEquals($content,'ok');
       // $this->assertTrue(true);
    }

    public function test_login_false()
    {
        Session::start();

        $credentials = array(
            'username'=>'incorrect_username',
            'password'=>'incorrect_password',
            '_token'=>csrf_token());

        $this->call('POST','/login',$credentials);

        $this->assertRedirectedTo('/');
    }

    public function test_create_true()
    {
        Session::start();

        $article = array(

            'title'=>'testing title',
            'description'=>'testing desc',
            'content'=>'testing content',
            '_token'=>csrf_token());

        $this->call('POST','/create',$article);
        $this->assertResponseOk();
    }
}
