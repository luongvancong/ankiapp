<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PageController extends Controller
{

    public function getDetail($id, $slug)
    {
        return "Page detail::".$slug;
    }
}
