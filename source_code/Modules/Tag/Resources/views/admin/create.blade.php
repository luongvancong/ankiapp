@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
            <h3>Thêm Tag</h3>
        </div>
        <div class="panel-body">
            @include('tag::admin/form')
        </div>
    </div>
@stop

@section('scripts')
<script>
    $(function() {
        $('#name').on('keyup', function() {
            var slug = removeAccents($(this).val().toLowerCase());
            slug = strSlug(slug, '-');
            console.log($(this).val());
            console.log(slug);
            $('#slug').val(slug);
        });
    });
</script>
@stop