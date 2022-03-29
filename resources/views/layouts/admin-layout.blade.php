@include('partials._header')
<body>
@include('partials._loader')
<div id="pcoded" class="pcoded">
    <div class="pcoded-container">
        @include('partials._admin-top-bar')
        <div class="pcoded-main-container" style="background: #d0d0d0;" id="pcoded-background" >
            @include('partials._admin-menu-bar')
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content" >
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="row align-items-end mb-3">
                                    <div class="col-lg-6 mt-5">
                                        <div class="page-header-title">
                                            <div class="d-inline">
                                                <h4>@yield('current-page')</h4>
                                                <span style="text-transform: none;">@yield('current-page-brief')</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="page-header-breadcrumb">
                                            @yield('event-area')
                                        </div>
                                    </div>
                                </div>
                                <div class="page-body">
                                    @yield('main-content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('dialog-section')
@include('partials._footer-scripts')
