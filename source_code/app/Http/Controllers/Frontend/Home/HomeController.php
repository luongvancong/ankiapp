<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;

class HomeController extends FrontendController
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        setting()->meta_title = "Your first blog";
        setting()->meta_description = "Hope you happy with amazing core framework";
        return view('welcome');
    }
}
