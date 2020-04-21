@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Danh sách danh mục
                <a href="{{ route('admin.category.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
                        <input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tên" value="{{ Request::get('name', '') }}">
                        <select name="type" class="form-control input-sm">
                            <option value="">Loại danh mục</option>
                            @foreach(category_get_type_options() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                    </form>
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Loại</th>
                                <th>Thứ tự</th>
                                <th>Trạng thái</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td width="50">{{ $category->getId() }}</td>
                                    <td>
                                        <a href="{{ $category->getUrl() }}" target="_blank"><?php for($i = 1 ; $i < $category->level; $i ++) echo '--'; ?>{{ $category->getName() }}</a>
                                    </td>
                                    <td>{{ $category->presenter()->getType() }}</td>
                                    <td><a <a href="" class="editable" data-name="sort" data-id="{{ $category->getId() }}" data-type="text" data-pk="{{ $category->getId() }}" data-url="{{ route('admin.category.ajax.editable', [$category->getId()]) }}" data-title="Thay đổi thứ tự">{{ $category->getSort() }}</a></td>
                                    <td width="30">
                                        {!! makeActiveButton(route('admin.category.toggleActive', $category->id), $category->active) !!}
                                    </td>
                                    <td width="30"><a href="{{ route('admin.category.edit', $category->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                    <td width="30">
                                        {!! makeDeleteButton(route('admin.category.delete', $category->getId())) !!}
                                    </td>
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
      $.fn.editable.defaults.mode = 'inline';
      $(function() {
         $('.editable').editable({
            showbuttons : true,
            params : {
               _token : '{{ csrf_token() }}'
            }
         });
      });
   </script>
@stop