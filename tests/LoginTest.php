<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function test_login_true()
    {
        Session::start();

        $credentials = array(
        'username'=>'riyaz942',
        'password'=>'riyaz',
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
}
