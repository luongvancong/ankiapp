<div class="panel">
    <div class="panel-heading">
        Tùy chỉnh
    </div>
</div>

@include('menu::admin/partials/general-control')

<div class="form-group {{ hasValidator('url') }}">
    <label class="control-label"><b class="text-danger">*</b> Đường dẫn</label>
    <input type="text" name="url" value="{{ $menu->getUrl() }}" class="form-control" placeholder="http://">
    {!! alertError('url') !!}
</div>
