@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
            <h3>Thêm tài nguyên</h3>
        </div>
        <div class="panel-body">
            <form class="form form-horizontal" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-sm-3">Chọn file từ máy tính</label>
                    <div class="col-sm-6">
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop