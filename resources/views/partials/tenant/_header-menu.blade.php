        <header class="header-part">
            <div class="container">
                <div class="header-content">
                    <div class="header-left">
                        <ul class="header-widget">
                            <li>
                                <button type="button" class="header-menu">
                                    <i class="fas fa-align-left"></i>
                                </button>
                            </li>
                            <li>
                                <a href="{{route('home')}}" class="header-logo">
                                    <img src="/images/logo.png" alt="logo">
                                </a>
                            </li>
                            @if(Auth::check())
                                <li>
                                    <a href="{{route('logout')}}" class="header-user">
                                        <i class="fas fa-user"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>

                            @endif
                        </ul>
                    </div>
                    <form class="header-search">
                        <div class="header-main-search">
                            <button type="submit" class="header-search-btn"><i class="fas fa-search"></i></button>
                            <input type="text" class="form-control" placeholder="Search, Whatever you needs...">
                            <button type="button" class="header-option-btn tooltip"><i class="fas fa-sliders-h"></i>
                                <span class="tooltext left">FilterOption</span>
                            </button>
                        </div>
                        <div class="header-search-option" style="display: none;">
                            <div class="row"><div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="State">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Category">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-btn">
                                        <button type="submit" class="btn btn-inline"><i class="fas fa-search"></i><span>Search Here</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="header-right">
                        @if (Auth::check())
                            @if(Auth::user()->getAllUnreadTenantNotifications()->count() > 0 )
                            <ul class="header-widget">
                                <li>
                                    <a href="{{route('notifications')}}" class="header-notify">
                                        <i class="fas fa-bell"></i>

                                            <sup>{{ Auth::user()->getAllUnreadTenantNotifications()->count() }}</sup>

                                    </a>
                                </li>
                            </ul>
                            @endif
                        @endif
                        @if(!Auth::check())
                                <ul class="header-widget">
                                    <li><a href="{{route('pricing')}}" class="header-user text-muted">Pricing</a></li>
                                    <li><a href="#" class="header-user text-muted">Features</a></li>
                                    <li><a href="{{route('property-listing')}}" class="header-user text-muted">Listings</a></li>
                                    <li>
                                        <a href="{{route('login')}}" class="header-user">
                                            <i class="fas fa-user"></i>
                                            <span>Login</span>
                                        </a>
                                    </li>
                                </ul>
                        @endif
                        <a href="{{route('register')}}" class="btn btn-inline">
                            <span>Start Free Trial</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="sidebar-part">
            <div class="sidebar-body">
                <div class="sidebar-header">
                    <a href="route('home')}}" class="sidebar-logo">
                        <img src="/images/logo.png" alt="logo">
                    </a>
                    <button class="sidebar-cross">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="sidebar-content">
                   @if(Auth::check())
                        <div class="sidebar-profile">
                            <a href="{{route('home')}}" class="sidebar-avatar">
                                <img src="/images/avatar/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->getApplicant->first_name ?? ''}}">
                            </a>
                            <h4>
                                <a href="route('home')}}" class="sidebar-name">{{Auth::user()->getApplicant->first_name ?? ''}} {{Auth::user()->getApplicant->surname ?? ''}}</a>
                            </h4>
                            <a href="{{route('pay-rent')}}" class="btn btn-inline sidebar-btn">
                                <i class="fas fa-wallet"></i>
                                <span>Pay Rent</span>
                            </a>
                        </div>
                   @endif
                    <div class="sidebar-menu">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="#main-menu" class="nav-link {{!Auth::check() ? 'active' : ''}}" data-toggle="tab">Main Menu</a>
                            </li>
                            @if(Auth::check())
                                <li>
                                    <a href="#author-menu" class="nav-link {{Auth::check() ? 'active' : ''}}" data-toggle="tab">Tenant Menu</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-pane {{!Auth::check() ? 'active' : '' }}" id="main-menu">
                            <ul class="navbar-list">
                                @if (Auth::check())
                                    <li class="navbar-item">
                                        <a class="navbar-link" href="{{route('profile')}}">Profile</a>
                                    </li>
                                @endif
                                @if (!Auth::check())
                                    <li class="navbar-item">
                                        <a class="navbar-link" href="route('home')}}">
                                            Home
                                        </a>
                                    </li>
                                    <li class="navbar-item">
                                        <a class="navbar-link" href="{{route('pay-rent')}}">Pay Rent</a>
                                    </li>
                                    <li class="navbar-item">
                                        <a class="navbar-link" href="{{route('pay-rent')}}">Pricing</a>
                                    </li>
                                    <li class="navbar-item">
                                        <a class="navbar-link" href="route('faqs')}}">FAQs</a>
                                    </li>
                                    <li class="navbar-item">
                                        <a class="navbar-link" href="route('register')}}">Login</a>
                                    </li>
                                    <li class="navbar-item">
                                        <a class="navbar-link" href="route('tips')}}">Tips</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                        @if(Auth::check())
                        <div class="tab-pane {{Auth::check() ? 'active' : '' }}" id="author-menu">
                            <ul class="navbar-list">
                                <li class="navbar-item">
                                    <a class="navbar-link" href="{{route('my-leases')}}">Lease</a>
                                </li>
                                <li class="navbar-item">
                                    <a class="navbar-link" href="{{route('profile')}}">Profile</a>
                                </li>
                                <li class="navbar-item">
                                    <a class="navbar-link" href="{{route('my-reports')}}">Reports</a>
                                </li>
                                <li class="navbar-item">
                                    <a class="navbar-link" href="{{route('my-occupants')}}">Occupants</a>
                                </li>
                                <li class="navbar-item">
                                    <a class="navbar-link" href="{{route('my-domestic-staff')}}">Staff</a>
                                </li>
                                <li class="navbar-item navbar-dropdown">
                                    <a class="navbar-link" href="{{route('settings')}}">Settings
                                    </a>
                                </li>
                                <li class="navbar-item navbar-dropdown">
                                    <a class="navbar-link" href="{{route('maintenance')}}">
                                        Maintenance
                                    </a>
                                </li>
                                <li class="navbar-item navbar-dropdown">
                                    <a class="navbar-link" href="{{route('notifications')}}">
                                        Notification
                                    </a>
                                </li>
                                <li class="navbar-item">
                                    <a class="navbar-link" href="route('logout')}}">Logout</a>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="sidebar-footer">
                        <p>&copy; {{date('Y')}} All Rights Reserved
                            <a href="route('home')}}" target="_blank">{{config('app.name')}} </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
