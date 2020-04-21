@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				{{ trans('admin/general.modules.product') }}
				<a class="pull-right btn btn-primary btn-xs" href="{{ route('admin.product.create') }}">Tạo mới</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper row">
					<div class="form-inline col-sm-2">
						<select class="form-control input-sm action-delete-multi">
							<option value="">Thao tác</option>
							<option value="delete_multi">Xóa</option>
						</select>
					</div>
					<form method="get" action="" class="form-filter form-inline mg-bt-10 col-sm-10">
						<select class="form-control">
							<option value="">Danh mục</option>
							@foreach($categories as $item)
								<option value="{{ $item->getId() }}"><?php for($i = 0; $i < $item->level; $i ++) echo '--' ?>{{ $item->getName() }}</option>
							@endforeach
						</select>
						<input type="text" name="id" class="form-control search-box-modules input-sm" placeholder="ID sản phẩm" value="{{ Request::get('id', '') }}">
						<input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tên sản phẩm" value="{{ Request::get('name', '') }}">
						<input type="text" name="price" class="form-control search-box-modules input-sm" placeholder="Giá sản phẩm" value="{{ Request::get('price', '') }}">
						<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th><input type="checkbox" class="_all_options" name="_all_options"></th>
								<th>ID</th>
								<th>Ảnh</th>
								<th><a href="{{ build_sort_link('name', Request::fullUrl()) }}">Tên {!! get_icon_sort('name', Request::all()) !!}</a></th>
								<th><a href="{{ build_sort_link('price', Request::fullUrl()) }}">Giá {!! get_icon_sort('price', Request::all()) !!}</a></th>
								<th>Danh mục</th>
								<th>Thứ tự</th>
								<th>Ngày tạo</th>
								<th>Lần cuối</th>
								<th>Copy</th>
								<th>Atv</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $key => $product)
								<tr>
									<td width="30"><input type="checkbox" class="_option" name="option_{{ $product->getId() }}" value="{{ $product->getId() }}"></td>
									<td width="50">{{ $product->getId() }}</td>
									<td>
										<img style="display: block;" height="35" src="{{ $product->presenter()->getImage('sm_') }}" alt="">
										<a style="display: block; font-size: 10px; font-style: italic; color: blue; text-decoration: underline; margin: 5px 0" href="{{ route('admin.product.images', $product->getId()) }}">Ảnh ({{ $product->images ? $product->images->count() : 0 }})</a>
									</td>
									<td width="250">
										<div><a href="{{ $product->presenter()->getUrl() }}" title="{{ $product->getName() }}" data-pk="{{ $product->getId() }}" data-type="text" data-name="name" class="editable">{{ $product->getName() }}</a></div>
										<div style="font-size: 10px; color: #545454;">
											Slug: <a style="font-size: 10px; color: #545454; font-style: italic; display: inline-block; margin: 10px 0 0 0;" href="#" class="editable" data-pk="{{ $product->getId() }}" data-name="slug" data-type="text">{{ $product->getSlug() }}</a>
										</div>
									</td>
									<td>
										<a href="#" class="editable" data-pk="{{ $product->getId() }}" data-name="price" data-type="text">{!! $product->presenter()->getPrice() !!}</a>
									</td>
									<td>
										<span style="font-size: 11px;">{{ $product->category ? $product->category->getName() : '--' }}</span>
									</td>
									<td>
										<a href="#" class="editable" data-name="sort" data-id="{{ $product->getId() }}" data-type="text" data-pk="{{ $product->getId() }}" data-title="Thay đổi thứ tự">{{ $product->getSort() }}</a>
									</td>
									<td><span style="font-size: 10px;">{{ $product->getCreatedAt() }}</span></td>
									<td><span style="font-size: 10px;">{{ $product->getUpdatedAt() }}</span></td>
									<td width="25"><a data-toggle="tooltip" data-title="Nhân bản" data-placement="top" href="{{ route('admin.product.clone', $product->getId()) }}" class="bs-tooltip btn btn-xs btn-info"><i class="fa fa-clone"></i></a></td>
									<td width="25">{!! makeActiveButton(route('admin.product.toggleActive', $product->getId()), $product->active) !!}</td>
									<td width="25"><a href="{{ route('admin.product.edit', $product->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="25">
										{!! makeDeleteButton(route('admin.product.destroy', $product->getId())) !!}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="pull-right">
						{!! $products->links() !!}
					</div>
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
            url : '{{ route('admin.product.ajax.editable') }}',
            params : {
               _token : '{{ csrf_token() }}'
            }
        });

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
	    					url : "{{ route('admin.products.deleteMulti') }}",
	    					type : "POST",
	    					data : {
	    						product_ids : checkedIds,
	    						_token: '{{ csrf_token() }}'
	    					},
	    					success : function(response) {
	    						if(response.code == 1) {
	    							toastr.success("Xóa thành công", "Thông báo");
	    							setTimeout(function(){
	    								window.location.reload();
	    							}, 600);
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