@extends('layouts.tenant-layout')

@section('title')
    Notifications
@endsection

@section('meta-title')
    Notifications
@endsection

@section('meta-keywords')
    Notifications
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/bookmark.css">
@endsection
@section('current-page')
    Notifications
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection

@section('main-content')
    @include('tenant.partials._dash-header2')
    <section class="bookmark-part">
        <div class="container">
            <div class="row">
                @if(Auth::user()->getAllUnreadTenantNotifications->count() > 0)
                    <div class="col-md-12 col-lg-12 mb-4">
                        <div class="account-title d-flex justify-content-end">
                            <a href="{{route('mark-all-as-read')}}" class="tooltip btn btn-inline">
                                Mark All As Read
                            </a>
                        </div>
                    </div>
                @endif
                @foreach (Auth::user()->getAllTenantNotifications as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3 card-grid col-sm-12 col-md-12 col-lg-12">
                        <div class="product-card inline">
                            <div class="product-head">
                                <div class="dash-avatar p-2">
                                    <a href="javascript:void(0);">
                                        <img src="/images/avatar/avatar.png" style="width:82px;" alt="avatar">
                                    </a>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-tag">
                                    <i class="fa fa-clock-o"></i>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="javascript:void(0);">{{date('d F, Y h:ia', strtotime($item->created_at))}}</a>
                                        </li>
                                    </ol>
                                </div>
                                <div class="product-title">
                                    <h5>
                                        <a href="#">{{$item->subject ?? ''}}</a>
                                    </h5>
                                    <p>{{$item->body ?? ''}}</p>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <p>{{$item->created_at->diffForHumans()}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
