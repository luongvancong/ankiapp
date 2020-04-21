@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
            <h3>
                Thêm Testimonial
                <div class="pull-right">
                    <a href="{{ route('admin.testimonial.index') }}" class="btn btn-xs btn-default">Quay lại</a>
                </div>
            </h3>
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
