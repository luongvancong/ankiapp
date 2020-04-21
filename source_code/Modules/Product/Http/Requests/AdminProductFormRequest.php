<?php

namespace Modules\Product\Http\Requests;

use App\Http\Requests\Request;

class AdminProductFormRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'category_id.required' => 'Vui lòng chọn một danh mục'
        ];
    }
}