@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>
            Quản lý câu trả lời, câu hỏi #{{ $question->getId() }}
            <div class="pull-right">
                <a href="{{ route('admin.answer.create', $question->getId()) }}" class="btn btn-xs btn-primary">Tạo mới</a>
            </div>
        </h3>
    </div>

    <div class="panel-body">
        <div class="alert alert-info">
            {{ $question->getQuestion() }}
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>ID</th>
                <th>Người trả lời</th>
                <th>Câu trả lời</th>
                <th>Ngày tạo</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </thead>
            <tbody>
                @foreach($answers as $item)
                    <tr>
                        <td>{{ $item->getId() }}</td>
                        <td>{{ $item->author->getName() }}</td>
                        <td width="400">{!! $item->getAnswer() !!}</td>
                        <td>{{ $item->getCreatedAt() }}</td>
                        <td>{!! makeEditButton(route('admin.answer.edit', [$item->getId()])) !!}</td>
                        <td>{!! makeDeleteButton(route('admin.answer.delete', [$item->getId()])) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop