@extends('layouts.main-layout')

@section('title')
    Add New Domestic Staff to {{Auth::user()->getProperty->property_name ?? ''}}
@endsection

@section('meta-title')
    Add New Domestic Staff to {{Auth::user()->getProperty->property_name ?? ''}}
@endsection

@section('meta-keywords')
    Add New Domestic Staff to {{Auth::user()->getProperty->property_name ?? ''}}
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/profile.css">
@endsection
@section('current-page')
    Add New Domestic Staff to {{Auth::user()->getProperty->property_name ?? ''}}
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
    <div class="parallax titlebar" data-background="/images2/listings-parallax.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505" style="background-image: url(&quot;/images2/listings-parallax.jpg&quot;); background-attachment: fixed; background-size: 1519px 958.869px; background-position: 50% -532.7px;"><div class="parallax-overlay" style="background-color: rgb(48, 48, 48); opacity: 0.8;"></div>
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Add New Domestic Staff</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('profile')}}">Home</a></li>
                                <li>Add New Domestic Staff</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @include('tenant.partials._dashboard-sidebar')
            <div class="">
                <div class="col-md-9 widget utf-sidebar-widget-item" style="">
                    @if(session()->has('success'))
                        <div class="notification success closeable">
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="utf-inner-list-headline-item">
                        <h3>Add New Domestic Staff</h3>
                    </div>
                        <form action="{{route('add-new-domestic-staff')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <input type="text" placeholder="First Name" name="first_name" value="{{old('first_name')}}" class="form-control">
                                        @error('first_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Surname</label>
                                        <input type="text" placeholder="Surname" name="surname" value="{{old('surname')}}" class="form-control">
                                        @error('surname')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Email Address <small>(Optional)</small></label>
                                        <input type="email" placeholder="Email Address" name="email" value="{{old('email')}}" class="form-control">
                                        @error('email')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Mobile No.</label>
                                        <input type="text" placeholder="Mobile No." name="mobile_no" value="{{old('mobile_no')}}" class="form-control">
                                        @error('mobile_no')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Responsibility</label>
                                        <input type="text" placeholder="Responsibility" name="responsibility" value="{{old('responsibility')}}" class="form-control">
                                        @error('responsibility')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Birth Date <small>(Optional)</small></label>
                                        <input type="date" placeholder="Birth Date" name="birth_date" value="{{old('birth_date')}}" class="form-control">
                                        @error('birth_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Comment</label>
                                        <textarea name="comment" placeholder="Leave comment..." id="comment" style="resize: none;" class="form-control">{{old('comment')}}</textarea>
                                        @error('comment')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 d-flex utf-centered-button">
                                    <div class="btn-group">
                                        <button class="button" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')

@endsection
