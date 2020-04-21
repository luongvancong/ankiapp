@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
	<div class="panel-heading">
		<h3>
	      Sửa bài viết
	      <div class="pull-right">
	         <a href="{{ route('admin.post.index') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-circle-arrow-left"></i> Trở lại</a>
	      </div>
	   </h3>
	</div>
	<div class="panel-body">
		@include('post::admin/form')
	</div>
</div>

@stop