<?php

namespace Modules\Banner\Http\Requests;

use App\Http\Requests\Request;

class AdminBannerFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'title'    => 'required',
            'link'     => 'required',
            'page'     => 'required',
            'position' => 'required'
        ];
    }


    public function messages() {
        return [
            // 'title.required'    => 'Vui lòng nhập tiêu đề',
            'link.required'     => 'Vui lòng nhập link',
            'page.required'     => 'Vui lòng nhập trang đích',
            'position.required' => 'Vui lòng nhập vị trí'
        ];
    }
}
