@extends('admin/layouts/master')

@section('main-content')
    <h3>Thêm tag sản phẩm</h3>
    <small>{{ $product->getName() }}</small>

    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

            <div class="form-group {{ hasValidator('tags') }}">
                <label for="email" class="col-sm-2 control-label">Tags</label>
                <div class="col-sm-6 text-center">
                    <input type="text" id="tags" class="form-control" value="{{ Request::old('tags') }}" name="tags">
                    <p class="help-inline text-left">Mỗi từ cách nhau bằng dấu phẩy</p>
                    {!! alertError('tags') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
                <a href="{{ route('admin.post.tag.index', [$product->getId()]) }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>
@stop

@section('scripts')
<script>
    $(function() {
        $('#tags').tokenInput('{{ route("admin.tag.ajax.search") }}', {
            theme : 'facebook'
        });
    });
</script>
@stop