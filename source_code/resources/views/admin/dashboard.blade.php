@extends('admin/layouts/master')

@section('main-content')
	<div class="panel">
		<div class="panel-heading">
			<h1>{{ trans('admin/general.modules.dashboard') }}</h1>
		</div>
		<div class="panel-body">
			<h5>Welcome to admin dashboard</h5>
			<div class="row">
			<?php
				$btnClassArray = ['btn-primary', 'btn-success', 'btn-info', 'btn-danger', 'btn-warning', 'btn-default'];
			?>
			@foreach(admin_sidebar() as $item)
                @if(isset($item['permission']) && auth()->user()->can($item['permission']) && array_get($item, 'active') == 1 || auth()->user()->can('root:root') && array_get($item, 'active') == 1)
					<?php
						$btnClass = $btnClassArray[array_rand($btnClassArray)];
					?>
					<div class="col-sm-2 mg-bt-20">
						<a style="display: block;" class="btn {{ $btnClass }} {{ isset($item['pattern_active']) ? (Request::is($item['pattern_active']) ? 'active': '') : '' }}" href="{{ array_get($item, 'url') }}">
							<i class="{{ array_get($item, 'icon') }} fa-3x pull-left"></i>
							<span>{{ array_get($item, 'title') }}</span>
							<span class="clearfix"></span>
						</a>
					</div>
                @endif
            @endforeach
            </div>
		</div>
	</div>
@stop