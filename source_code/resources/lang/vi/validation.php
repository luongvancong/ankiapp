<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Trường :attribute phải được chấp nhận.',
    'active_url'           => 'Trường :attribute không đúng định dạng URL.',
    'after'                => 'Trường :attribute phải là khoảng sau :date.',
    'alpha'                => 'Trường :attribute chỉ có thể chứa ký tự chữ.',
    'alpha_dash'           => 'Trường :attribute chỉ có thể chứa ký tự chữ, số, và dấu gạch dưới.',
    'alpha_num'            => 'Trường :attribute chỉ có thể chứa ký tự chữ và số.',
    'array'                => 'Trường :attribute phải là một mảng.',
    'before'               => 'Trường :attribute phải là khoảng trước :date.',
    'between'              => [
        'numeric' => 'Trường :attribute phải ở giữa khoảng :min đến :max.',
        'file'    => 'Trường :attribute phải ở giữa khoảng :min đến :max kilobytes.',
        'string'  => 'Trường :attribute phải ở giữa khoảng :min đến :max ký tự.',
        'array'   => 'Trường :attribute phải ở giữa khoảng :min đến :max phần tử.',
    ],
    'boolean'              => 'Trường :attribute phải là true hoặc false.',
    'confirmed'            => 'Trường :attribute không xác thực đúng.',
    'date'                 => 'Trường :attribute không đúng định dạng ngày tháng.',
    'date_format'          => 'Trường :attribute không đúng định dạng :format.',
    'different'            => 'Trường :attribute và :other phải khác nhau.',
    'digits'               => 'Trường :attribute phải là :digits số.',
    'digits_between'       => 'Trường :attribute phải ở giữa :min đến :max số.',
    'email'                => 'Trường :attribute phải đúng định dạng email.',
    'filled'               => 'Trường :attribute phải được điền vào.',
    'exists'               => 'Trường :attribute được chọn không hợp lệ.',
    'image'                => 'Trường :attribute phải là dạng ảnh.',
    'in'                   => 'Trường :attribute được chọn không hợp lệ.',
    'integer'              => 'Trường :attribute phải là kiểu số nguyên.',
    'ip'                   => 'Trường :attribute phải đúng định dạng IP.',
    'max'                  => [
        'numeric' => 'Trường :attribute không thể lớn hơn :max.',
        'file'    => 'Trường :attribute không thể lớn hơn :max kilobytes.',
        'string'  => 'Trường :attribute không thể lớn hơn :max ký tự.',
        'array'   => 'Trường :attribute không được nhiều hơn :max phần tử.',
    ],
    'mimes'                => 'Trường :attribute phải là kiểu định dạng: :values.',
    'min'                  => [
        'numeric' => 'Trường :attribute tối thiểu phải là :min.',
        'file'    => 'Trường :attribute tối thiểu phải là :min kilobytes.',
        'string'  => 'Trường :attribute tối thiểu phải là :min ký tự.',
        'array'   => 'Trường :attribute tối thiểu phải là :min phần tử.',
    ],
    'not_in'               => 'Trường :attribute được chọn không hợp lệ.',
    'numeric'              => 'Trường :attribute phải là kiểu số.',
    'regex'                => 'Trường :attribute sai định dạng.',
    'required'             => 'Trường :attribute không được bỏ trống.',
    'required_if'          => 'Trường :attribute không được bỏ trống khi :other là :value.',
    'required_with'        => 'Trường :attribute không được bỏ trống khi giá trị hiện tại là :values.',
    'required_with_all'    => 'Trường :attribute không được bỏ trống khi giá trị hiện tại là :values.',
    'required_without'     => 'Trường :attribute không được bỏ trống khi giá trị hiện tại không phải là :values.',
    'required_without_all' => 'Trường :attribute không được bỏ trống khi không có giá trị hiện tại nào là :values.',
    'same'                 => 'Trường :attribute và :other phải giống nhau.',
    'size'                 => [
        'numeric' => 'Trường :attribute phải là :size.',
        'file'    => 'Trường :attributephải là :size kilobytes.',
        'string'  => 'Trường :attributephải là :size ký tự.',
        'array'   => 'Trường :attribute phải chứa :size phần tử.',
    ],
    'timezone'             => 'Trường :attributephải là một vùng hợp lệ.',
    'unique'               => 'Trường :attribute đã thực sự tồn tại.',
    'url'                  => 'Trường :attribute định dạng không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
