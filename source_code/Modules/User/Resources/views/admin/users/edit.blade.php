@extends('admin/layouts/master')

@section('main-content')
	<div class="panel">
		<div class="panel-heading">
			<h3>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.users') }}</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
				<div class="form-group">
					<label for="email" class="col-sm-3 control-label">{{ trans('form.avatar') }}</label>
					<div class="col-sm-6 text-center">
						<p><img height="90" src="{{ parse_file_url($user->getAvatar()) }}" onerror="this.src='/images/profiles/lock_thumb.jpg'" alt="Avatar"></p>
						<input type="file" name="avatar" class="form-control">
					</div>
				</div>
				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label for="email" class="col-sm-3 control-label">{{ trans('form.email') }} <b class="text-danger">*</b></label>
					<div class="col-sm-6">
				   	<input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('form.email') }}" value="{{ Request::old('email', $user->email) }}">
				   	{!! $errors->first('email', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>
				<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
					<label for="username" class="col-sm-3 control-label">Username <b class="text-danger">*</b></label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ Request::old('username', $user->username) }}" />
						{!! $errors->first('username', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>
				<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
					<label for="nickname" class="col-sm-3 control-label">{{ trans('form.nickname') }} <b class="text-danger">*</b></label>
					<div class="col-sm-6">
				   	<input type="text" class="form-control" id="nickname" name="nickname" placeholder="{{ trans('form.nickname') }}" value="{{ Request::old('nickname', $user->nickname) }}">
				   	{!! $errors->first('nickname', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">{{ trans('form.name') }} <b class="text-danger">*</b></label>
					<div class="col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
				   	<input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('form.name') }}" value="{{ Request::old('name', $user->name) }}">
				   	{!! $errors->first('name', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>
				<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
					<label for="phone" class="col-sm-3 control-label">{{ trans('form.phone') }} <b class="text-danger">*</b></label>
					<div class="col-sm-6">
				   	<input type="text" class="form-control" id="phone" name="phone" placeholder="{{ trans('form.phone') }}" value="{{ Request::old('phone', $user->phone) }}">
				   	{!! $errors->first('phone', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>
				<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
					<label for="address" class="col-sm-3 control-label">{{ trans('form.address') }} <b class="text-danger">*</b></label>
					<div class="col-sm-6">
				   	<input type="text" class="form-control" id="address" name="address" placeholder="{{ trans('form.address') }}" value="{{ Request::old('address', $user->address) }}">
				   	{!! $errors->first('address', '<span class="help-inline text-danger">:message</span>') !!}
					</div>
				</div>


				<div class="form-group">
					<label for="role_name" class="col-sm-3 control-label">{{ trans('form.role_name') }}</label>
					<div class="col-sm-6">
						<div class="role-list list-unstyled checkbox-list">
							<div>
								<label for="checkbox_all" class="text-danger noselect">
									<input type="checkbox" id="checkbox_all" class="checkbox_all"> Chọn tất cả
								</label>
							</div>
							@foreach ($permissionGroups as $groupName => $permissionItems)
								<div class="permission-group">
									<div class="permission-group-name">{{ $groupName }}</div>
									@foreach ($permissionItems as $item)
										<div class="permission-item">
											<label class="tooltips noselect" for="role_{{ $item->name }}" data-placement="top" data-toggle="tooltip" data-original-title="{{ $item->description }}">
												<input class="checkbox-child"
													   type="checkbox"
													   id="role_{{ $item->name }}"
													   name="permissions[]"
													   <?php echo $oldPermissions->search(function ($value, $k) use($item) { return $value->name === $item->name; }) !== false ? "checked": "" ?>
													   value="{{ $item->name }}" /> {{ $item->display_name }}
												<p class="text-muted">{{ $item->name }}</p>
											</label>
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
				   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
				   	<a href="{{ url('/admin/users') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
					</div>
				</div>
				{!! csrf_field() !!}
			</form>
		</div>
	</div>


@stop
