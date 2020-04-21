@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
           <h3>Sửa thuộc tính</h3>
           <h5>Danh mục: {{ $category->getName() }}</h5>
        </div>
        <div class="panel-body">
            @include('product::admin/attribute/form')
        </div>
    </div>
@stop
