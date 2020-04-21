@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Danh sách tag post <small>{{ $post->getTitle() }}</small>
                <div class="pull-right">
                    <a href="{{ route('admin.post.index') }}" class="btn btn-xs btn-default">Quay lại</a>
                </div>
                <div class="clearfix"></div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline mg-bt-10">
                        <input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tag" value="{{ Request::get('tag_name', '') }}">
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>

                        <div class="pull-right">
                            <a href="{{ route('admin.post.tag.create', [$post->getId()]) }}" class="btn btn-xs btn-primary"><i class="fa fa-tag"></i> Thêm tag</a>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="30">ID</th>
                                <th>Name</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $key => $tag)
                                <tr>
                                    <td>{{ $tag->getId() }}</td>
                                    <td>{{ $tag->getName() }}</td>
                                    <td width="30"><a href="{{ route('admin.post.tag.delete', [$post->getId(), $tag->getId()]) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
<script>
    $(function() {

    });
</script>
@stop