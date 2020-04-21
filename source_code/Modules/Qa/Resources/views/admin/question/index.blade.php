@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>
            Quản lý hỏi đáp
            <div class="pull-right">
                <a href="{{ route('admin.question.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-plus-sign"></i> Trở lại</a>
            </div>
        </h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>ID</th>
                <th>Câu hỏi</th>
                <th>Người hỏi</th>
                <th>Ngày tạo</th>
                <th>Trả lời</th>
                <th>Xóa</th>
            </thead>
            <tbody>
                @foreach($questions as $item)
                    <tr>
                        <td>{{ $item->getId() }}</td>
                        <td width="400">{{ $item->getQuestion() }}</td>
                        <td>
                            <ul>
                                <li>Họ và tên: {{ $item->getUserName() }}</li>
                                <li>Email: {{ $item->getUserEmail() }}</li>
                                <li>Phone: {{ $item->getUserPhone() }}</li>
                            </ul>
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td><a class="btn btn-xs btn-primary" href="{{ route('admin.answer.index', $item->getId()) }}"><span class="badge">{{ $item->answers->count() }}</span> Trả lời</a></td>
                        <td>{!! makeDeleteButton(route('admin.question.delete', $item->getId())) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop