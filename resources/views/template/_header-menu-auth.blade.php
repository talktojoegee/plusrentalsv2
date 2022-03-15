<header id="header-container" class="fullwidth">
    <!-- Header -->
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{route('home')}}">
                        <img src="/images/logo.png" alt="">
                    </a>
                </div>
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>
                </div>
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li><a class="current" href="{{route('home')}}" target="_blank">Home</a>
                        </li>
                        <li><a href="#" target="_blank">Pricing</a>
                        </li>
                        <li><a href="#" target="_blank">Features</a>
                        </li>
                        <li><a href="#" target="_blank">FAQs</a>
                        </li>
                        <li><a href="#" target="_blank">Blog</a>
                        </li>
                        <li><a href="#" target="_blank">Contact</a></li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
            <div class="right-side">
                <div class="header-widget">
                    <div class="user-menu">
                        <div class="user-name">
                            <span>
                                <img src="/images/avatar/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->getApplicant->first_name ?? ''}}">
                            </span>
                            <div class="user-name-title">Hi, {{Auth::user()->getApplicant->first_name ?? ''}}!</div></div>
                        <ul>
                            <li><a href="{{route('profile')}}"><i class="sl sl-icon-user"></i> My Profile</a></li>
                            <li><a href="{{route('my-leases')}}"><i class="icon-line-awesome-exchange"></i> My Lease</a></li>
                            <li><a href="{{route('my-reports')}}"><i class="icon-line-awesome-book"></i> Reports</a></li>
                            <li><a href="{{route('settings')}}"><i class="sl sl-icon-wrench"></i> Settings</a></li>
                            <li><a href="{{route('logout')}}"><i class="sl sl-icon-power"></i> Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
