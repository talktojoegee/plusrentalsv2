<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Real estate software, property management software, tenant management software">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/feather/css/feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/pcoded-horizontal.min.css">
    <style>
        .main-body .page-wrapper .page-header-title h4{
            color: {{Auth::user()->getUserTheme->caption_color ?? 'red'}};
        }
        .main-body .page-wrapper .page-header-title span{
            color: {{Auth::user()->getUserTheme->text_color ?? 'white'}} ;
        }
        .pcoded .pcoded-navbar[navbar-theme="themelight1"] .pcoded-item > li > a{
            color: {{Auth::user()->getUserTheme->text_color ?? 'white'}} !important;
        }
        .pcoded[nav-type="st6"] .pcoded-navbar[navbar-theme="themelight1"] .pcoded-item.pcoded-left-item > li > a > .pcoded-micon i{
            color: {{Auth::user()->getUserTheme->text_color ?? 'white'}}  !important;
        }
        .pcoded .pcoded-header[header-theme="theme6"]{
            background: #404E67
        }
        .pcoded .pcoded-header .navbar-logo[logo-theme="theme1"]{
            background: #404E67;
        }
    </style>
    @yield('extra-styles')
</head>
