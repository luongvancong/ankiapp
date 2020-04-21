@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Giá trị thuộc tính
                <small>Danh mục: <i>{{ $category->getName() }}</i></small>
                <small>,Thuộc tính: <b>{{ $attribute->getName() }}</b></small>
                <div class="pull-right">
                    <a href="{{ route('admin.product_attribute.values.create', $attribute->getId()) }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
                    <a href="{{ route('admin.product_attribute.index', $category->getId()) }}" class="btn btn-xs btn-default">{{ trans('form.btn.back') }}</a>
                </div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Giá trị</th>
                                <th width="30">Sửa</th>
                                <th width="30">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attribute->values()->get() as $item)
                                <tr>
                                    <td>{{ $item->getValue() }}</td>
                                    <td width="30">{!! makeEditButton(route('admin.product_attribute.values.edit', [$attribute->getId(), $item->getId()])) !!}</td>
                                    <td width="30">{!! makeDeleteButton(route('admin.product_attribute.values.delete', [$attribute->getId(), $item->getId()])) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop