<!--sidebar start-->
<aside>
	<div id="sidebar" class="nav-collapse">
		<!-- sidebar menu start-->
		<div class="leftside-navigation">
			<ul class="sidebar-menu" id="nav-accordion">
				<li>
					<a class="{{ Request::is("admin/dashboard") ? 'active' : '' }}" href="{{ route('dashboard') }}">
						<i class="fa fa-dashboard"></i>
						<span>{{ trans('admin/general.modules.dashboard') }}</span>
					</a>
				</li>


				@if(Entrust::hasRole('root') || Entrust::can(['setting.view']))
				<li class="sub-menu">
					<a href="javascript:;" class="{{ Request::is("admin/settings*") ? 'active' : '' }}">
						<i class="fa fa-cog"></i>
						<span>{{ trans('admin/general.modules.setting') }}</span>
					</a>
					<ul class="sub">
						<li class="{{ Request::is("admin/settings/website") ? 'active' : '' }}"><a href="{{ route('website.edit') }}">{{ trans('admin/general.modules.site') }}</a></li>
						<li class="{{ Request::is("admin/settings/metadata") ? 'active' : '' }}"><a href="{{ route('metadata.show') }}">{{ trans('admin/general.modules.metadata') }}</a></li>
						<li class="{{ Request::is("admin/settings/social") ? 'active' : '' }}"><a href="{{ route('social.show') }}">{{ trans('admin/general.modules.social') }}</a></li>
					</ul>
				</li>
				@endif


				{{-- BANNER --}}
				@if(Entrust::hasRole('root') || Entrust::can(['banner.view']))
				<li class="sub-menu">
					<a href="{{ route('admin.banner.index') }}" class="{{ Request::is("admin/banners*") ? 'active' : '' }}">
						<i class="fa fa-file-image-o"></i>
						<span>Quản lý banner</span>
					</a>
				</li>
				@endif

				{{-- Page --}}
				@if(Entrust::hasRole('root') || Entrust::can(['page.view']))
				<li class="sub-menu">
					<a href="{{ route('admin.page.index') }}" class="{{ Request::is("admin/pages*") ? 'active' : '' }}">
						<i class="fa fa-feed"></i>
						<span>Quản lý trang tĩnh</span>
					</a>
				</li>
				@endif

				@if(Entrust::hasRole('root'))
				<li class="sub-menu">
					<a href="javascript:;" class="{{ (Request::is("admin/users*") or Request::is("admin/roles*") or Request::is("admin/permissions*")) ? 'active' : '' }}">
						<i class="fa fa-users"></i>
						<span>{{ trans('admin/general.modules.user') }}</span>
					</a>
					<ul class="sub">
						<li class="{{ Request::is("admin/users*") ? 'active' : '' }}"><a href="{{ route('user.index') }}">{{ trans('admin/general.modules.users') }}</a></li>
						<li class="{{ Request::is("admin/roles*") ? 'active' : '' }}"><a href="{{ route('role.index') }}">{{ trans('admin/general.modules.roles') }}</a></li>
						<li class="{{ Request::is("admin/permissions*") ? 'active' : '' }}"><a href="{{ route('permission.index') }}">{{ trans('admin/general.modules.permissions') }}</a></li>
					</ul>
				</li>
				@endif

				{{--Quản lý sản phẩm--}}
				@if(Entrust::hasRole('root') || Entrust::can(['product.view']))
				<li class="sub-menu">
					<a href="{{ route('admin.product.index') }}" class="{{ (Request::is("admin/products*")) || (Request::is("admin/sample-products*")) ? 'active' : '' }}">
						<i class="fa fa-cubes"></i>
						<span>{{ trans('admin/general.modules.product') }}</span>
					</a>
				</li>
				@endif

				{{--Category--}}
				@if(Entrust::hasRole('root') || Entrust::can(['category.view']))
				<li class="sub-menu">
					<a href="{{ route('admin.category.index') }}" class="{{ (Request::is("admin/categories*")) ? 'active' : '' }}">
						<i class="fa fa-cubes"></i>
						<span>Quản lý danh mục</span>
					</a>
				</li>
				@endif



				{{--Quản lý tin tức--}}
				@if(Entrust::hasRole('root') || Entrust::can(['post.view']))
				<li class="sub-menu">
					<a href="javascript:;" class="{{ (Request::is("admin/post*")) ? 'active' : '' }}">
						<i class="fa fa-newspaper-o"></i>
						<span>Quản lý tin tức</span>
					</a>
					<ul class="sub">
						<li class="{{ Request::is("admin/post/index") ? 'active' : '' }}"><a href="{{ route('admin.post.index') }}">Danh sách</a></li>
						<li class="{{ Request::is("admin/post-category/index") ? 'active' : '' }}"><a href="{{ route('admin.post_category.index') }}">Danh mục</a></li>
					</ul>
				</li>
				@endif

				{{--Quản lý banner--}}
				@if(Entrust::hasRole('root') || Entrust::can(['banner.view']))
				{{-- <li class="sub-menu">
					<a href="javascript:;" class="{{ (Request::is("admin/banners*")) ? 'active' : '' }}">
						<i class="fa fa-image"></i>
						<span>Quản lý Banner</span>
					</a>
					<ul class="sub">
						<li class="{{ Request::is("admin/banners/index") ? 'active' : '' }}"><a href="{{ route('admin.banner.index') }}">Danh sách</a></li>
					</ul>
				</li> --}}
				@endif

				{{--Quản lý tags--}}
				@if(Entrust::hasRole('root') || Entrust::can(['tag.view']))
				{{-- <li class="sub-menu">
					<a href="{{ route('admin.tag.index') }}" class="{{ (Request::is("admin/tag*")) ? 'active' : '' }}">
						<i class="fa fa-tag"></i>
						<span>Tags</span>
					</a>
				</li> --}}
				@endif

			</ul>
		</div>
		<!-- sidebar menu end-->
	</div>
</aside>
<!--sidebar end-->
