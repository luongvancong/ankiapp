<?php

namespace Modules\Product\Http\Requests;

use App\Http\Requests\Request;
use DB;

class AdminProductAttributeValueFormRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'value' => 'required'
        ];

        $value = $this->get('value');

        // Kiểm tra giá trị này đã tồn tại chưa, nếu tồn tại rồi mà = giá trị post đi thì bỏ qua
        // khác thì phải kiểm tra ngay
        $exist = DB::table('product_attribute_values')->where('attribute_id', $this->attrId)->where('value', $value)->first();
        if($exist && $exist->value != $value) {
            $rules['value'] .= '|unique:product_attribute_values,value,'.$this->valueId;
        }
        if($exist) {
            if($this->valueId > 0) {
                if($exist->value != $value) {
                    $rules['value'] .= '|unique:product_attribute_values,value,'.$this->valueId;
                }
            } else {
                if($exist->value == $value) {
                    $rules['value'] .= '|unique:product_attribute_values,value';
                }
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'value.required' => 'Vui lòng nhập giá trị thuộc tính',
            'value.unique'   => 'Giá trị này đã tồn tại, vui lòng kiểm tra lại'
        ];
    }
}