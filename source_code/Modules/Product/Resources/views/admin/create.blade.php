@extends('admin/layouts/master')

@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>{{ trans('admin/general.create_info') . ' ' . trans('admin/general.modules.products') }}</h3>
    </div>
    <div class="panel-body">
        @include('product::admin/form')
    </div>
</div>

@stop
