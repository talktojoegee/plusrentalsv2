<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{config('app.name')}} | Admin Login </title>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Manager login screen">
    <meta name="author" content="#">
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>

<body class="fix-menu">
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if(session()->has('success'))
                    <div class="alert alert-success col-md-6 offset-md-3 background-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-warning col-md-6 offset-md-3 background-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('error') !!}
                    </div>
                @endif

                <form class="{{route('manager-login')}}" method="post">
                    @csrf
                    <div class="text-center">
                        <img width="300" src="/images/logo.png" alt="{{config('app.name')}}">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Login</h3>
                                    <p>Admin Login Screen</p>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email Address">
                                <span class="form-bar"></span>
                                @error('email')
                                <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control"  placeholder="Password">
                                <span class="form-bar"></span>
                                @error('password')
                                <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary d-">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>

<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="\bower_components\jquery\js\jquery.min.js"></script>
<script type="text/javascript" src="\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
<script type="text/javascript" src="\bower_components\popper.js\js\popper.min.js"></script>
<script type="text/javascript" src="\bower_components\bootstrap\js\bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="\bower_components\modernizr\js\modernizr.js"></script>
<script type="text/javascript" src="\bower_components\modernizr\js\css-scrollbars.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="\bower_components\i18next\js\i18next.min.js"></script>
<script type="text/javascript" src="\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
<script type="text/javascript" src="\assets\js\common-pages.js"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
</body>

</html>
