<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Setting\Http\Requests\AdminMetadataFormRequest;
use Modules\Setting\Http\Requests\AdminSettingFormRequest;
use Modules\Setting\Http\Requests\AdminSocialFormRequest;
use Modules\Setting\Repositories\Setting;
use Modules\Setting\Repositories\SettingRepository;


class SettingController extends AdminController
{
    /**
     * @var SettingRepository
     */
    protected $setting;

    public function __construct(SettingRepository $setting)
    {
        $this->setting  = $setting;
        $this->image    = \App::make('ImageFactory');
        $this->config   = \Config::get('image');
        parent::__construct();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
        // Chọn cấu hình phù hợp cho form
        $settings = [
            $this->setting->getByKey('logo', ['key' => 'logo', 'type' => 'file', 'label' => 'Logo']),
            $this->setting->getByKey('name', ['key' => 'name', 'type' => 'text', 'label' => 'Tên công ty']),
            $this->setting->getByKey('address', ['key' => 'address', 'type' => 'text', 'label' => 'Địa chỉ']),
            $this->setting->getByKey('email', ['key' => 'email', 'type' => 'text', 'label' => 'Email']),
            $this->setting->getByKey('email_1', ['key' => 'email_1', 'type' => 'text', 'label' => 'Email 1']),
            $this->setting->getByKey('email_2', ['key' => 'email_2', 'type' => 'text', 'label' => 'Email 2']),
            $this->setting->getByKey('hotline', ['key' => 'hotline', 'type' => 'text', 'label' => 'Hotline']),
            $this->setting->getByKey('hotline_1', ['key' => 'hotline_1', 'type' => 'text', 'label' => 'Hotline 1']),
            $this->setting->getByKey('yahoo', ['key' => 'yahoo', 'type' => 'text', 'label' => 'Yahoo']),
            $this->setting->getByKey('yahoo_1', ['key' => 'yahoo_1', 'type' => 'text', 'label' => 'Yahoo 1']),
            $this->setting->getByKey('yahoo_2', ['key' => 'yahoo_2', 'type' => 'text', 'label' => 'Yahoo 2']),
            $this->setting->getByKey('slogan', ['key' => 'slogan', 'type' => 'text', 'label' => 'Slogan']),
            $this->setting->getByKey('static_vers', ['key' => 'static_vers', 'type' => 'text', 'label' => 'Css/Js version']),
        ];

        return view('setting::website', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $this->processData($request);
        return redirect()->route('website.edit')->with('success', trans('general.messages.update_success'));
    }

    /**
     * Setting metadata website
     * @return View
     */

    public function metadata()
    {
        // Chọn cấu hình phù hợp cho form
        $settings = [
            $this->setting->getByKey('meta_title', ['key' => 'meta_title', 'type' => 'text', 'label' => 'Meta title']),
            $this->setting->getByKey('meta_keyword', ['key' => 'meta_keyword', 'type' => 'text', 'label' => 'Meta keyword']),
            $this->setting->getByKey('meta_description', ['key' => 'meta_description', 'type' => 'text', 'label' => 'Meta description']),
        ];

        return view('setting::metadata', compact('settings'));
    }

    /**
     * Cập nhật thông tin metadata
     * @return Response
     */
    public function postMetadata(AdminMetadataFormRequest $request)
    {
        $this->processData($request);
        return redirect()->route('metadata.show')->with('success', trans('general.messages.update_success'));
    }

    /**
     * Setting Social Network
     * @return View
     */

    public function social()
    {
        // Chọn cấu hình phù hợp cho form
        $settings = [
            $this->setting->getByKey('embed_code', ['key' => 'embed_code', 'type' => 'textarea', 'label' => 'Mã nhúng']),
            $this->setting->getByKey('facebook', ['key' => 'facebook', 'type' => 'text', 'label' => 'Facebook']),
            $this->setting->getByKey('google_plus', ['key' => 'google_plus', 'type' => 'text', 'label' => 'Google+']),
            $this->setting->getByKey('youtube', ['key' => 'youtube', 'type' => 'text', 'label' => 'Youtube']),
            $this->setting->getByKey('twitter', ['key' => 'twitter', 'type' => 'text', 'label' => 'Twitter']),
            $this->setting->getByKey('pinterest', ['key' => 'pinterest', 'type' => 'text', 'label' => 'Pinterest']),
            $this->setting->getByKey('linkedin', ['key' => 'linkedin', 'type' => 'text', 'label' => 'Linked in']),
            $this->setting->getByKey('instagram', ['key' => 'instagram', 'type' => 'text', 'label' => 'Instagram']),
            $this->setting->getByKey('tumblr', ['key' => 'tumblr', 'type' => 'text', 'label' => 'Tumblr']),
        ];

        return view('setting::social', compact('settings'));
    }

    /**
     * Update social info
     * @param  AdminSocialFormRequest $request
     * @return Response
     */
    public function postSocial(AdminSocialFormRequest $request)
    {
        $this->processData($request);
        return redirect()->route('social.show')->with('success', trans('general.messages.update_success'));
    }

    private function processData(Request $request) {
        $settings = $request->get('setting');
        foreach($settings as $key => $item) {
            $setting = $this->setting->getByKey($key, $item);
            $setting->value = array_get($item, 'value');
            $setting->save();
        }
    }
}
