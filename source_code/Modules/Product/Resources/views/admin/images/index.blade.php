@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Ảnh chi tiết sản phẩm
                <a href="{{ route('admin.product.index') }}" class="pull-right btn btn-default btn-xs mg-l-10">Quay lại</a>
                <a class="pull-right btn btn-primary btn-xs" href="{{ route('admin.product.images.create', [$product->getId()]) }}">Tạo mới</a>
            </h4>
            <h5>{{ $product->getName() }}</h5>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <div class="all-form-top mg-bt-10">
                        <div class="form-inline">
                            <select class="form-control input-sm action-delete-multi">
                                <option value="">Thao tác</option>
                                <option value="delete_multi">Xóa</option>
                            </select>
                        </div>
                    </div>
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="_all_options" name="_all_options"></th>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Alt</th>
                                <th>Thứ tự</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $key => $image)
                                <tr>
                                    <td width="30" class="text-center"><input type="checkbox" class="_option" name="option_{{ $image->getId() }}" value="{{ $image->getId() }}"></td>
                                    <td width="50">{{ $image->getId() }}</td>
                                    <td>
                                        <img height="50" src="{{ $image->presenter()->getImage('sm_') }}" alt="">
                                    </td>
                                    <td>
                                        <a href="#" class="editable" data-name="image_alt" data-id="{{ $image->getId() }}" data-type="text" data-pk="{{ $image->getId() }}" data-url="{{ route('admin.product.images.editable', [$image->getId()]) }}" data-title="Thay đổi Alt">{{ $image->getImageAlt() }}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="editable" data-name="sort" data-id="{{ $image->getId() }}" data-type="text" data-pk="{{ $image->getId() }}" data-url="{{ route('admin.product.images.editable', [$image->getId()]) }}" data-title="Thay đổi thứ tự">{{ $image->sort }}</a>
                                    </td>
                                    <td width="30"><a href="{{ route('admin.product.images.destroy', [$product->getId(), $image->getId()]) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
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
        $('.editable').editable({
            showbuttons : true,
            params : {
               _token : '{{ csrf_token() }}'
            }
        });

        /**
         * Xóa nhiều bản ghi
         */
        $('._all_options').click(function(){
            $("input._option").prop('checked', $(this).prop("checked"));
        });

        $('.action-delete-multi').change(function() {
            var $this = $(this);
            var $checkedItems = $('input._option');
            var checkedIds = [];
            if($this.val() == 'delete_multi' && $('._option:checked').length) {
                if(confirm("Bạn có chắc chắn muốn xóa những bản ghi này?")) {
                    $('._option:checked').each(function() {
                        checkedIds.push($(this).val());
                    });

                    if(checkedIds.length) {
                        $.ajax({
                            url : "{{ route('admin.products.images.deleteMulti', $product->getId()) }}",
                            type : "POST",
                            data : {
                                record_ids : checkedIds,
                                _token: '{{ csrf_token() }}'
                            },
                            success : function(response) {
                                if(response.code == 1) {
                                    toastr.success("Xóa thành công", "Thông báo");
                                    window.location.reload();
                                }
                            }
                        });
                    }
                } else {
                    $this.val("");
                }
            } else {
                $this.val("");
            }
        });
    });
   </script>
@stop