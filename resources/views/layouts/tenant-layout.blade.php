@include('partials.tenant._header')
<body>
@include('partials.tenant._header-menu')
@include('partials.tenant._top-bar')
@yield('breadcrumb')
@yield('main-content')

@include('partials.tenant._footer')
@include('partials.tenant._footer-scripts')
</body>
</html>
