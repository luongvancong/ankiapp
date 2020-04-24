<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeskRequest;
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
        return $this->deskRepository->filter($request->all());
    }

    public function store(DeskRequest $request) {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        return $this->deskRepository->create($data);
    }

    public function update($id, DeskRequest $request) {
        $data = $request->all();
        $data['updated_by'] = $request->user()->id;
        return $this->deskRepository->update($id, $data);
    }

    public function show($id) {
        return $this->deskRepository->getById($id);
    }

    public function destroy($id) {
        if ( $this->deskRepository->delete($id) ) {
            return response()->json(['count' => 1]);
        }
        return response()->json(['count' => 0]);
    }

    public function study($id) {
        $desk = $this->deskRepository->getById($id);
        $cards = $desk->cards()->orderByRaw("RAND()")->get();
        return $cards;
    }
}
