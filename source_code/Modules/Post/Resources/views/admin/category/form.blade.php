<form class="form-horizontal" method="post" action enctype="multipart/form-data">
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Danh mục cha</label>
        <div class="col-sm-6">
            <select name="parent_id" class="form-control">
                <option value="0">Chọn danh mục cha</option>
                @foreach($categories as $c)
                <option value="{{ $c->getId() }}" {{ $category->getParentId() == $c->getId() ? 'selected="selected"' : '' }} {{ old('parent_id', $category->getId()) == $c->getId() ? 'disabled' : '' }}><?php for($i = 1; $i < $c->level; $i ++) echo '--'; ?>{{ $c->getName() }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group {{ hasValidator('name') }}">
        <label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('name', $category->getName()) }}" name="name">
            {!! alertError('name') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('slug') }}">
        <label for="email" class="col-sm-3 control-label">Slug</label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('slug', $category->getSlug()) }}" name="slug">
            {!! alertError('slug') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Ảnh minh họa</label>
        <div class="col-sm-6">
            {!! gallery_init('category-image', 'background', $category->background) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Mô tả ngắn</label>
        <div class="col-sm-6">
            <textarea class="form-control" name="short_description">{{ old('short_description', $category->getShortDescription()) }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
        <a href="{{ route('admin.post_category.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
        </div>
    </div>
    {!! csrf_field() !!}
</form>