@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>
            Quản lý trang tĩnh
            <div class="pull-right">
                <a href="{{ route('admin.page.create') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
            </div>
        </h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Slug</th>
                    <th width="30">Atv</th>
                    <th width="30">Edit</th>
                    <th width="30">Del</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td width="30">{{ $page->getId() }}</td>
                        <td>
                            <a href="{{ route('page.detail', [$page->getId(),  $page->getSlug()]) }}">{{ $page->getTitle() }}</a>
                        </td>
                        <td>
                            {{ $page->getSlug() }}
                        </td>
                        <td class="text-center">{!! makeActiveButton(route('admin.page.active', [$page->getId()]), $page->getActive()) !!}</td>
                        <td class="text-center">{!! makeEditButton(route('admin.page.edit', [$page->getId()])) !!}</td>
                        <td class="text-center">{!! makeDeleteButton(route('admin.page.delete', [$page->getId()])) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            {!! $pages->links() !!}
        </div>
    </div>
</div>


@stop