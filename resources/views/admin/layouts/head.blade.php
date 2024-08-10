<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>
    <link rel="apple-touch-icon" href="{{ url('assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/chartist-js/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/select2/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('assets/vendors/select2/select2-materialize.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href=" {{url('assets/css/pages/form-select2.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/css/themes/vertical-gradient-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/css/themes/vertical-gradient-menu-template/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/pages/dashboard-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/pages/intro.css?v=5') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/pages/data-tables.css?v=0') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/custom/custom.css?v=9') }}">
    <link href="{{ url('assets/css/snackbar/snackbar.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/noty/bootstrap-notifications.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/waitme/waitMe.min.css') }}" rel="stylesheet">

    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->