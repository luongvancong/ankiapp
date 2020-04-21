<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackendController extends BaseController
{
   use DispatchesJobs, ValidatesRequests;

   public function __construct() {

   }
}
