<?php

namespace App\Http\Controllers;

use App;
use Auth, Cookie;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

class FrontendController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct() {

    }

}
