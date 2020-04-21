@extends('admin/layouts/master')

@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.products') }}</h3>
    </div>
    <div class="panel-body">
        @include('product::admin/form')
    </div>
</div>
@stop

@section('scripts')
<script>
	$(function() {

	});
</script>
@stop