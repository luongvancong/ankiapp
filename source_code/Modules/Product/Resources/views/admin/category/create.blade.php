@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
    	   <h3>Thêm nhóm sản phẩm</h3>
        </div>
    	<div class="panel-body">
    		@include('product::admin/category/form')
    	</div>
    </div>
@stop
