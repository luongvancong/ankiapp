<form action="" class="form form-horizontal" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group {{ hasValidator('title') }}">
        <label class="control-label col-sm-3">Tiêu đề <b class="text-danger">*</b></label>
        <div class="col-sm-6">
            <input type="text" name="title" value="{{ old('title', $post->getTitle()) }}" class="form-control btn-flat">
            {!! alertError('title') !!}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3">Slug</label>
        <div class="col-sm-6">
            <input type="text" name="slug" value="{{ old('slug', $post->getSlug()) }}" class="form-control btn-flat">
        </div>
    </div>

    <div class="form-group {{ hasValidator('category_id') }}">
        <label class="col-sm-3 control-label">Danh mục tin <b class="text-danger">*</b></label>
        <div class="col-sm-6">
            <select class="form-control" name="category_id">
            <option value="">Chọn một danh mục</option>
            @foreach($categories as $item)
                <option value="{{ $item->getId() }}" {{ $item->getId() == old('category_id', $post->getCategoryId()) ? 'selected="selected"' : '' }}><?php for($i = 1; $i < $item->level; $i ++) echo '--'; ?>{{ $item->getName() }}</option>
            @endforeach
            </select>
            {!! alertError('category_id') !!}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3">Ảnh minh họa</label>
        <div class="col-sm-6">
            {{-- <input type="file" name="image" class="form-control btn-flat"> --}}
            {!! gallery_init('post-image', 'image', old('image', $post->image)) !!}
            <input type="text" name="image_alt" class="form-control" placeholder="Alt">
        </div>
    </div>

    <div class="form-group {{ hasValidator('teaser') }}">
        <label class="control-label col-sm-3">Mô tả ngắn</label>
        <div class="col-sm-6">
            <textarea name="teaser" class="form-control btn-flat" rows="10">{{ old('teaser', $post->getTeaser()) }}</textarea>
            {!! alertError('teaser') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('content') }}">
        <label class="control-label col-sm-2">Nội dung</label>
        <div class="col-sm-12">
            <textarea name="content" class="form-control btn-flat content ckeditor">{!! old('content', $post->getContent()) !!}</textarea>
            {!! alertError('content') !!}
        </div>
    </div>

    <div class="tag-container">
        <hr>
        <h5 class="mg-bt-20"><b>Tag</b></h5>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" id="tag" placeholder="Nhập tag" name="tag" value="" class="form-control">
            </div>
        </div>
    </div>

    <hr>
    <h5 class="mg-bt-20"><b>Phần thông tin Metadata dành cho SEO</b></h5>

    <div class="form-group {{ hasValidator('meta_title') }}">
        <label for="email" class="col-sm-3 control-label">Meta title</label>
        <div class="col-sm-6 text-center">
            <input type="text" name="meta_title" value="{{ old('meta_title', $post->getMetaTitle()) }}" class="form-control">
            {!! alertError('meta_title') !!}
        </div>
    </div>
    <div class="form-group {{ hasValidator('meta_keyword') }}">
        <label for="email" class="col-sm-3 control-label">Meta keyword</label>
        <div class="col-sm-6 text-center">
            <input type="text" name="meta_keyword" value="{{ old('meta_keyword', $post->getMetaKeyword()) }}" class="form-control">
            {!! alertError('meta_keyword') !!}
        </div>
    </div>
    <div class="form-group {{ hasValidator('meta_description') }}">
        <label for="email" class="col-sm-3 control-label">Meta description</label>
        <div class="col-sm-6 text-center">
            <input type="text" name="meta_description" value="{{ old('meta_description', $post->getMetaDescription()) }}" class="form-control">
            {!! alertError('meta_description') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            <button type="submit" class="btn btn-sm btn-flat btn-primary">Cập nhật</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function() {
        $('#tag').tagsInput({
            autocomplete_url: '{{ route('admin.tag.ajax.tag.input') }}',
            defaultText: "Thêm tag"
        });

        @if($post->exists())
            @foreach($post->tags()->get() as $t)
                $('#tag').addTag('{{ $t->getName() }}');
            @endforeach
        @endif
    });
</script>