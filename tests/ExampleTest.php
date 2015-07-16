<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

 class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function test_if_it_runs()
    {
        $stack = array();
        array_push($stack,'foo');
        $this->assertEquals('asa,jdh',array_pop($stack));
    }
}
