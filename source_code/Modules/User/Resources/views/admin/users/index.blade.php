@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				{{ trans('admin/general.modules.user') }}
				<a href="{{ route('user.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form-filter form-inline">
						<label>{{ trans('form.email') }} <input type="text" name="email" class="form-control search-box-modules input-sm" placeholder="Email" value="{{ Request::get('email', '') }}"></label>
						<label>{{ trans('form.phone') }} <input type="text" name="phone" class="form-control search-box-modules input-sm" placeholder="Phone" value="{{ Request::get('phone', '') }}"></label>
						<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<hr>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>{{ trans('form.avatar') }}</th>
								<th>{{ trans('form.nickname') }}</th>
								<th>{{ trans('form.email') }}</th>
								<th class="sorting" aria-sort="descending">{{ trans('form.name') }}</th>
								<th>Username</th>
								<th>{{ trans('form.phone') }}</th>
								<th colspan="2" align="center">{{ trans('table.actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $key => $user)
								<tr>
									<td>{{ $key + 1 }}</td>
									<td><img width="24" src="{{ parse_file_url($user->getAvatar()) }}" onerror="this.src='/images/profiles/lock_thumb.jpg'" alt="Avatar"></td>
									<td>{{ $user->username }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->nickname }}</td>
									<td>{{ $user->phone }}</td>
									<td>
										@if($user->id != 1)
											<a href="{{ route('user.edit', $user->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
											<a href="{{ route('user.destroy', $user->id) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $users->appends($_GET)->links() !!}
				</div>
			</div>
		</div>
	</section>
@stop
