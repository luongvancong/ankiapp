<form class="form form-horizontal" method="POST">
    <div class="form-group {{ hasValidator('value') }}">
        <label class="control-label col-sm-3">Giá trị</label>
        <div class="col-sm-6">
            <input type="text" name="value" value="{{ old('value', $value->getValue()) }}" class="form-control">
            {!! alertError('value') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-sm btn-primary">{{ trans('form.btn.update') }}</button>
        </div>
    </div>
</form>