@extends('admin/layouts/master')

@section('main-content')
    <div class="panel">
        <div class="panel-heading">
            <h3>
                Tài nguyên
                <div class="pull-right">
                    <a href="{{ route('admin.resource.create') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
                </div>
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh đại diện</th>
                        <th>Alt</th>
                        <th>Tên</th>
                        <th>Size</th>
                        <th>Width</th>
                        <th>Height</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resources as $item)
                        <tr>
                            <td>{{ $item->getId() }}</td>
                            <td>
                                @if(in_array($item->getExtension(), ['jpg', 'jpeg', 'png', 'bmp', 'gif']))
                                    <img src="{{ parse_file_url($item->getName()) }}" height="50">
                                @else
                                    <i class="fa fa-cubes fa-4x"></i>
                                @endif
                            </td>
                            <td>
                                <a href="" class="editable" data-name="alt" data-pk="{{ $item->getId() }}" data-type="text">{{ $item->getAlt() }}</a>
                            </td>
                            <td>{{ substr($item->getName(), 0, 20) . '....'. $item->getExtension() }}</td>
                            <td>{{ number_format($item->getSize()/1000/1000, 3) }} MB</td>
                            <td>{{ $item->getWidth() }}</td>
                            <td>{{ $item->getHeight() }}</td>

                            <td width="30">
                                {!! makeDeleteButton(route('admin.resource.delete', $item->getId())) !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right">
                {!! $resources->links() !!}
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>

      $(function() {
         $('.editable').editable({
            showbuttons : true,
            url : '{{ route('admin.resource.ajax.editable') }}',
            params : {
               _token : '{{ csrf_token() }}'
            }
         });
      });
   </script>
@stop