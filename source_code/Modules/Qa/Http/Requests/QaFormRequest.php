<?php

namespace Modules\Qa\Http\Requests;

use App\Http\Requests\Request;

class QaFormRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'g-recaptcha-response' => 'required',
            'name'     => 'required',
            'phone'    => 'required',
            'question' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Vui lòng xác nhận bạn không phải là robot',
            'name.required'                 => 'Vui lòng nhập họ và tên',
            'phone.required'                => 'Vui lòng nhập số điện thoại',
            'question.required'             => 'Vui lòng nhập nội dung câu hỏi'
        ];
    }
}