<?php

namespace Modules\Setting\Http\Requests;

use App\Http\Requests\Request;

class AdminSettingFormRequest extends Request
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
            'name'    => 'required',
            'address' => 'required',
            'email_1' => 'required|email',
            'phone_1' => 'required'
        ];
    }
}
