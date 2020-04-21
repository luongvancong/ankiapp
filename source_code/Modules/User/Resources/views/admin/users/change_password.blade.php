@extends('admin/layouts/master')

@section('main-content')

<div class="panel">
    <div class="panel-body">
        <h3>Change password</h3>
        <form class="form form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="form-group {{ hasValidator('old_password') }}">
                <label class="control-label col-sm-3">Old password</label>
                <div class="col-sm-6">
                    <input type="password" name="old_password" value="" class="form-control">
                    {!! alertError('old_password') !!}
                </div>
            </div>
            <div class="form-group {{ hasValidator('new_password') }}">
                <label class="control-label col-sm-3">New password</label>
                <div class="col-sm-6">
                    <input type="password" name="new_password" value="" class="form-control">
                    {!! alertError('new_password') !!}
                </div>
            </div>
            <div class="form-group {{ hasValidator('repeat_password') }}">
                <label class="control-label col-sm-3">Repeat</label>
                <div class="col-sm-6">
                    <input type="password" name="repeat_password" value="" class="form-control">
                    {!! alertError('repeat_password') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-sm btn-primary">{{ trans('form.btn.update') }}</button>
                    <a href="{{ route('user.index') }}" class="pull-right">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>


@stop