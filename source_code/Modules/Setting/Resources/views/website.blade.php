@extends('admin/layouts/master')
@section('styles')
	<link rel="stylesheet" href="/js/bootstrap-fileupload/bootstrap-fileupload.css">
@stop

@section('main-content')
	<div class="panel">
		<div class="panel-heading">
			<h3>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.site') }}</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" method="post" action="{{ url('/admin/settings/website') }}" enctype="multipart/form-data">
				@foreach($settings as $item)
					<div class="form-group">
						<label for="logo" class="col-sm-3 control-label">{{ $item['label'] }}</label>
						<div class="controls col-sm-9">
							{!! $item->renderControl() !!}
						</div>
					</div>
				@endforeach
				{!! csrf_field() !!}
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button class="btn btn-primary">{{ trans('form.btn.update') }}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
@section('scripts')
<script src="/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
@stop