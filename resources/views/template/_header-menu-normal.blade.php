<header id="header-container" class="fullwidth">
    <!-- Header -->
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo"><a href="{{route('home')}}">
                        <img src="/images/logo.png" alt="{{config('app.name')}}" style="width: 200px;"></a>
                </div>
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li><a class="{{(request()->is('home')) ? 'current' : ''}}" href="{{route('home')}}">Home</a>
                        </li>
                        <li><a class="{{(request()->is('property-listing')) ? 'current' : ''}}" href="{{ route('property-listing')}}">Property Listing</a>
                        </li>
                        <li><a href="#">Pricing</a>
                        </li>
                        <li><a href="#">Features</a>
                        </li>
                        <li><a href="#">FAQs</a>
                        </li>
                        <li><a href="#">Blog</a>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
            <div class="right-side">
                <div class="header-widget">
                    <a href="{{route('login')}}" class="button"><i class="icon-line-awesome-user"></i> <span>Login</span></a>
                    <a href="{{route('register')}}" class="button border"><i class="icon-feather-plus-circle"></i> <span>Start Free Trial</span></a>
                </div>
            </div>
        </div>
    </div>
</header>
