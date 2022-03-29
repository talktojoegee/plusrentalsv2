<nav class="pcoded-navbar text-muted" style="background: none;">
    <div class="pcoded-inner-navbar" style="background: none;">
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{route('dashboard')}}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Home</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-certificate-alt-1"></i></span>
                    <span class="pcoded-mtext">Rentals</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="icofont icofont-people"></i></span>
                            <span class="pcoded-mtext">Property</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('properties')}}">
                                    <span class="pcoded-mtext">All Properties</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('add-new-property')}}">
                                    <span class="pcoded-mtext">Add New Property</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('property-inspection')}}">
                                    <span class="pcoded-mtext">Property Inspection</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="icofont icofont-people"></i></span>
                            <span class="pcoded-mtext">Lease</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('leases')}}">
                                    <span class="pcoded-mtext">Manage Lease</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('add-new-lease')}}">
                                    <span class="pcoded-mtext">Add New Lease</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('lease-applications')}}">
                                    <span class="pcoded-mtext">Lease Applications</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('schedule-lease')}}">
                                    <span class="pcoded-mtext">Schedule Lease</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="icofont icofont-people"></i></span>
                            <span class="pcoded-mtext">Tenant</span>
                        </a>
                        <ul class="pcoded-submenu">

                            <li class="">
                                <a href="{{route('manage-tenants')}}">
                                    <span class="pcoded-mtext">All Tenants</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('add-new-tenant')}}">
                                    <span class="pcoded-mtext">Add New Tenant</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-harddrives"></i></span>
                    <span class="pcoded-mtext">Files</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('manage-files') }}">
                            <span class="pcoded-mtext">Document Storage</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-email"></i></span>
                    <span class="pcoded-mtext">Bulk SMS</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('top-up') }}">
                            <span class="pcoded-mtext">Top-up</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('phone-group') }}">
                            <span class="pcoded-mtext">Phone Groups</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('compose-message') }}">
                            <span class="pcoded-mtext">Compose Message</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('bulk-messages') }}">
                            <span class="pcoded-mtext">Messages</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-money-bag"></i></span>
                    <span class="pcoded-mtext">Payment</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="#">
                            <span class="pcoded-mtext"> Receive Payment</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('manage-invoices')}}">
                            <span class="pcoded-mtext"> Invoice</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('manage-receipts')}}">
                            <span class="pcoded-mtext"> Receipt</span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="icofont icofont-home-search"></i></span>
                            <span class="pcoded-mtext">Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{route('tenant-report')}}">
                                    <span class="pcoded-mtext">Tenant</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('property-report')}}">
                                    <span class="pcoded-mtext">Property</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class=" ">
                        <a href="{{route('service-settings')}}">
                            <span class="pcoded-mtext">  Service</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('account-settings')}}">
                            <span class="pcoded-mtext"> Settings</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-settings-alt"></i></span>
                    <span class="pcoded-mtext">Settings</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{route('account-settings')}}">
                            <span class="pcoded-mtext">Payment</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('general-settings')}}">
                            <span class="pcoded-mtext">General</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('service-settings')}}">
                            <span class="pcoded-mtext">Services</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('general-settings')}}">
                            <span class="pcoded-mtext">Bulk SMS</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-home-search"></i></span>
                    <span class="pcoded-mtext">Reports</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{route('tenant-report')}}">
                            <span class="pcoded-mtext">Tenant</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('property-report')}}">
                            <span class="pcoded-mtext">Property</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-brainstorming"></i></span>
                    <span class="pcoded-mtext">Administration</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('manage-users') }}">
                            <span class="pcoded-mtext">Manage Team</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('add-new-user') }}">
                            <span class="pcoded-mtext">Add New User</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
