<?php

namespace Modules\Product\Http\Requests;

use App\Http\Requests\Request;

class AdminProductCategoryFormRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục'
        ];
    }
}