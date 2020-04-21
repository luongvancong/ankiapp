<form class="form form-horizontal" method="POST">
    <div class="form-group {{ hasValidator('name') }}">
        <label class="control-label col-sm-3">Tên</label>
        <div class="col-sm-6">
            <input type="text" name="name" value="{{ old('name', $attribute->getName()) }}" class="form-control">
            {!! alertError('name') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-sm btn-primary">{{ trans('form.btn.update') }}</button>
        </div>
    </div>
</form>