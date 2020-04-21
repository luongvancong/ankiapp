<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\Request;

class AdminPermissionFormRequest extends Request
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
            'name' => 'required',
            'display_name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin/validation.perm_name_required'),
            'display_name.required' => trans('admin/validation.perm_key_required')
        ];
    }
}
