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
                <div class="medi_content posts-list-layout">
                    <div class="row">
                        <div class="col-xs-12 item">
                            <div class="media">
                                <div class="media-left">
                                    <img src="/images/avatar_default.png">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{{ $question->getUrl() }}">{{ $question->getUserName() }}</a>
                                    </h4>
                                    <p>{{ $question->getQuestion() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="answers">
                    <h5 class="heading">Câu trả lời</h5>
                    <div class="items">
                        @foreach($answers as $k => $item)
                            <div class="item">
                                <div class="content">{!! $item->getAnswer() !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="other-questions">
                    <div class="medi_content posts-list-layout">
                        <h5 class="heading">Các câu hỏi khác</h5>
                        <div class="row">
                            @foreach($otherQuestions as $item)
                                <div class="col-xs-12 item">
                                    {!! view('qa::frontend/partials/question-item', ['question' => $item]) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4">
                @include('frontend/partials/sidebar')
            </div>
        </div>

    </div>
</div>
@stop