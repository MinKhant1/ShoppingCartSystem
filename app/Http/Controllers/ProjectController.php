<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    //

    function dologout()
    {
        session()->flush();
        Auth::logout();
        return Redirect::to('/');

    }
}
