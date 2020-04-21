@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
            <h3>Edit Testimonial</h3>
        </div>
        <div class="panel-body">
            @include('testimonial::admin/form');
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
