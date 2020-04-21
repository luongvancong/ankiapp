<form class="form form-horizontal" method="POST">
    <div class="form-group">
        <label class="col-sm-3 control-label">Nội dung</label>
        <div class="col-sm-12">
            <textarea class="form-control ckeditor" name="answer">{{ old('answer', $answer->getAnswer()) }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-sm btn-primary">{{ trans('form.btn.update') }}</button>
        </div>
    </div>
</form>