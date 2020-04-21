<form class="form-horizontal" method="post" action enctype="multipart/form-data">

   <div class="form-group {{ hasValidator('title') }}">
      <label for="email" class="col-sm-3 control-label">Tiêu đề <b class="text-danger">*</b></label>
      <div class="col-sm-6 text-center">
         <input type="text" class="form-control" value="{{ Request::old('title', $page->getTitle()) }}" name="title">
         {!! alertError('title') !!}
      </div>
   </div>

   <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Slug</label>
      <div class="col-sm-6 text-center">
         <input type="text" class="form-control" value="{{ Request::old('slug', $page->getSlug()) }}" name="slug">
      </div>
   </div>

   <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Ảnh đại diện <b class="text-danger">*</b></label>
      <div class="col-sm-6">

         <div class="row">
            {{-- <div class="col-sm-6">
               <input type="file" class="form-control" name="image">
            </div> --}}
            <div class="col-sm-6">
               {!! gallery_init('image', 'image', old('image', $page->getImage())) !!}
            </div>
            <div class="col-sm-6">
               <input type="text" name="image_alt" class="form-control" placeholder="Alt">
            </div>
         </div>
      </div>
   </div>

   <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Nội dung <b class="text-danger">*</b></label>
      <div class="col-sm-12">
         <textarea class="form-control ckeditor" name="content">{!! $page->getContent() !!}</textarea>
      </div>
   </div>


   <hr>
   <h5 class="mg-bt-20"><b>Phần thông tin Metadata dành cho SEO</b></h5>

   <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Meta title</label>
      <div class="col-sm-6 text-center">
         <input type="text" name="meta_title" value="{{ old('meta_title', $page->getMetaTitle()) }}" class="form-control">
      </div>
   </div>
   <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Meta keyword</label>
      <div class="col-sm-6 text-center">
         <input type="text" name="meta_keyword" value="{{ old('meta_keyword', $page->getMetaKeyword()) }}" class="form-control">
      </div>
   </div>
   <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Meta description</label>
      <div class="col-sm-6 text-center">
         <input type="text" name="meta_description" value="{{ old('meta_description', $page->getMetaDescription()) }}" class="form-control">
      </div>
   </div>

   <div class="form-group">
      <div class="col-sm-6 col-sm-offset-3">
         {!! csrf_field() !!}
         <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
      </div>
   </div>
</form>