<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function getSome()
    {
        $users = User::all();
        return $users;
    }

}
