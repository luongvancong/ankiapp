@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
    <div class="panel-heading">
        <h3>
           Menu
           <a class="pull-right btn btn-xs btn-primary" href="{{ route('admin.menu.create') }}">Thêm mới</a>
           <a class="pull-right btn btn-xs btn-danger mg-r-10" href="{{ route('admin.menu.optimize') }}">Optimize</a>
       </h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover table-bordered">
            <thead>
                <th>STT</th>
                <th>ID</th>
                <th>Name</th>
                <th>Url</th>
                <th>Thứ tự</th>
                <th>Updated at</th>
                <th>Active</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php
                    $page = (int) Request::get('page', 1);
                    $no = 0
                ?>
                @foreach($menus as $item)
                    @php $no ++ @endphp
                    <tr id="{{ $item->getId() }}" data-has_child="{{ $item->has_child }}" data-deep="{{ $item->level }}">
                        <td>{{ $no }}</td>
                        <td>{{ $item->getId() }}</td>
                        <td><?php for($i = 0; $i < $item->level; $i ++) echo '--'; ?><a href="" class="editable" data-name="label" data-pk="{{ $item->getId() }}" data-type="text">{{ $item->getLabel() }}</a></td>
                        <td>
                            @if($item->getType() == Modules\Menu\Repositories\Menu::TYPE_CUSTOM)
                                <a href="" class="editable" data-name="url" data-pk="{{ $item->getId() }}" data-type="text">{{ $item->getUrl() }}</a>
                            @else
                                {{ $item->getUrl() }}
                            @endif
                        </td>
                        <td><a href="" class="editable" data-name="sort" data-pk="{{ $item->getId() }}" data-type="text">{{ $item->getSort() }}</a></td>
                        <td>{{ $item->getUpdatedAt() }}</td>
                        <td width="30">{!! makeActiveButton(route('admin.menu.active', $item->getId()), $item->getActive()) !!}</td>
                        <td width="30">{!! makeEditButton(route('admin.menu.edit', [$item->getId(), 'type' => $item->getType()])) !!}</td>
                        <td width="30">{!! makeDeleteButton(route('admin.menu.delete', $item->getId())) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop


@section('scripts')
<script type="text/javascript">
    $(function() {
        $('.editable').editable({
            showbuttons : true,
            url : '{{ route('admin.menu.ajax.editable') }}',
            params : {
               _token : '{{ csrf_token() }}'
            }
        });
    });
</script>
@endsection