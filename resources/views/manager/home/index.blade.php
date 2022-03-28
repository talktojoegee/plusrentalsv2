@extends('layouts.master-layout')
@section('title')
    Home
@endsection

@section('current-page')
    Welcome, <small><strong>{{Auth::user()->first_name ?? ''}}</strong></small>
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('lease-applications')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Applications</a>
        <a href="{{route('property-report')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Property Report</a>
    </div>
@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-yellow f-w-600">{{number_format($tenants->count())}}</h4>
                            <h6 class="text-muted m-b-0">All Tenants</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="ti-user f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-yellow">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p title="Currently renting as against overall tenants" class="text-white m-b-0">
                                {{$tenants->count() > 0 ? ceil(($tenants->where('status',1)->count()/$tenants->count())*100) : 0 }}% Change</p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="{{route('manage-tenants')}}" class=""><i class="ti-eye text-white f-16"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-green f-w-600">{{number_format($properties->count())}}</h4>
                            <h6 class="text-muted m-b-0">Properties</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="ti-home f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-green">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p title="Currently vacant as against overall properties" class="text-white m-b-0">
                                {{$properties->count() > 0 ? ceil(($properties->where('status',0)->count()/$properties->count())*100) : 0 }}% Change</p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="{{route('properties')}}" class=""><i class="ti-eye text-white f-16"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-pink f-w-600">

                                @if(Auth::user()->getCompanyStorage->sum('size') >= 1073741824)
                                    {{number_format(Auth::user()->getCompanyStorage->sum('size')/1073741824,2)}}GB
                                @elseif(Auth::user()->getCompanyStorage->sum('size') >= 1048576)
                                    {{number_format(Auth::user()->getCompanyStorage->sum('size')/1048576,2)}}MB
                                @elseif(Auth::user()->getCompanyStorage->sum('size') >= 1024)
                                    {{number_format(Auth::user()->getCompanyStorage->sum('size')/1024,2)}}KB
                                @elseif(Auth::user()->getCompanyStorage->sum('size') > 1)
                                    {{number_format(Auth::user()->getCompanyStorage->sum('size'))}} bytes
                                @elseif(Auth::user()->getCompanyStorage->sum('size') == 1)
                                    {{number_format(Auth::user()->getCompanyStorage->sum('size'))}} byte
                                @else
                                    0 bytes
                                @endif
                            </h4>
                            <h6 class="text-muted m-b-0">Storage</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="ti-harddrives f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-pink">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">Max. Capacity</p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="{{route('manage-files')}}" class=""><i class="ti-eye text-white f-16"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue f-w-600">{{number_format(Auth::user()->getCompanyLeaseApplications->count())}}</h4>
                            <h6 class="text-muted m-b-0">Applications</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="ti-files f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p title="Approved as against total applications" class="text-white m-b-0">
                                {{Auth::user()->getCompanyLeaseApplications->count() > 0 ? ceil((Auth::user()->getCompanyLeaseApplications->where('status',1)->count()/Auth::user()->getCompanyLeaseApplications->count())*100) : 0}}% Lease Application</p>
                        </div>
                        <div class="col-3 text-right">
                            <a href="{{route('lease-applications')}}" class=""><i class="ti-eye text-white f-16"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="sub-title">Invoices</div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="d-inline-block text-c-green m-r-10">{{'₦'.number_format(Auth::user()->getCompanyInvoices->sum('paid_amount'),2)}}</h5>
                                    <br>
                                    <div class="d-inline-block">
                                        <p class="text-muted  m-b-0">Paid</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="d-inline-block text-c-pink m-r-10">{{'₦'.number_format(Auth::user()->getCompanyInvoices->sum('total') - Auth::user()->getCompanyInvoices->sum('paid_amount'),2)}}</h5>
                                    <div class="d-inline-block">
                                        <p class="text-muted m-b-0">Pending</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tenant</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php $in = 1; @endphp
                                            @foreach(Auth::user()->getCompanyInvoices->take(5) as $invoice)
                                                <tr>
                                                    <td>{{$in++}}</td>
                                                    <td>{{$invoice->getApplicant->first_name ?? '' }} {{$invoice->getApplicant->surname ?? '' }}</td>
                                                    <td>
                                                        @switch($invoice->status)
                                                            @case(0)
                                                            <label for="" class="label label-warning">Pending</label>
                                                            @break
                                                            @case(1)
                                                            <label for="" class="label label-success">Fully-paid</label>
                                                            @break
                                                            @case(2)
                                                            <label for="" class="label label-info">Partly-paid</label>
                                                            @break
                                                            @case(3)
                                                            <label for="" class="label label-danger">Declined</label>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td class="text-right">{{'₦'.number_format($invoice->total ?? 0 ,2)}}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="text-right m-r-20">
                                            <a href="{{route('manage-invoices')}}" class=" b-b-primary text-primary">View Invoices</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="sub-title">Bills</div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="d-inline-block text-c-green m-r-10">{{'₦'.number_format(Auth::user()->getCompanyBills->sum('paid_amount'),2)}}</h5>
                                    <br>
                                    <div class="d-inline-block">
                                        <p class="text-muted  m-b-0">Paid</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="d-inline-block text-c-pink m-r-10">{{'₦'.number_format(Auth::user()->getCompanyBills->sum('total') - Auth::user()->getCompanyBills->sum('paid_amount'),2)}}</h5>
                                    <div class="d-inline-block">
                                        <p class="text-muted m-b-0">Pending</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-borderless">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tenant</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $bi = 1; @endphp
                                            @foreach(Auth::user()->getCompanyBills->take(5) as $bill)
                                                <tr>
                                                    <td>{{$bi++}}</td>
                                                    <td>{{$bill->getVendor->first_name ?? '' }} {{$bill->getVendor->surname ?? '' }}</td>
                                                    <td>
                                                        @switch($bill->status)
                                                            @case(0)
                                                            <label for="" class="label label-warning">Pending</label>
                                                            @break
                                                            @case(1)
                                                            <label for="" class="label label-success">Fully-paid</label>
                                                            @break
                                                            @case(2)
                                                            <label for="" class="label label-info">Partly-paid</label>
                                                            @break
                                                            @case(3)
                                                            <label for="" class="label label-danger">Declined</label>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td class="text-right">{{'₦'.number_format($bill->total ?? 0 ,2)}}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="text-right m-r-20">
                                            <a href="{{route('manage-bills')}}" class=" b-b-primary text-primary">View Bills</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="sub-title">Schedule Lease @if(Auth::user()->getScheduleLeases->where('status',0)->count() > 0)<sup><label for="" class="badge-danger badge">{{Auth::user()->getScheduleLeases->where('status',0)->count()}}</label></sup>@endif</div>
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-borderless">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tenant</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            @php $l = 1; @endphp
                                            <tbody>

                                            @foreach(Auth::user()->getScheduleLeases->take(5) as $schedule)
                                                <tr>
                                                    <td>{{$l++}}</td>
                                                    <td>{{$schedule->getTenant->getApplicant->first_name ?? '' }} {{$schedule->getTenant->getApplicant->surname ?? '' }}</td>
                                                    <td class="text-right">
                                                        @if($schedule->status == 0)
                                                            <label for="" class="label label-warning">Pending</label>
                                                        @else
                                                            <label for="" class="label label-success">Started</label>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="text-right m-r-20">
                                            <a href="{{route('schedule-lease')}}" class=" b-b-primary text-primary">Load more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-block">
                    <div class="sub-title">Upcoming Renewals</div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tenant</th>
                                <th>Days Left</th>
                                <th>End Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $r = 1; @endphp
                            @foreach($renewals->take(10) as $renew)
                                <tr>
                                    <td>{{$r++}}</td>
                                    <td>{{$renew->getApplicant->first_name ?? '' }} {{$renew->getApplicant->surname ?? '' }}</td>
                                    <td>
                                        <label for="" class="badge-danger badge">{{intval(abs((strtotime($renew->end_date) - strtotime(now())))/86400) ?? '' }}</label>
                                    </td>
                                    <td>
                                        @switch($renew->status)
                                            @case(1)
                                            <label for="" class="label label-success">Renting</label>
                                            @break
                                            @case(2)
                                            <label for="" class="label label-info">Expired</label>
                                            @break
                                            @case(3)
                                            <label for="" class="label label-danger">Evicted</label>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            <a href="{{route('leases')}}" class=" b-b-primary text-primary">Manage Lease</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')


@endsection
