<form class="form form-horizontal" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label col-sm-3">Ảnh nhân vật</label>
        <div class="col-sm-6">
            {!! gallery_init('feedback-avatar', 'avatar', old('avatar', $feedback->getAvatar())) !!}
        </div>
    </div>
    <div class="form-group {{ hasValidator('name') }}">
        <label class="control-label col-sm-3">Họ và tên</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" name="name" value="{{ old('name', $feedback->getName()) }}">
            {!! alertError('name') !!}
        </div>
    </div>
    <div class="form-group {{ hasValidator('profession') }}">
        <label class="control-label col-sm-3">Nghề nghiệp</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" name="profession" value="{{ old('profession', $feedback->getProfession()) }}">
            {!! alertError('profession') !!}
        </div>
    </div>
    <div class="form-group {{ hasValidator('comment') }}">
        <label class="control-label col-sm-3">Bình luận</label>
        <div class="col-sm-6">
            <textarea class="form-control" type="text" name="comment" rows="10">{{ old('comment', $feedback->getComment()) }}</textarea>
            {!! alertError('comment') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-sm btn-primary">{{ trans('form.btn.update') }}</button>
        </div>
    </div>
</form>