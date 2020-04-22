<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Repositories\CardRepository;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private $cardRepository;

    /**
     * @var \App\Hocs\Core\Uploads\Uploader
     */
    private $uploader;

    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
        $this->uploader = app('Uploader');
    }

    public function store(CardRequest $request) {
        $data = $request->except(['audio', 'image']);
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        if ($request->hasFile('audio')) {
            $data['audio'] = $this->uploader->upload('audio');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploader->upload('image');
        }

        return $this->cardRepository->create($data);
    }

    public function update($id, CardRequest $request) {
        $data = $request->except(['audio', 'image']);
        $data['updated_by'] = $request->user()->id;

        if ($request->hasFile('audio')) {
            $data['audio'] = $this->uploader->upload('audio');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploader->upload('image');
        }

        return $this->cardRepository->update($id, $data);
    }

    public function show($id) {
        return $this->cardRepository->getById($id);
    }

    public function destroy($id) {
        if ( $this->cardRepository->delete($id) ) {
            return response()->json(['count' => 1]);
        }
        return response()->json(['count' => 0]);
    }
}
