<nav class="pcoded-navbar" style="background: none;">
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
                                    <span class="pcoded-mtext">Manage Properties</span>
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
                                <a href="{{route('lease-applications')}}">
                                    <span class="pcoded-mtext">Manage Lease App.</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('add-new-lease')}}">
                                    <span class="pcoded-mtext">Add New Lease</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('schedule-lease')}}">
                                    <span class="pcoded-mtext">Schedule Lease</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="">
                        <a href="{{route('manage-tenants')}}">
                                <span class="pcoded-micon">
                                    <i class="ti-layout-grid2-alt"></i>
                            </span>
                            <span class="pcoded-mtext">Manage Tenants</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
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
                    <span class="pcoded-mtext">Accounting</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)" data-i18n="nav.form-components.main">
                            <span class="pcoded-micon"><i class="ti-layers"></i></span>
                            <span class="pcoded-mtext">Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                            <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{route('chart-of-accounts')}}">
                                    <span class="pcoded-mtext">Chart of Accounts</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('trial-balance')}}">
                                    <span class="pcoded-mtext">Trial Balance</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('balance-sheet')}}">
                                    <span class="pcoded-mtext">Balance Sheet</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('profit-or-loss')}}">
                                    <span class="pcoded-mtext">Profit/Loss</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{route('journal-voucher')}}">
                                    <span class="pcoded-mtext">Journal Voucher</span>
                                </a>
                            </li>
                        </ul>

                        <li class="pcoded-hasmenu">
                            <a href="javascript:void(0)">
                                <span class="pcoded-micon"><i class="icofont icofont-barcode"></i></span>
                                <span class="pcoded-mtext">Tenants</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="">
                                    <a href="{{ route('manage-invoices') }}">
                                        <span class="pcoded-mtext">Invoices</span>
                                    </a>
                                </li>
                                <li class=" ">
                                    <a href="{{route('manage-receipts')}}">
                                        <span class="pcoded-mtext">Receipts</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="pcoded-hasmenu">
                            <a href="javascript:void(0)">
                                <span class="pcoded-micon"><i class="icofont icofont-people"></i></span>
                                <span class="pcoded-mtext">Vendors</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="">
                                    <a href="widget-statistic.htm">
                                        <span class="pcoded-mtext">Manage Vendors</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{route('add-new-vendor')}}">
                                        <span class="pcoded-mtext">Add New Vendor</span>
                                    </a>
                                </li>
                                <li class=" ">
                                    <a href="{{route('manage-bills')}}">
                                        <span class="pcoded-mtext">Bills</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{route('manage-payments')}}">
                                        <span class="pcoded-mtext">Payments</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{route('vendors-categories')}}">
                                        <span class="pcoded-mtext">Manage Categories</span>
                                    </a>
                                </li>

                            </ul>
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
                        <a href="{{route('general-settings')}}">
                            <span class="pcoded-mtext">General Settings</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('service-settings')}}">
                            <span class="pcoded-mtext">Service Settings</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('account-settings')}}">
                            <span class="pcoded-mtext">Accounting Settings</span>
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
