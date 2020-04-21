<?php

namespace Modules\Tag\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Tag\Http\Requests\AdminTagFormRequest;
use Modules\Tag\Repositories\TagRepository;
use App\Http\Controllers\Admin\AdminController;

class TagController extends AdminController {

    /**
     * Tag
     * @var \Modules\Tag\Repositories\TagRepository
     */
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }


    public function getIndex(Request $request)
    {
        $tags = $this->tag->get(20, [], $request->all(), ['updated_at' => 'DESC']);
        return view('tag::admin/index', compact('tags'));
    }

    public function getCreate()
    {
        $tag = $this->tag->getInstance();
        return view('tag::admin/create', compact('tag'));
    }

    public function postCreate(AdminTagFormRequest $request)
    {
        if($tag = $this->tag->create($request->all())) {
            return redirect()->route('admin.tag.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.tag.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getEdit($id)
    {
        $tag = $this->tag->getById($id);
        return view('tag::admin/create', compact('tag'));
    }

    public function postEdit($id, AdminTagFormRequest $request)
    {
        $data = $request->except(['_token']);
        if($this->tag->update($data, ['id' => $id])) {
            return redirect()->route('admin.tag.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.tag.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($id)
    {
        if($this->tag->delete($id)) {
            return redirect()->route('admin.tag.index')->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->route('admin.tag.index')->with('error', trans('general.messages.delete_fail'));
    }


    /**
     * Ajax editable
     * @param  Request $request
     * @return json
     */
    public function ajaxEditable(Request $request)
    {
        $id    = $request->get('pk');
        $field = $request->get('name');
        $value = clean($request->get('value'));

        $item = $this->tag->getById($id);
        $item->$field = $value;

        if($item->save()) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }


    /**
     * Ajax get data to input token
     * @param  Request $request
     * @return json
     */
    public function ajaxInputToken(Request $request)
    {
        $q = clean($request->get('q'));
        $json = [];
        $tags = $this->tag->get(20, [], ['name' => $q], [], false);
        foreach($tags as $tag) {
            $json[] = [
                'id' => $tag->getId(),
                'name' => $tag->getName()
            ];
        }

        return response()->json($json);
    }


    /**
     * Ajax get data form tag input
     * @param  Request $request
     * @return json
     */
    public function ajaxTagInput(Request $request)
    {
        $q = clean($request->get('term'));
        $json = [];
        $tags = $this->tag->get(20, [], ['name' => $q], [], false);
        foreach($tags as $tag) {
            $json[] = $tag->getName();
        }

        return response()->json($json);
    }
}