<div class="col-md-3">
    <div class="margin-bottom-20">
        <div class="utf-edit-profile-photo-area">
            <img src="/images/avatar/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->getApplicant->first_name ?? ''}}">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="sidebar margin-top-20">
        <div class="user-smt-account-menu-container">
            <ul class="user-account-nav-menu">
                <li><a class="{{Request::is('resident/profile') ? 'current' : '' }} " href="{{route('profile')}}"> <i class="sl sl-icon-user"></i> Profile</a> </li>
                <li> <a class="{{Request::is('resident/notifications') ? 'current' : ''}}" href="{{route('notifications')}}"><i class="sl sl-icon-bell"></i>Notification</a></li>
                <li><a class="{{Request::is('resident/my-leases') ? 'current' : ''}}" href="{{route('my-leases')}}"><i class="icon-line-awesome-exchange"></i>Lease</a></li>
                <li><a class="{{Request::is('resident/my-reports') ? 'current' : '' }}" href="{{route('my-reports')}}"><i class="icon-line-awesome-book"></i> Reports</a> </li>
                <li><a class="{{Request::is('resident/my-occupants') ? 'current' : '' }}" href="{{route('my-occupants')}}"><i class=" icon-line-awesome-users"></i>Occupants</a> </li>
                <li><a class="{{Request::is('resident/my-domestic-staff') ? 'current' : ''}}" href="{{route('my-domestic-staff')}}"><i class="sl sl-icon-briefcase"></i>Staff</a></li>
                <li><a class="{{Request::is('resident/settings') ? 'current' : ''}}" href="{{route('settings')}}"><i class="sl sl-icon-wrench"></i>settings</a></li>
               {{-- <li><a class="Request::is('resident/maintenance') ? 'current' : ''}}" href="route('maintenance')}}"><i class="sl sl-icon-umbrella"></i>Maintenance</a></li>--}}
                <li><a href="{{route('logout')}}"><i class="sl sl-icon-power"></i> Log Out</a></li>
            </ul>
        </div>
    </div>
    <div class="widget utf-sidebar-widget-item">
        <div class="utf-detail-banner-add-section">
            <a href="#"><img src="/images2/banner-add-2.jpg" alt="banner-add-2"></a>
        </div>
    </div>
</div>
