<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\Request;

class AdminUserFormRequest extends Request
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
        $rules = [
            'email'    => 'required|email',
            'username' => 'required|unique:users,username,'.$this->id,
            'nickname' => 'required',
            'name'     => 'required',
        ];

        if ($this->is('admin/users/create')) {
            $rules['email'] .= '|unique:users';
        }

        return $rules;
    }
}
