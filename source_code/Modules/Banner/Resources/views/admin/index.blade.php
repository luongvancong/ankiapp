@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Quản lý banner
				<a href="{{ route('admin.banner.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form form-inline mg-bt-10">
						<select name="position" class="form-control input-sm">
							<option value="">Vị trí</option>
							@foreach($positionList as $key => $value)
							<option value="{{ $key }}" {{ Request::get('position') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
							@endforeach
						</select>

						<select name="_page" class="form-control input-sm">
							<option value="">Trang đích</option>
							@foreach($pageList as $key => $value)
							<option value="{{ $key }}" {{ Request::get('page') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
							@endforeach
						</select>
						<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
						<tr>
							<th>ID</th>
							<th>Thứ tự</th>
							<th>Ảnh</th>
							<th>Tiêu đề</th>
							<th>Link</th>
							<th width="30">Kích hoạt</th>
							<th width="30">Sửa</th>
							<th width="30">Xóa</th>
						</tr>
						</thead>
						<tbody>
						@if(!$banners->isEmpty())
							@foreach($banners as $key => $banner)
								<tr>
									<td width="30">{{ $banner->getId() }}</td>
									<td width="50">
										<a href="" class="editable" data-name="sort" data-pk="{{ $banner->getId() }}" data-type="text" data-url="{{ route('admin.banner.ajax.editable') }}">{{ $banner->getSort() }}</a>
									</td>
									<td>
										<p><img src="{{ $banner->getImage() }}" height="50"></p>
										Alt: <a href="" class="editable" data-name="image_alt" data-pk="{{ $banner->getId() }}" data-type="text">{{ $banner->getImageAlt() }}</a>
									</td>
									<td>
										<a href="" class="editable" data-name="title" data-pk="{{ $banner->getId() }}" data-type="text">{{ $banner->getTitle() }}</a>
									</td>
									<td>
										<a href="" class="editable" data-name="link" data-pk="{{ $banner->getId() }}" data-type="text">{{ $banner->getUrl() }}</a>
									</td>
									<td width="30">
										{!! makeActiveButton(route('admin.banner.active', [$banner->getId()]), $banner->getStatus()) !!}
									</td>
									<td>
										{!! makeEditButton(route('admin.banner.edit', [$banner->getId()])) !!}
									</td>
									<td>
										{!! makeDeleteButton(route('admin.banner.destroy', [$banner->getId()])) !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="8">
									Hiện chưa có banner nào!
								</td>
							</tr>
						@endif
						</tbody>
					</table>
					{{-- @include('admin/partials/paginate', ['data' => $banners, 'appended' => Request::all()]) --}}
					{!! $banners->appends(Request::all())->links() !!}
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
            url : '{{ route('admin.banner.ajax.editable') }}',
            params : {
               _token : '{{ csrf_token() }}'
            }
         });
      });
   </script>
@stop