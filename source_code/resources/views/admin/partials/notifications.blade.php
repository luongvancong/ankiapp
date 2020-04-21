<ul>
	@foreach ($errors->all() as $error)
		<li class="text-danger">{{ $error }}</li>
	@endforeach
	@if (session('message'))
		<li class="text-danger">{{ session('message') }}</li>
		@if (session('countLoginFails'))
			<li class="text-danger">{{ trans('admin/validation.msg-throttle-login', ['count' => session('countLoginFails')]) }}</li>
		@endif
	@endif
</ul>