<?php

namespace Modules\Banner\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use Modules\Banner\Http\Requests\AdminBannerFormRequest;
use Modules\Banner\Repositories\Banner;
use Modules\Banner\Repositories\BannerRepository;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests;


class BannerController extends AdminController
{
	protected $banner;

	public function __construct(BannerRepository $banner)
	{
		parent::__construct();
		$this->banner   = $banner;
		$this->upload = App::make('Uploader');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$banners      = $this->banner->getBanners(20, $request->all());
		$positionList = Banner::getPositionList();
		$pageList     = Banner::getPageList();
		return view('banner::admin/index', compact('banners', 'positionList', 'pageList'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$banner = $this->banner->getInstance();
		return view('banner::admin/create', compact('banner'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(AdminBannerFormRequest $request)
	{
		$formData = $request->except('_token');
		if($request->hasFile('image')) {
			$formData['image'] = $this->upload->upload('image');
		}

		if($this->banner->create($formData)) {
			return redirect()->route('admin.banner.index')->with('success', trans('general.messages.create_success'));
		}

		return redirect()->back()->with('error', trans('general.messages.create_fail'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$banner = $this->banner->getById($id);
		return view('banner::admin/edit', compact('banner'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AdminBannerFormRequest $request, $id)
	{
		$banner = $this->banner->getById($id);
		$formData = $request->except('_token');

		if($request->hasFile('image')) {
			$formData['image'] = $this->upload->upload('image');
		}

		if($this->banner->update($formData, ['id' => $id])) {
			return redirect()->back()->with('success', trans('general.messages.update_success'));
		}

		return redirect()->back()->with('error', trans('general.messages.update_fail'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$banner = $this->banner->getById($id);

		if($banner->delete()) {
			return redirect()->route('admin.banner.index')->with('success', trans('general.messages.delete_success'));
		}

		return redirect()->back()->with('error', trans('general.messages.delete_fail'));
	}


	public function active($id) {
		$banner = $this->banner->getById($id);

		$banner->status = !$banner->status;

		if($banner->save()) {
			return response()->json([
			   'code' => 1,
			   'status' => $banner->getStatus()
			]);
		}

		return response()->json([
		   'code' => 0
		]);
	}


	/**
	 * Ajax editable
	 * @param  Request $request
	 * @return json
	 */
	public function ajaxEditAble(Request $request)
	{
		$id    = $request->get('pk');
        $field = $request->get('name');
        $value = clean($request->get('value'));

        $item = $this->banner->getById($id);
        $item->$field = $value;

        if($item->save()) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
	}
}
