<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function getLogin()
    {
        return view('auth/login');
    }
}
