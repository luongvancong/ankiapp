<?php

namespace App\Http\Controllers\Api\Me;

use App\Http\Controllers\Controller;
use App\Repositories\DeskRepository;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    private $deskRepository;

    public function __construct(DeskRepository $deskRepository)
    {
        $this->deskRepository = $deskRepository;
    }

    public function index(Request $request) {
        $params = $request->all();
        $params['created_by'] = $request->user()->id;
        return $this->deskRepository->filter($params);
    }
}
