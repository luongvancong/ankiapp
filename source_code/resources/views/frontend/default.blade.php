<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> {{ setting()->meta_title }} </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <meta name="keywords" content="{{ setting()->meta_keyword }}">
    <meta name="description" content="{{ setting()->meta_description }}">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ setting()->meta_title }}">
    <meta itemprop="description" content="{{ setting()->meta_description }}">
    <meta itemprop="image" content="{{ setting()->image }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ setting()->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ setting()->image }}" />
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:description" content="{{ setting()->meta_description }}" />
    <meta property="og:site_name" content="{{ $_SERVER['SERVER_NAME'] }}" />
    <meta property="fb:admins" content="100001247771720" />
    <meta property="fb:app_id" content="442754092739471" />

    {{-- $_assets From Middleware/Asset --}}
    {!! $__assets !!}

    @yield('styles')
</head>

<body class="{{ setting()->body_class }}">
    @yield('content')
</body>
</html>