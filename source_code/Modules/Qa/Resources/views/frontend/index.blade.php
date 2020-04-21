@extends('frontend/default')

@section('content')
<div id="breadcrumb">
    <div class="container">
        <h4 class="breadcrumb_title">Hỏi đáp</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb_item"><a href="/">Trang chủ</a></li>
          <li class="breadcrumb_item active">Hỏi đáp</li>
        </ol>
    </div>
</div>
<div class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8">
                @include('notifications')

                @if($questions->count() == 0)
                    <div class="alert alert-warning">Hiện chưa có câu hỏi nào</div>
                @else
                    <div class="medi_content posts-list-layout">
                        <div class="row">
                            @foreach($questions as $item)
                                <div class="col-xs-12 item">
                                    {!! view('qa::frontend/partials/question-item', ['question' => $item]) !!}
                                </div>
                            @endforeach
                        </div>

                        <div id="pagination" class="text-center">
                            {!! $questions->links() !!}
                        </div>
                    </div>
                @endif

                <h1 class="page-heading">Hỏi đáp cùng chuyên gia</h1>
                <form class="form" method="POST">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group {{ hasValidator('name') }}">
                                <label>Họ và tên</label>
                                <input type="text" name="name" class="form-control">
                                {!! alertError('name') !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Tuổi</label>
                                <input type="text" name="age" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group {{ hasValidator('phone') }}">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" class="form-control">
                                {!! alertError('phone') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group {{ hasValidator('question') }}">
                        <label>Câu hỏi</label>
                        <textarea name="question" rows="5" class="form-control"></textarea>
                        {!! alertError('question') !!}
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Lc9dBsUAAAAAG3jMxuA9SmX2XrgBwukv4m7XytN"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary">Gửi</button>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('frontend/partials/sidebar')
            </div>
        </div>
    </div>
</div>
@stop