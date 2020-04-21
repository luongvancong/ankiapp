@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
            <h3>Sửa giá trị thuộc tính</h3>
            <h5>{{ $category->getName() }} -- <b>{{ $attribute->getName() }}</b></h5>
        </div>
        <div class="panel-body">
            @include('product::admin/attribute/value/form')
        </div>
    </div>
@stop
