<?php

namespace Modules\Post\Http\Requests;

use App\Http\Requests\Request;

class AdminPostFormRequest extends Request
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
			'title' => 'required|max:190',
			'category_id' => 'required',
			'meta_title' => 'max:190',
			'meta_keyword' => 'max:255',
			'meta_description' => 'max:190'
		];
	}

	public function messages()
	{
		return [
			'title.required' => 'Vui lòng nhập tiêu đề',
			'title.max' => 'Tiêu đề không vượt quá 190 ký tự',
			'meta_title.max' => 'Meta title không vượt quá 190 ký tự',
			'meta_keyword.max' => 'Meta keyword không vượt quá 255 ký tự',
			'meta_description.max' => 'Meta Description không vượt quá 255 ký tự',
			'category_id.required' => 'Vui lòng chọn danh mục'
		];
	}
}
