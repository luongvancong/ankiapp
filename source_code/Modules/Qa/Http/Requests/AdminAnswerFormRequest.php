<?php

namespace Modules\Qa\Http\Requests;

use App\Http\Requests\Request;

class AdminAnswerFormRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'answer' => 'required'
        ];
    }
}