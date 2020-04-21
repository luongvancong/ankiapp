<?php

namespace Modules\Product\Http\Requests;

use App\Http\Requests\Request;
use DB;

class AdminProductAttributeFormRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required'
        ];

        $name = $this->get('name');
        $nameHash = md5($name);

        // Kiểm tra xem thuộc tính này đã có chưa
        // Trường hợp sửa thuộc tính nếu là giá trị mới thì phải kiểm tra unique
        // Trường hợp thêm mới thì kiểm tra unique luôn
        $exist = DB::table('product_attributes')->where('category_id', $this->id)->where('name_hash', $nameHash)->first();
        if($exist) {
            if($this->attrId > 0) {
                if($exist->name_hash != $nameHash) {
                    $rules['name'] .= '|unique:product_attributes,name';
                }
            } else {
                if($exist->name_hash == $nameHash) {
                    $rules['name'] .= '|unique:product_attributes,name';
                }
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên thuộc tính',
            'name.unique'   => 'Thuộc tính này đã tồn tại, vui lòng kiểm tra lại'
        ];
    }
}