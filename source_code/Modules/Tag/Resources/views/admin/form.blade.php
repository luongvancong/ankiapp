<form class="form-horizontal" method="post" action enctype="multipart/form-data">
    <div class="form-group {{ hasValidator('name') }}">
        <label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('name', $tag->getName()) }}" id="name" name="name">
            {!! alertError('name') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Slug</label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('slug', $tag->getSlug()) }}" id="slug" name="slug">
        </div>
    </div>

    <div class="form-group {{ hasValidator('meta_title') }}">
        <label for="email" class="col-sm-3 control-label">Meta title</label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('meta_title', $tag->meta_title) }}" name="meta_title">
            {!! alertError('meta_title') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('meta_keywords') }}">
        <label for="email" class="col-sm-3 control-label">Meta keywords</label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('meta_keywords', $tag->meta_keywords) }}" name="meta_keywords">
            {!! alertError('meta_keywords') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('meta_description') }}">
        <label for="email" class="col-sm-3 control-label">Meta description</label>
        <div class="col-sm-6 text-center">
            <textarea class="form-control" name="meta_description">{{ Request::old('meta_description', $tag->meta_description) }}</textarea>
            {!! alertError('meta_description') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
        <a href="{{ route('admin.tag.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
        </div>
    </div>
    {!! csrf_field() !!}
</form>

<script type="text/javascript">
    $(function() {
        $('[name="name"]').on('change', function() {
            var $this = $(this);
            var $slug = $('[name="slug"]');
            $slug.value(removeAccents($this.val()));
        });
    });
</script>