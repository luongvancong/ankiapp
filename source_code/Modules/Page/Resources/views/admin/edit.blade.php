@extends('admin/layouts/master')

@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>Sửa trang <small>{{ $page->getTitle() }}</small></h3>
    </div>
    <div class="panel-body">
        @include('page::admin/form')
   </div>
</div>
@stop