@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Danh sách thuộc tính
                <div class="pull-right">
                    <a href="{{ route('admin.product_attribute.create', $category->getId()) }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
                    <a href="{{ route('admin.product_attribute.index', $category->getId()) }}" class="btn btn-xs btn-default">{{ trans('form.btn.back') }}</a>
                </div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
                        <input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tên thuộc tính" value="{{ Request::get('name', '') }}">
                        <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                    </form>
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Giá trị</th>
                                <th width="30">Sửa</th>
                                <th width="30">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attributes as $key => $attribute)
                                <tr>
                                    <td width="50">{{ $attribute->getId() }}</td>
                                    <td>
                                        {{ $attribute->getName() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product_attribute.values.index', [$attribute->getId()]) }}" class="btn btn-xs btn-info"><span class="badge">{{ $attribute->values()->count() }}</span></a>
                                    </td>
                                    <td width="30">
                                        {!! makeEditButton(route('admin.product_attribute.edit', [$category->getId(), $attribute->getId()])) !!}
                                    </td>
                                    <td width="30">
                                        {!! makeDeleteButton(route('admin.product_attribute.delete', [$category->getId(), $attribute->getId()])) !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop