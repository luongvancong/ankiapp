@extends('admin/layouts/master')

@section('main-content')
	<div class="panel">
        <div class="panel-heading">
            <h3>Sửa Banner</h3>
        </div>
        <div class="panel-body">
            @include('banner::admin/form');
        </div>
    </div>
@stop

@section('scripts')
	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
@stop
