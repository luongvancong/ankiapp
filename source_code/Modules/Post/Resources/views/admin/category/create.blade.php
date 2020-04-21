@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
    	   <h3>Thêm nhóm tin</h3>
        </div>
    	<div class="panel-body">
    		@include('post::admin/category/form')
    	</div>
    </div>
@stop
