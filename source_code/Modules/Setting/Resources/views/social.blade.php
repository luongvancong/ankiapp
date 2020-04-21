@extends('admin/layouts/master')

@section('main-content')
	<div class="panel">
		<div class="panel-heading">
			<h3>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.social') }}</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" method="post" action="{{ url('/admin/settings/social') }}" enctype="multipart/form-data">
				@foreach($settings as $item)
					<div class="form-group">
						<label for="logo" class="col-sm-3 control-label">{{ $item['label'] }}</label>
						<div class="controls col-sm-9">
							{!! $item->renderControl() !!}
						</div>
					</div>
				@endforeach

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
						<a href="{{ url('/admin/settings/social') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
					</div>
				</div>

				{!! csrf_field() !!}
			</form>
		</div>
	</div>
@stop