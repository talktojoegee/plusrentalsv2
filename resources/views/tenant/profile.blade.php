@extends('layouts.main-layout')
@section('title')
    Profile
@endsection
@section('meta-keywords')
    Real estate, smart homes, property listing, properties, rent payment, tenant portal,
@endsection
@section('meta-description')
 is a property manage...
@endsection
@section('extra-styles')

@endsection

@section('main-content')
    <div class="parallax titlebar" data-background="/images2/listings-parallax.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505" style="background-image: url(&quot;/images2/listings-parallax.jpg&quot;); background-attachment: fixed; background-size: 1519px 958.869px; background-position: 50% -532.7px;"><div class="parallax-overlay" style="background-color: rgb(48, 48, 48); opacity: 0.8;"></div>
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Profile</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('profile')}}">Home</a></li>
                                <li>My Profile</li>
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
            <div class="col-md-9">
                <div class="utf-user-profile-item">
                    <div class="utf-submit-page-inner-box">
                        <h3>My Account</h3>
                        <div class="content with-padding">
                            <div class="col-md-6">
                                <label>Your Name</label>
                                <input value="John Williams" type="text">
                            </div>
                            <div class="col-md-6">
                                <label>Your Title</label>
                                <input value="Agent In Afghanistan" type="text">
                            </div>
                            <div class="col-md-6">
                                <label>Phone Number</label>
                                <input value="(+21) 124 123 4546" type="text">
                            </div>
                            <div class="col-md-6">
                                <label>Email Address</label>
                                <input value="info@example.com" type="text">
                            </div>
                            <div class="col-md-12 margin-bottom-0">
                                <label>Message</label>
                                <textarea name="about" id="about" cols="20" rows="5">Lorem Ipsum is simply dummy text of printing and type setting industry Lorem Ipsum been industry standard dummy text ever since. Lorem Ipsum is simply dummy text of printing and type setting industry Lorem Ipsum been industry standard dummy text ever since.</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="utf-submit-page-inner-box">
                        <h3>Social Accounts</h3>
                        <div class="content with-padding">
                            <div class="col-md-6">
                                <label><i class="icon-brand-facebook"></i> Facebook</label>
                                <input value="https://www.facebook.com" type="text">
                            </div>
                            <div class="col-md-6">
                                <label><i class="icon-brand-twitter"></i> Twitter</label>
                                <input value="https://www.twitter.com" type="text">
                            </div>
                            <div class="col-md-6">
                                <label><i class="icon-brand-linkedin"></i> Linkedin</label>
                                <input value="https://www.linkedin.com" type="text">
                            </div>
                            <div class="col-md-6">
                                <label><i class="icon-brand-google"></i> Google</label>
                                <input value="https://www.google.com" type="text">
                            </div>
                            <div class="col-md-6">
                                <label><i class="icon-brand-pinterest"></i> Pinterest</label>
                                <input value="https://www.pinterest.com" type="text">
                            </div>
                            <div class="col-md-6">
                                <label><i class="icon-feather-instagram"></i> Instagram</label>
                                <input value="https://www.instagram.com" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="utf-centered-button button margin-top-0 margin-bottom-20">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

@endsection
