<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function test_login()
    {
        Session::start();
        $this->call('POST','/login',array('username'=>'riyaz942','password'=>'riyaz','_token'=>csrf_token()));

        $this->assertRedirectedTo('home');
        //$this->assertEquals($content,'ok');
       // $this->assertTrue(true);
    }
}
