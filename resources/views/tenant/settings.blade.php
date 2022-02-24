@extends('layouts.main-layout')

@section('title')
    Settings
@endsection

@section('meta-title')
    Settings
@endsection

@section('meta-keywords')
    Settings
@endsection
@section('extra-styles')

    <link rel="stylesheet" href="/css/custom/select2.min.css">
@endsection
@section('current-page')
    Settings
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
                        <h2>Settings</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('profile')}}">Home</a></li>
                                <li>Settings</li>
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
                <div class="col-md-9 widget utf-sidebar-widget-item">
                    @if(session()->has('success'))
                        <div class="notification success closeable">
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="utf-inner-list-headline-item">
                        <h3>Settings</h3>
                    </div>
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><i class="icon-feather-briefcase"></i> Personal Info</a></li>
                        <li><a href="#tab2a"><i class="icon-material-outline-fingerprint"></i> Security</a></li>
                    </ul>
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a" style="display: inline-block;">
                            <form class="setting-form mt-5" action="{{route('settings')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">First Name<sup class="text-danger">*</sup></label>
                                            <input type="text" name="first_name" value="{{old('first_name', Auth::user()->getApplicant->first_name)}}" class="form-control" placeholder="First Name">
                                            @error('first_name')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Surname<sup class="text-danger">*</sup></label>
                                            <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{old('surname', Auth::user()->getApplicant->surname)}}">
                                            @error('surname')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Email Address<sup class="text-danger">*</sup></label>
                                            <input type="text" readonly name="email" value="{{old('email', Auth::user()->email)}}" class="form-control" placeholder="Email">
                                            @error('email')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Mobile No.<sup class="text-danger">*</sup></label>
                                            <input type="text" class="form-control" placeholder="Mobile No." name="mobile_no" value="{{old('mobile_no', Auth::user()->getApplicant->mobile_no)}}">
                                            @error('mobile_no')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Address<sup class="text-danger">*</sup></label>
                                            <input type="text" class="form-control" placeholder="Address" name="address" value="{{old('address', Auth::user()->getApplicant->address)}}">
                                            @error('address')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Avatar</label>
                                            <input type="file" name="avatar" class="form-control">
                                            @error('avatar')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12  utf-centered-button">
                                        <button class="button">
                                            <i class="icon-feather-user mr-2"></i>
                                            <span>Save changes</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-content" id="tab2a" style="display: none;">
                            <form class="setting-form mt-5" action="{{route('change-password')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Current Password<sup class="text-danger">*</sup></label>
                                            <input type="password" name="current_password"  class="form-control" placeholder="Current Password">
                                            @error('current_password')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">New Password<sup class="text-danger">*</sup></label>
                                            <input type="password" class="form-control" placeholder="New Password" name="password" >
                                            @error('password')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Re-type Password<sup class="text-danger">*</sup></label>
                                            <input type="password" name="password_confirmation"  class="form-control" placeholder="Re-type Password">
                                            @error('password_confirmation')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 utf-centered-button">
                                        <button class="button">
                                            <i class="icon-feather-unlock mr-2"></i>
                                            <span>Change password</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-scripts')
<script src="/js/custom/select2.min.js"></script>
<script src="/js/custom/axios.min.js"></script>
<script>
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
        $(document).on('change', '#location', function(e){
            e.preventDefault();
            axios.post('/get-location', {location:$(this).val()})
            .then(response=>{
                $('#area-wrapper').html(response.data)
                   // $(".js-example-basic-single").select2();
            });
        });
    });
</script>

@endsection
