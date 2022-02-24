@extends('layouts.tenant-layout')

@section('title')
    Pricing
@endsection

@section('meta-title')
    Pricing
@endsection

@section('meta-keywords')
    Pricing
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/price.css">
@endsection
@section('main-content')
    <section class="single-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>Pricing</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="price-part" style="margin-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="price-card">
                        <div class="price-head">
                            <h5>What's included in every plan</h5>
                        </div>
                        <ul class="" style="list-style: square;">
                            <li>
                               Accounting
                            </li>
                            <li>Lease Application</li>
                            <li>Task Management</li>
                            <li>Storage</li>
                            <li>Bank Integration</li>
                            <li>Online Portals</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="price-card">
                        <div class="price-head">
                            <i class="flaticon-bicycle"></i>
                            <h5 style="color: #F3136B;">₦3,000/month</h5>
                            <h4>Essential</h4>
                        </div>
                        <div class="price-btn">
                            <a href="{{route('register')}}" class="btn btn-inline" style="padding:5px;">
                                <span>Start Free Trial</span>
                            </a>
                        </div>
                        <ul class="price-list">
                            <li><i class="fa fa-star"></i>
                                <p>Unlimited units</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>5 users</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>Online Payments</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>100MB storage</p></li>
                            <li><i class="fa fa-star"></i><p>eInvoice</p></li>
                            <li><i class="fa fa-star"></i><p>Extra unit ₦1,300</p></li>
                        </ul>

                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="price-card price-active">
                        <div class="price-head">
                            <i class="flaticon-car-wash"></i>
                            <h5 style="color: #F3136B;">₦5,500/month</h5>
                            <h4>Growth</h4>
                        </div>
                        <div class="price-btn">
                            <a href="{{route('register')}}" class="btn btn-inline" style="padding:5px;">
                                <span>Start Free Trial</span>
                            </a>
                        </div>
                        <ul class="price-list">
                            <li><i class="fa fa-star"></i>
                                <p> Unlimited units</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>20 users</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>Online Payments</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>10GB storage</p></li>
                            <li><i class="fa fa-star"></i><p>eInvoice</p></li>
                            <li><i class="fa fa-star"></i><p>Extra unit ₦2,550</p></li>
                        </ul>

                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="price-card">
                        <div class="price-head">
                            <i class="flaticon-airplane"></i>
                            <h5 style="color: #F3136B;">₦9,900/month</h5>
                            <h4>Premium</h4>
                        </div>
                        <div class="price-btn">
                            <a href="{{route('register')}}" class="btn btn-inline" style="padding:5px;">
                                <span>Start Free Trial</span>
                            </a>
                        </div>
                        <ul class="price-list">
                            <li><i class="fa fa-star"></i>
                                <p> Unlimited units</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>20 users</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>Online Payments</p>
                            </li>
                            <li><i class="fa fa-star"></i>
                                <p>10GB storage</p></li>
                            <li><i class="fa fa-star"></i><p>eInvoice</p></li>
                            <li><i class="fa fa-star"></i><p>Extra unit ₦4,750</p></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Setup a free account within seconds</h2>
                        <p>We understand your need to first get familiar with the system before making any financial commitment. Our 14-days <strong>FREE</strong> trial offers you the opportunity to do that and more.</p>
                        <a href="{{route('register')}}" class="btn btn-outline mt-3">
                            <span>START FREE TRIAL</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('extra-scripts')

@endsection
