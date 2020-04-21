<?php
namespace Modules\Page\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use Input;
use Modules\Page\Http\Requests\AdminPageFormRequest;
use Modules\Page\Repositories\PageRepository;
use App\Http\Controllers\Admin\AdminController;
use Redirect;
use Response;
use Str;
use View;
use Xss;

class PageController extends AdminController {

	/**
	 * PageRepository
	 * @var Modules\Page\Repositories\PageRepository
	 */
	protected $page;

	public function __construct(PageRepository $page) {
		parent::__construct();
		$this->page = $page;
		$this->imageUploader = App::make('ImageFactory');
	}

	# Listing pages

	public function getIndex(Request $request)	{
		$pages = $this->page->getPages(25, $request->all());
		return View::make('page::admin/index', compact('pages'));
	}

	public function getCreate() {
		$page = $this->page->getInstance();
		return View::make('page::admin/create', compact('page'));
	}

	public function postCreate(AdminPageFormRequest $request) {
		$data = $request->except(['_token']);

		if($request->hasFile('image')) {
			$resultUpload = $this->imageUploader->upload('image');
			if($resultUpload['status'] > 0) {
				$data['image'] = $resultUpload['filename'];
			}
		}

		$data['slug'] = $data['slug'] ? $data['slug'] : removeTitle($data['title']);

		if($this->page->create($data)) {
			return redirect()->route('admin.page.index')->with('success', 'Cập nhật thành công');
		}

		return redirect()->route('admin.page.index')->with('error', 'Cập nhật không thành công');
	}

	public function getEdit($id) {
		$page = $this->page->getById($id);
		return View::make('page::admin/edit', compact('page'));
	}

	public function postEdit($id, AdminPageFormRequest $request) {
		$page = $this->page->getById($id);
		$data = $request->except(['_token']);

		if($request->hasFile('image')) {
			$resultUpload = $this->imageUploader->upload('image');

			if($resultUpload['status'] > 0) {
				$data['image'] = $resultUpload['filename'];
			}
		}

		$data['slug'] = $data['slug'] ? $data['slug'] : removeTitle($data['title']);

		if($this->page->update($data, ['id' => $id])) {
			return redirect()->route('admin.page.index')->with('success', 'Cập nhật thành công');
		}

		return redirect()->route('admin.page.index')->with('error', 'Cập nhật không thành công');
	}

	public function getActive($id) {
		$page = $this->page->getById($id);

		$page->active = !$page->active;

		if($page->save()) {
			return response()->json(['code' => 1, 'status' => $page->active]);
		}

		return response()->json(['code' => 0]);
	}

	# Method remove on pages

	public function getDelete($id)
	{
		$page = $this->page->getById($id);
		if($page->delete()) {
			return redirect()->route('admin.page.index')->with('success', 'Cập nhật thành công');
		}

		return redirect()->route('admin.page.index')->with('error', 'Cập nhật không thành công');
	}
}