@if(Auth::check())
        <div class="btmbar-part">
            <div class="container">
                <ul class="btmbar-widget">
                    <li>
                        <a href="{{route('profile')}}">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('settings')}}">
                            <i class="fas fa-cog"></i>
                        </a>
                    </li>
                    <li>
                        <a class="plus-btn" href="{{route('pay-rent')}}">
                            <i class="fas fa-plus"></i>
                            <span>Pay Rent</span>
                        </a>
                    </li>
                    @if(Auth::user()->getAllUnreadTenantNotifications()->count() > 0)
                        <li>
                            <a href="{{route('notifications')}}">
                                <i class="fas fa-bell"></i>
                                <sup>{{Auth::user()->getAllUnreadTenantNotifications()->count()}}</sup>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('my-reports')}}">
                            <i class="fa fa-barcode"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
@endif
