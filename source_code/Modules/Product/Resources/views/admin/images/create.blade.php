@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Ảnh chi tiết sản phẩm
            </h4>
            <h5>{{ $product->getName() }}</h5>
        </header>
        <div class="panel-body">
            <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group {{ hasValidator('images') }}">
                    <label for="email" class="col-sm-3 control-label">Chọn một hoặc nhiều <b class="text-danger">*</b></label>
                    <div class="col-sm-6 text-center">
                        <input type="file" name="images[]" multiple="true" class="form-control">
                        {!! alertError('images') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ url('/admin/products') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop
