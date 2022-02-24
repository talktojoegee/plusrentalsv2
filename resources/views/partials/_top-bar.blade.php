        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo" logo-theme="theme6">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="icofont icofont-navigation-menu"></i>
                    </a>
                    <a href="{{route('dashboard')}}">
                        <img class="img-fluid" style="width: 200px;" src="\images\logo.png" alt="{{ config('app.name') }}">
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="\assets\drive\{{Auth::user()->avatar ?? 'avatar.png'}}" class="img-radius" alt="{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}">
                                    <span>{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                    <li>
                                        <a href="{{route('view-profile', Auth::user()->url)}}">
                                            <i class="feather icon-user"></i> My Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('view-profile', Auth::user()->url)}}">
                                            <i class="feather icon-mail"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('subscription')}}">
                                            <i class="ti-wallet"></i> Subscription
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('subscription')}}">
                                            <i class="ti-paint-bucket"></i> Theme Preference
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('logout')}}">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
