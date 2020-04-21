<!--header start-->
<header class="header fixed-top clearfix">
	<!--logo start-->
	<div class="brand">
		<a href="{{ route('dashboard') }}" class="logo">
			{{ trans('admin/general.heading') }}
		</a>
		<div class="sidebar-toggle-box">
			<div class="fa fa-bars"></div>
		</div>
	</div>
	<!--logo end-->

	<div class="nav notify-row" id="top_menu">

	</div>
	<div class="top-nav clearfix">
		<ul class="nav pull-right top-menu">
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<img alt="avatar" src="/images/avatar1_small.jpg">
					<span class="username">{{ Auth::user()->nickname }}</span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu extended logout">
					<li><a href="{{ route('admin.user.profile') }}"><i class=" fa fa-suitcase"></i>{{ trans('general.profile') }}</a></li>
					<li><a href="{{ route('admin.logout') }}"><i class="fa fa-key"></i> {{ trans('general.logout') }}</a></li>
				</ul>
			</li>
		</ul>
		<!--search & user info end-->
	</div>
</header>
<!--header end-->