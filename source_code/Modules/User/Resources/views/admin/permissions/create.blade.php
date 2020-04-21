@extends('admin/layouts/master')

@section('main-content')
	<div class="panel">
		<div class="panel-heading">
			<h3>{{ trans('admin/general.create_info') . ' ' . trans('admin/general.modules.permissions') }}</h3>
		</div>

		<div class="panel-body">
			<form class="form-horizontal" method="POST">
				<div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
					<label for="display_name" class="col-sm-3 control-label">{{ trans('form.perm_name') }} <b class="text-danger">*</b></label>
					<div class="col-sm-6">
						<input type="display_name" class="form-control" id="display_name" name="display_name" placeholder="{{ trans('form.perm_name') }}" value="{{ Request::old('display_name') }}" />
						<i class="help-inline text-muted">Ex: Edit blog</i>
						{!! $errors->first('display_name', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>
				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label for="name" class="col-sm-3 control-label">{{ trans('form.perm_key') }} <b class="text-danger">*</b></label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('form.perm_key') }}" value="{{ Request::old('name') }}" />
						<i class="help-inline text-muted">Cú pháp: Nhóm quyền:Mã quyền, Ex: blog:edit</i>
						{!! $errors->first('name', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-sm-3 control-label">{{ trans('form.description') }}</label>
					<div class="col-sm-6">
						<textarea class="form-control" id="description" name="description" placeholder="{{ trans('form.description') }}">{{ Request::old('description') }}</textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
						<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
					</div>
				</div>
				{!! csrf_field() !!}
			</form>
		</div>
	</div>


@stop
