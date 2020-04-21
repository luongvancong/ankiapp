<?php

namespace Modules\Page\Http\Requests;

use App\Http\Requests\Request;

class AdminPageFormRequest extends Request
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
            'title' => 'required|max:190'
        ];
    }


    public function messages() {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.max' => 'Tiêu đề tối đa 190 ký tự'
        ];
    }
}
