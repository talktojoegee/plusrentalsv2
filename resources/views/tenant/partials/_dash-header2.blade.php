        <section class="dash-header-part">
            <div class="container">
                <div class="dash-header-card">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="dash-header-left">
                                <div class="dash-avatar">
                                    <a href="#">
                                        <img src="/images/avatar/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->getApplicant->first_name ?? ''}}">
                                    </a>
                                </div>
                                <div class="dash-intro">
                                    <h4>
                                        <a href="javascript:void(0);">{{Auth::user()->getApplicant->first_name ?? ''}} {{Auth::user()->getApplicant->surname ?? ''}}</a>
                                    </h4>
                                    <ul class="dash-meta">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span>{{Auth::user()->getApplicant->mobile_no ?? '-'}}</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <span>{{Auth::user()->email ?? '-'}}</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{Auth::user()->getApplicant->address ?? '-'}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="dash-header-right">
                                <div class="dash-focus dash-list">
                                    <h5 class="text-white">{{'₦'.number_format(Auth::user()->getTenantReceipts->sum('total'),2)}}</h5>
                                    <p>Total Receipts</p>
                                </div>
                                <div class="dash-focus dash-book">
                                    <h5 class="text-white"> 8</h5>
                                    <p>Maintenance</p>
                                </div>
                                <div class="dash-focus dash-rev">
                                    <h5 class="text-white">{{'₦'.number_format((Auth::user()->getTenantInvoices->sum('total')) - (Auth::user()->getTenantInvoices->sum('paid_amount')),2)}}</h5>
                                    <p>Outstanding Payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty(Auth::user()->about))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dash-header-alert alert fade show">
                                    <p>Auth::user()->about ?? ''}}</p>

                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dash-menu-list">
                                <ul>
                                    <li>
                                        <a class="{{Request::is('resident/my-leases') ? 'active' : ''}}" href="{{route('my-leases')}}">Lease</a>
                                    </li>
                                    <li>
                                        <a class="{{Request::is('resident/profile') ? 'active' : '' }}" href="{{route('profile')}}">Profile</a>
                                    </li>
                                    <li>
                                        <a class="{{Request::is('resident/my-reports') ? 'active' : '' }}" href="{{route('my-reports')}}">Reports</a>
                                    </li>
                                    <li>
                                        <a class="{{Request::is('resident/my-occupants') ? 'active' : '' }}" href="{{route('my-occupants')}}">Occupants</a>
                                    </li>
                                    <li>
                                        <a class="{{Request::is('resident/my-domestic-staff') ? 'active' : ''}}" href="{{route('my-domestic-staff')}}">Staff</a>
                                    </li>
                                    <li>
                                        <a class="{{Request::is('resident/settings') ? 'active' : ''}}" href="{{route('settings')}}">settings</a>
                                    </li>
                                    <li>
                                        <a class="{{Request::is('resident/maintenance') ? 'active' : ''}}" href="{{route('maintenance')}}">Maintenance</a>
                                    </li>
                                    <li>
                                        <a class="{{Request::is('resident/notifications') ? 'active' : ''}}" href="{{route('notifications')}}">notification</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(round(abs(strtotime(Auth::user()->end_date) - strtotime(now()))/86400) <= 100)
            <div class="alert alert-warning col-md-6 offset-md-3 mt-2 text-center">
                Hello {{Auth::user()->getApplicant->first_name ?? ''}}, your rent will be due in {{round(abs(strtotime(Auth::user()->end_date) - strtotime(now()))/86400) }} days.
                Precisely {{date('d M, Y', strtotime(Auth::user()->end_date))}}. Please endeavour to renew in time. Thank you.
            </div>
        @endif
