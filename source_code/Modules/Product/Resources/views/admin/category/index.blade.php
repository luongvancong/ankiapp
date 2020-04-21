@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Danh sách nhóm sản phẩm
				<div class="pull-right">
					<a href="{{ route('admin.product_category.optimize') }}" class="btn btn-xs btn-danger"><i class="fa fa-plus"></i> Optimize</a>
					<a href="{{ route('admin.product_category.create') }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
				</div>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
						<input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Nhóm sản phẩm" value="{{ Request::get('name', '') }}">
						<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tên</th>
								<th>Slug</th>
								<th>Sản phẩm</th>
								<th>Thuộc tính</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $key => $category)
								<tr>
									<td width="50">{{ $category->getId() }}</td>
									<td>
										<?php for($i = 0; $i < $category->level; $i ++) echo '--'; ?>
										<a href="" class="editable" data-pk="{{ $category->getId() }}" data-name="name" data-type="text">{{ $category->getName() }}</a>
									</td>
									<td>
										<a href="" class="editable" data-pk="{{ $category->getId() }}" data-name="slug" data-type="text">{{ $category->getSlug() }}</a>
									</td>
									<td>{{ $category->products()->count() }}</td>
									<td><a href="{{ route('admin.product_attribute.index', $category->getId()) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-title="Thuộc tính" data-placement="top">{{ $category->attributes()->count() }}</a></td>
									<td width="30"><a href="{{ route('admin.product_category.edit', $category->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30">
										{!! makeDeleteButton(route('admin.product_category.delete', $category->getId())) !!}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(function() {
			$('.editable').editable({
	            showbuttons : true,
	            url: "{{ route('admin.category.ajax.editable') }}",
	            params : {
	               _token : '{{ csrf_token() }}'
	            }
	        });
		});
	</script>
@stop