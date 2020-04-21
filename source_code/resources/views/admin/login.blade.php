<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{{ trans('admin/general.title') }}">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>{{ trans('admin/general.title') }}</title>

	<!--Core CSS -->
	<link href="/bs3/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-reset.css" rel="stylesheet">
	<link href="/font-awesome/css/font-awesome.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/style-responsive.css" rel="stylesheet" />

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]>
	<script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
	<body class="login-body">
		<div class="container">
			<form class="form-signin" method="post" action="">
				<h2 class="form-signin-heading">{{ trans('admin/general.heading') }}</h2>
				<div class="login-wrap">
					<div class="user-login-info">
						<input type="text" name="email" class="form-control" placeholder="{{ trans('form.email') }}" value="{{ old('email') }}" autofocus>
						<input type="password" name="password" class="form-control" placeholder="{{ trans('form.password') }}">
					</div>
					<label class="checkbox">
						<input type="checkbox" name="remember"> {{ trans('form.remember') }}
					</label>
					@include('admin/partials/notifications')
					<button class="btn btn-lg btn-login btn-block" type="submit">{{ trans('general.login') }}</button>
					{!! csrf_field() !!}
				</div>
			</form>
		</div>
	</body>
</html>