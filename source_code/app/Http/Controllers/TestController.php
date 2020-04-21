<?php

namespace App\Http\Controllers;

use BlackBear\DataGrid\DataTable;
use BlackBear\HtmlComponent\Component;
use BlackBear\HtmlComponent\Form;
use BlackBear\HtmlComponent\FormItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Post\Repositories\Post;

class TestController extends Controller
{
    public function index()
    {

        // $content = Post::find(1)->content;
        // echo 1;die;
        // preg_match_all('#img#', $content, $matches);
        // dd($matches);
        // $upload = app('ImageFactory');
        // $url = 'http://giadinh.mediacdn.vn/2017/d2-1502073563231.jpg';
        // $resultUpload = $upload->uploadFromUrl($url);
        // _debug($resultUpload);
//         echo \Hash::make(12345678);
        die;
        // $dataGrid = new DataGrid();
        // echo $dataGrid->showHeading('ID', 'id', 1);die;
        // // $routeCollection = \Route::getRoutes();

        // // foreach ($routeCollection as $value) {
        // //     echo $value->getPath(). "\n";
        // // }
        // // die;
        // // print_r(config('admin.nav'));die;
        // $now = time();
        // $after = time() + (30*60);
        // var_dump(date('Y-m-d H:i:s', $now));
        // var_dump(date('Y-m-d H:i:s', $after));
        // // return view('frontend/email/order');
    }

    public function payment()
    {
        $payment = new \App\Hocs\Payments\Napas();
        $payment->setReturnUrl('http://sapabuslimousines.com/return');
        $payment->setBackUrl('http://sapabuslimousines.com/return');
        $payment->setAmount(600000);
        $payment->setMerchTxnRef(md5(12345678));
        $payment->setMerchant('SMLTEST');
        $payment->setAccessCode('ECAFAB');
        $payment->setSecureHash('198BE3F2E8C75A53F38C1C4A5B6DBA27');

        _debug($payment->getParams());
        echo '<hr/>';
        echo ('<a target="_blank" href="' . $payment->getRequestUrl() . '">' . $payment->getRequestUrl() . '</a>');die;

        return redirect()->to($payment->request());
    }

    public function paymentReturnUrl(Request $request)
    {
        _debug($request->all());
    }


    public function mail()
    {
        Mail::send('frontend/email/order', [], function ($m) {
            $m->from('hanoijs@gmail.com', 'VatGia.Com');
            $m->to('cong.itsoft@gmail.com')->subject('Hi, Justin Luong');
        });
    }

    public function mailRaw()
    {
        $to      = 'cong.itsoft@gmail.com';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: hanoijs@gmail.com' . "\r\n" .
            'Reply-To: cong.itsoft@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

    public function dataGrid(Request $request)
    {
        $faker = \Faker\Factory::create();
        $dataSource = new Collection();
        for($i = 0; $i < 30; $i ++) {
            $dataSource->push([
                'id' => $faker->ean8,
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'birthday' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'created_at' => $faker->time(),
                'update_at' => $faker->time()
            ]);
        }

        $dataGrid = new DataTable([
            'visibleColumns' => ['id', 'name', 'phone', 'email', 'birthday'],
            'columnHeaders' => ['id' => 'ID', 'name' => 'Name'],
            'sortColumns' => ['id', 'name'],
            'showCheckbox' => true,
            'showEditDelete' => true,
            'currentUrl' => url()->full(),
            'dataSource' => $dataSource,
            'renderRowAttribute' => function($item) {
                return [
                    'data-id' => $item['id']
                ];
            },
            'renderColumnAttribute' => function($item, $column) {
                switch($column) {
                    case 'id':
                        return ['data-field' => 'id', 'data-id' => $item['id']];
                    case 'email':
                        return ['data-field' => 'email'];
                    case 'name':
                        return 'data-field="name" data-id="'.$item['id'].'"';
                }
            },
            'renderEditUrl' => function($item) {
                return url('/'.$item['id'].'/edit');
            },
            'renderDeleteUrl' => function($item) {
                return url('/'.$item['id'].'/delete');
            },
            'renderColumnContent' => function($item, $column) {
                switch($column) {
                    case 'id':
                        return '<i>'.$item['id'].'</i>';
                    case 'email':
                        return '<a href="mailto:'.$item['email'].'">'.$item['email'].'</a>';
                }
            }
        ]);

        return view('tests/data-grid', ['tableContent' => $dataGrid->render()]);
    }

    public function testComponent() {
        $c = new Component();
        $f = new Form();
        $item = new \stdClass;
        $item->name = "cong";
        $item->age = 60;
        $item->content = "Lorem";
        $dataOption = [
            "" => "Chon",
            'male' => "Male",
            'female' => "Female"
        ];
        $dataOptionGroup = [
            "Swedish Cars" => [
                "volvo" => "Volvo",
                "saab" => "Saab"
            ],
            "German Cars" => [
                "mercedes" => "Mercedes",
                "audi" => "Audi"
            ]
        ];
        $dataOptionMulti = [
            "" => "Chon",
            1 => "01",
            2 => "02"
        ];

        $f->setItems([
            new FormItem([
                'label' => "Form Item",
                'content' => $c->input('text', 'text_name'),
                'required' => true
            ]),
            new FormItem([
                'label' => "Password",
                'content' => $c->input('password', 'text_pass'),
                'required' => true
            ]),
            new FormItem([
                'label' => "Option",
                'content' => $c->radio('Option', 'option', 1, old('option'))
                    .$c->space().$c->radio("Option1", 'option', 2, old('option'))
                    .$c->error("option")
            ]),
            new FormItem([
                'label' => "Select",
                'content' => $c->select('city', $dataOption, 'male')
            ]),
            new FormItem([
                'label' => "Textarea",
                'content' => $c->input('textarea', 'textarea', "", ['rows' => 5])
            ]),
            new FormItem([
                'label' => "Content",
                'content' => $c->input('editor', 'content')
            ]),
        ]);
        $content = $f->render();
        return view('tests/component', compact('content'));
    }

    public function submitComponent(Request $request) {
//        dd($request->all());
        $request->validate([
            'name' => 'required|email',
            "gender" => "required",
            "checkbox" => "email",
            "age" => "required",
            "multi" => 'email',
            'option' => 'email'
        ]);
    }
}
