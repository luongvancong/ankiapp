@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Danh sách tag sản phẩm <small>{{ $product->getName() }}</small>
                <div class="pull-right">
                    <a href="{{ route('admin.product.tag.create', [$product->getId()]) }}" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Thêm tag</a>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-xs btn-default">Quay lại</a>
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
                                    <td width="30"><a href="{{ route('admin.product.tag.delete', [$product->getId(), $tag->getId()]) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
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