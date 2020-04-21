<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{{ trans('admin/general.title') }}">
	<title>{{ trans('admin/general.heading') }}</title>
	<!--Core CSS -->
	<link href="/bs3/css/bootstrap.min.css" rel="stylesheet">
	<link href="/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
	<link href="/css/common.css" rel="stylesheet">
	<link href="/css/bootstrap-reset.css" rel="stylesheet">
	<link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="/js/data-tables/DT_bootstrap.css" rel="stylesheet">
	<link href="/css/clndr.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/style-responsive.css" rel="stylesheet"/>
	<link href="/css/admin.css" rel="stylesheet">
	<link href="/js/iCheck/skins/square/square.css" rel="stylesheet">

	<link href="/js/select2/dist/css/select2.min.css" rel="stylesheet" >
	<link href="/js/select2/dist/css/select2-bootstrap.min.css" rel="stylesheet" >
	<link href="/js/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">

	@yield('styles')
	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]>
	<script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<!-- Placed js at the end of the document so the pages load faster -->
	<!--Core js-->
	<script src="/js/jquery.js"></script>
	<script src="/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="/bs3/js/bootstrap.min.js"></script>
	<script src="/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="/js/jquery.scrollTo.min.js"></script>
	<script src="/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
	<script src="/js/jquery.nicescroll.js"></script>
	<script src="/js/jquery.easing.min.js"></script>
	<script src="/js/underscore-min.js"></script>

	<script src="/js/gauge/gauge.js"></script>
	<script src="/js/jquery.customSelect.min.js" ></script>
	<script src="/js/advanced-datatable/js/jquery.dataTables.js"></script>
	<script src="/js/data-tables/DT_bootstrap.js"></script>

	<script src="/js/tinymce_4.4.3/tinymce.min.js"></script>

	<!--common script init for all pages-->
	<script src="/js/scripts.js"></script>
	<script src="/js/functions.js"></script>

	<link rel="stylesheet" href="{{ asset('/css/bootstrap-editable/bootstrap-editable.css') }}">
	<script src="{{ asset('/js/jquery.editable/bootstrap-editable.js') }}"></script>

	<!-- Xoxco jquery tags input -->
	<link href="/js/jquery-tags-input/jquery.tagsinput.css" rel="stylesheet" />
	<script src="/js/jquery-tags-input/jquery.tagsinput.js"></script>

	<!-- jQuery select2 -->
	<script src="/js/select2/dist/js/select2.min.js"></script>

	<!-- Monents date time -->
	<script src="/js/moment/min/moment.min.js"></script>
	<script src="/js/moment/min/moment-with-locales.min.js"></script>

	<!-- Date time picker -->
	<script src="/js/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Fancy box -->
	<link rel="stylesheet" type="text/css" href="/js/fancybox-2.15/source/jquery.fancybox.css">
    <script type="text/javascript" src="/js/fancybox-2.15/source/jquery.fancybox.js"></script>

    <!-- Core galerry -->
    <link rel="stylesheet" type="text/css" href="/css/gallery.css">

    <!-- Jquery token input -->
    <link href="/js/jquery-tokeninput/styles/token-input-facebook.css" rel="stylesheet" >
	<link href="/js/jquery-tokeninput/styles/token-input.css" rel="stylesheet" >
    <script type="text/javascript" src="/js/jquery-tokeninput/src/jquery.tokeninput.js"></script>

    <!-- Nested sortable -->
    <script type="text/javascript" src="/js/jquery.mjs.nestedSortable.js"></script>

    <!-- Toastr -->
    <script type="text/javascript" src="/js/jQuery-Toastr/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/jQuery-Toastr/toastr.min.css">
</head>
<body>
<section id="container">
	@include('admin/partials/header')
	@include('admin/partials/aside')
	<section id="main-content">
		<section class="wrapper">
			@include('notifications')
			@yield('main-content')
		</section>
	</section>
</section>

<!--script for this page-->
<script src="/js/admin.js"></script>
@yield('scripts')
</body>
</html>
