<?php

namespace Modules\Testimonial\Http\Controllers\Admin;

use Modules\Testimonial\Http\Requests\AdminTestimonialFormRequest;
use Modules\Testimonial\Repositories\TestimonialRepository;
use App\Http\Controllers\Admin\AdminController;

class TestimonialController extends AdminController {

    /**
     * @var \Modules\Testimonial\Repositories\TestimonialRepository
     */
    protected $testimonial;

    public function __construct(TestimonialRepository $testimonial)
    {
        parent::__construct();
        $this->testimonial = $testimonial;
    }

    public function getIndex()
    {
        $testimonials = $this->testimonial->get();
        return view('testimonial::admin/index', compact('testimonials'));
    }

    public function getCreate()
    {
        $feedback = $this->testimonial->getInstance();
        return view('testimonial::admin/create', compact('feedback'));
    }

    public function postCreate(AdminTestimonialFormRequest $request)
    {
        if($feedback = $this->testimonial->create($request->all())) {
            return redirect()->route('admin.testimonial.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.testimonial.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getEdit($id)
    {
        $feedback = $this->testimonial->getById($id);
        return view('testimonial::admin/edit', compact('feedback'));
    }

    public function postEdit($id, AdminTestimonialFormRequest $request)
    {
        $data = $request->except(['_token']);
        if($feedback = $this->testimonial->update($data, ['id' => $id])) {
            return redirect()->route('admin.testimonial.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.testimonial.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($id)
    {
        if($this->testimonial->delete($id)) {
            return redirect()->route('admin.testimonial.index')->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->route('admin.testimonial.index')->with('error', trans('general.messages.delete_fail'));
    }

}