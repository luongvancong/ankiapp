<div class="panel-body">
    <form class="form-horizontal" action="" method="post" action enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group {{ hasValidator('image') }}">
            <label for="email" class="col-sm-3 control-label">Ảnh đại diện <b class="text-danger">*</b></label>
            <div class="col-sm-6">
                {!! gallery_init('image', 'image', $product->getImage()) !!}
                {!! alertError('image') !!}
            </div>
        </div>


        @if($product->getId() <= 0)
            <div class="form-group {{ hasValidator('images') }}">
                <label for="email" class="col-sm-3 control-label">Ảnh chi tiết (Chọn một hoặc nhiều) <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="file" name="images[]" multiple="true" class="form-control">
                    {!! alertError('images') !!}
                </div>
            </div>
        @endif

        <div class="form-group {{ hasValidator('category_id') }}">
            <label class="col-sm-3 control-label">Danh mục <b class="text-danger">*</b></label>
            <div class="col-sm-6">
                {!! getCategoriesHtmlSelectOption($categories, old('category_id', $product->category_id), ['class' => 'form-control']) !!}
                {!! alertError('category_id') !!}
            </div>
        </div>

        <div class="form-group {{ hasValidator('name') }}">
            <label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
            <div class="col-sm-6 text-center">
                <input type="text" class="form-control slug-source" value="{{ Request::old('name', $product->getName()) }}" name="name">
                {!! alertError('name') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Slug</label>
            <div class="col-sm-6 text-center">
                <input type="text" class="form-control slug-target" value="{{ Request::old('slug', $product->getSlug()) }}" name="slug">
            </div>
        </div>

        <div class="form-group {{ hasValidator('code') }}">
            <label for="email" class="col-sm-3 control-label">Mã</label>
            <div class="col-sm-6 text-center">
                <input type="text" class="form-control" value="{{ Request::old('code', $product->getCode()) }}" name="code">
                {!! alertError('code') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Giá</label>
            <div class="col-sm-3 text-center">
                <div class="input-group">
                    <input type="text" class="form-control price-source" data-target=".price-formatted" value="{{ Request::old('price', $product->getPrice()) }}" name="price">
                    <span class="input-group-addon price-formatted">{{ $product->presenter()->getPrice() }}</span>
                </div>

                {!! alertError('price') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Giá khuyến mãi</label>
            <div class="col-sm-3 text-center">
                <div class="input-group">
                    <input type="text" class="form-control price-source" data-target=".promotion-price-formatted" value="{{ Request::old('promotion_price', $product->getPromotionPrice()) }}" name="promotion_price">
                    <span class="input-group-addon promotion-price-formatted">{{ $product->presenter()->getPromotionPrice() }}</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Mô tả ngắn</label>
            <div class="col-sm-6 text-center">
                <textarea class="form-control" name="short_description">{{ old('short_description', $product->getShortDescription()) }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Mô tả</label>
            <div class="col-sm-12">
                <textarea class="form-control ckeditor" name="content">{{ old('content', $product->getContent()) }}</textarea>
            </div>
        </div>

        <hr>
        <h5 class="mg-bt-20"><b>Phần thông tin Metadata dành cho SEO</b></h5>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Meta title</label>
            <div class="col-sm-6 text-center">
                <input type="text" name="meta_title" value="{{ old('meta_title', $product->getMetaTitle()) }}" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Meta keyword</label>
            <div class="col-sm-6 text-center">
                <input type="text" name="meta_keyword" value="{{ old('meta_keyword', $product->getMetaKeyword()) }}" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Meta description</label>
            <div class="col-sm-6 text-center">
                <input type="text" name="meta_description" value="{{ old('meta_description', $product->getMetaDescription()) }}" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
            <a href="{{ url('/admin/products') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
            </div>
        </div>
    </form>
</div>