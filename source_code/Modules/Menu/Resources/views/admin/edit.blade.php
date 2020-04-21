@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>
          Edit menu <small>{{ $menu->getLabel() }}</small>
       </h3>
    </div>
    <div class="panel-body">
        @include('menu::admin/form')
    </div>
</div>

@stop