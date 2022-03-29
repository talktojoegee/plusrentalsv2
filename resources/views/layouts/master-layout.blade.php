@include('partials._header')
<body>
@include('partials._loader')
    <div id="pcoded" class="pcoded">
        <div class="pcoded-container">
            @include('partials._top-bar')
            <div class="pcoded-main-container" id="pcoded-background" style="background: url('/assets/drive/themes/{{Auth::user()->getUserTheme->theme ?? 'theme.png'}}'); background-size:cover; background-repeat: no-repeat;">
                @include('partials._menu-bar')
                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content" >
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="row align-items-end mb-3">
                                        <div class="col-lg-6 mt-5">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4 class="text-muted">@yield('current-page')</h4>
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
                                        @if(round(abs(strtotime(Auth::user()->getUserCompany->end_date) - strtotime(now()))/86400) <= 7)
                                            <div class="alert alert-warning background-warning col-md-6 offset-md-3">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                                </button>
                                                Your current subscription will expire in {{round(abs(strtotime(Auth::user()->getUserCompany->end_date) - strtotime(now()))/86400) }} days.
                                                Precisely {{date('d M, Y', strtotime(Auth::user()->getUserCompany->end_date))}}
                                            </div>
                                        @endif
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
