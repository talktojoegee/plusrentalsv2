<nav class="pcoded-navbar" style="background: none;">
    <div class="pcoded-inner-navbar" style="background: none;">
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{route('duties')}}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Home</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-certificate-alt-1"></i></span>
                    <span class="pcoded-mtext">Companies</span>
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
                    <li class=" ">
                        <a href="{{route('manage-roles')}}">
                            <span class="pcoded-mtext">Manage Roles</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('manage-permissions')}}">
                            <span class="pcoded-mtext">Manage Permissions</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('app-modules') }}">
                            <span class="pcoded-mtext">Modules</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('module-manager') }}">
                            <span class="pcoded-mtext">Module Manager</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('manage-theme') }}">
                            <span class="pcoded-mtext">Manager Themes</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('manage-faqs') }}">
                            <span class="pcoded-mtext">FAQs</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('manage-posts') }}">
                            <span class="pcoded-mtext">Articles</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
