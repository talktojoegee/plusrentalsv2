@extends('layouts.tenant-layout')

@section('title')
    Profile
@endsection

@section('meta-title')
    Profile
@endsection

@section('meta-keywords')
    Profile
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/profile.css">
@endsection
@section('current-page')
    Profile
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
@include('tenant.partials._dash-header2')

<section class="profile-part">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h3>Lease</h3>
                                <a href="{{route('settings')}}">All</a>
                            </div>

                            <ul class="account-card-list">
                                <li>
                                    <h5>Status</h5>
                                    <p><label for="" class="badge badge-info">{{Auth::user()->account_status == 1 ? 'Active' : 'Deactivated'}}</label></p>
                                </li>
                                <li>
                                    <h5>Start Date</h5>
                                    <p class="text-success"><label for="" >{{date('d F, Y', strtotime(Auth::user()->start_date))}}</label></p>
                                </li>
                                <li>
                                    <h5>End Date</h5>
                                    <p class="text-danger"><label for="" >{{date('d F, Y', strtotime(Auth::user()->end_date))}}</label></p>
                                </li>
                                <li>
                                    <h5>Frequency</h5>
                                    <p>Annual</p>
                                </li>
                            </ul>
                        </div>
                        <div class="account-card">
                            <div class="account-title">
                                <h3>Rental Owner</h3>

                            </div>
                            <ul class="account-card-list">
                                @if(Auth::user()->getProperty->getRentalOwner->ownership_type == 1)
                                <li>
                                    <h5>Full Name:</h5>
                                    <p>
                                        <a href="javascript:void(0);" target="_blank">{{ Auth::user()->getProperty->getRentalOwner->first_name .' '.Auth::user()->getProperty->getRentalOwner->surname ?? '' }}</a>
                                    </p>
                                </li>
                                    <li>
                                        <h5>Mobile:</h5>
                                        <p>
                                            <a href="javascript:void(0);" target="">{{ Auth::user()->getProperty->getRentalOwner->mobile_no  ?? '-' }}</a>
                                        </p>
                                    </li>
                                    <li>
                                        <h5>Email:</h5>
                                        <p>
                                            <a href="javascript:void(0);" target="">{{ Auth::user()->getProperty->getRentalOwner->email  ?? '-' }}</a>
                                        </p>
                                    </li>
                                    <li>
                                        <h5>Address:</h5>
                                        <p>
                                            <a href="javascript:void(0);">{{Auth::user()->getProperty->getRentalOwner->address ?? '-'}}</a>
                                        </p>
                                    </li>
                                @endif
                                @if(Auth::user()->getProperty->getRentalOwner->ownership_type == 2)
                                <li>
                                    <h5>Company Name:</h5>
                                    <p>
                                        <a href="javascript:void(0);" target="">{{ Auth::user()->getProperty->getRentalOwner->company_name  ?? '-' }}</a>
                                    </p>
                                </li>
                                <li>
                                    <h5>Phone:</h5>
                                    <p>
                                        <a href="javascript:void(0);" target="">{{ Auth::user()->getProperty->getRentalOwner->mobile_no  ?? '-' }}</a>
                                    </p>
                                </li>
                                        <li>
                                    <h5>Email:</h5>
                                    <p>
                                        <a href="javascript:void(0);" target="">{{ Auth::user()->getProperty->getRentalOwner->email  ?? '-' }}</a>
                                    </p>
                                </li>
                                <li>
                                    <h5>Company Address:</h5>
                                    <p>
                                        <a href="javascript:void(0);">{{Auth::user()->getProperty->getRentalOwner->address ?? '-'}}</a>
                                    </p>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h3>Latest Payment</h3>
                                <a href="#">All</a>
                            </div>
                            <ul class="account-card-list">
                                <li>
                                    <h5>Transaction Date</h5>
                                    <p>{{date('d M, Y', strtotime($latest->created_at))}}</p>
                                </li>
                                <li>
                                    <h5>Amount:</h5>
                                    <p>{{'₦'.number_format($latest->total ?? 0)}}</p>
                                </li>
                                <li>
                                    <h5>Receipt No:</h5>
                                    <p>{{$latest->receipt_no ?? ''}}</p>
                                </li>
                                <li>
                                    <h5>Transaction Ref:</h5>
                                    <p>{{$latest->trans_ref ?? ''}}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="account-card">
                            <div class="account-title">
                                <h3>Care Taker</h3>
                                <a href="setting.html">Detail</a>
                            </div>
                            <ul class="account-card-list">
                                <li>
                                    <h5>Post Code:</h5>
                                    <p>1100</p>
                                </li>
                                <li>
                                    <h5>State:</h5>
                                    <p>Kawran Bazar</p>
                                </li>
                                <li>
                                    <h5>City:</h5>
                                    <p>Dhaka</p>
                                </li>
                                <li>
                                    <h5>Country:</h5>
                                    <p>Bangladesh</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
