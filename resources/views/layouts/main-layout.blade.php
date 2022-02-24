@include('template._header')
<body>
<!-- Preloader Start -->
<div class="preloader">
    <div class="utf-preloader">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- Preloader End -->

<!-- Wrapper -->
<div id="wrapper">
    <!-- Header Container -->
    @if(!Auth::check())
        @include('template._header-menu-normal')
    @else
        @include('template._header-menu-auth')
    @endif
    <div class="clearfix"></div>

    @yield('main-content')
    @include('template._footer-note')
</div>
@include('template._footer-scripts')
