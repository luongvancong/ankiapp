@extends('admin/layouts/master')

@section('main-content')
    <h3>Chỉnh sửa Tag</h3>
    <div class="panel-body">
        @include('tag::admin/form')
    </div>
@stop

@section('scripts')
<script>
    $(function() {
        $('#name').on('keyup', function() {
            var slug = removeAccents($(this).val());
            slug = strSlug(slug, '-');
            console.log($(this).val());
            console.log(slug);
            $('#slug').val(slug);
        });
    });
</script>
@stop
