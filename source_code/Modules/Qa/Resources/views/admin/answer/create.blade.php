@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>
          Thêm câu trả lời
          <a href="{{ route('admin.answer.index', $question->getId()) }}" class="btn btn-xs btn-default pull-right">{{ trans('form.btn.back') }}</a>
       </h3>
    </div>
    <div class="panel-body">
        <div class="alert alert-info">{{ $question->getQuestion() }}</div>
        @include('qa::admin/answer/form')
    </div>
</div>

@stop