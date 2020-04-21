@extends('admin/layouts/master')

{{-- Page content --}}
@section('main-content')
<div class="panel">
	<div class="panel-heading">
		<h3>
			Quản lý bài viết
			<div class="pull-right">
				<a href="{{ route('admin.post.create') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Thêm mới</a>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
			<input type="text" name="title" class="form-control search-box-modules input-sm" placeholder="Tiêu đề tin" value="{{ Request::get('title', '') }}">
			<select class="form-control input-sm" name="category_id">
				<option value="">--Danh mục--</option>
				@foreach($categories as $cat)
				<option value="{{ $cat->getId() }}" {{ $cat->getId() == Request::get('category_id') ? 'selected="selected"' : '' }}><?php for($i = 1; $i < $cat->level; $i ++) echo '--'; ?>{{ $cat->getName() }}</option>
				@endforeach
			</select>
			<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
		</form>
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ build_sort_link('id', Request::fullUrl()) }}">ID {!! get_icon_sort('id', Request::all()) !!}</a></th>
					<th><a href="{{ build_sort_link('title', Request::fullUrl()) }}">Tiêu đề {!! get_icon_sort('title', Request::all()) !!}</a></th>
					<th>Danh mục</th>
					<th>Ngày tạo</th>
					<th>Cập nhật lần cuối</th>
					<th width="30">Atv</th>
					<th width="30">Edit</th>
					<th width="30">Del</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($posts as $post)
					<tr>
						<td width="50">{{ $post->getId() }}</td>
						<td>
							<p>
								Tiêu đề: <a href="" class="editable" data-name="title" data-pk="{{ $post->getId() }}" data-type="text">{{ $post->getTitle() }}</a>
							</p>
							<p>
								Slug: <a href="" class="editable" data-name="slug" data-pk="{{ $post->getId() }}" data-type="text">{{ $post->getSlug() }}</a>
							</p>
						</td>
						<td>
							{{ $post->category ? $post->category->getName() : '--' }}
						</td>
						<td>{{ $post->getCreatedAt() }}</td>
						<td>{{ $post->getUpdatedAt() }}</td>
						<td class="text-center">{!! makeActiveButton(route('admin.post.active', [$post->getId()]), $post->active) !!}</td>
						<td class="text-center">{!! makeEditButton(route('admin.post.edit', [$post->getId()])) !!}</td>
						<td class="text-center">{!! makeDeleteButton(route('admin.post.delete', [$post->getId()])) !!}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-right">
			{!! $posts->appends($_GET)->links() !!}
		</div>
	</div>
</div>

@stop

@section('scripts')
<script>
    $(function() {
        $('.editable').editable({
            showbuttons : true,
            url : '{{ route('admin.post.ajax.editable') }}',
            params : {
               _token : '{{ csrf_token() }}'
            }
        });
    });
</script>
@stop