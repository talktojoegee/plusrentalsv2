@extends('layouts.master-layout')
@section('title')
    Company Details
@endsection

@section('current-page')

@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('properties')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Properties</a>
        <a href="{{route('add-new-property')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Add New Property</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
@endsection
@section('main-content')
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="sub-title">General Settings</div>
                    @if(session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-warning background-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                @endif
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Company Info</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Bulk SMS</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="home3" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Company Details</h5>
                                    <p>Edit company details</p>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <form action="{{route('general-settings')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Company Name</label>
                                                            <input type="text" placeholder="Company Name" name="company_name" id="company_name" class="form-control" value="{{old('company_name', Auth::user()->getUserCompany->company_name)}}">
                                                            @error('company_name')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Mobile No.</label>
                                                            <input type="text" placeholder="Mobile No." name="mobile_no" id="mobile_no" class="form-control" value="{{old('mobile_no', Auth::user()->getUserCompany->mobile_no)}}">
                                                            @error('mobile_no')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Phone No.</label>
                                                            <input type="text" placeholder="Phone No." name="phone_no" id="phone_no" class="form-control" value="{{old('phone_no', Auth::user()->getUserCompany->phone_no)}}">
                                                            @error('phone_no')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Location</label>
                                                            <select name="location" id="location" class="form-control js-example-basic-single" value="{{old('location')}}">
                                                                <option disabled selected>--Select location--</option>
                                                                @foreach($locations as $location)
                                                                    <option value="{{$location->id}}">{{$location->location_name ?? ''}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('location')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Area</label>
                                                            <div id="areaWrapper"></div>
                                                            @error('area')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">City</label>
                                                            <input type="text" placeholder="City" name="city" id="city" class="form-control" value="{{old('city', Auth::user()->getUserCompany->city)}}">
                                                            @error('city')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Address 1</label>
                                                            <textarea name="address_1" style="resize:none;" placeholder="Address 1"
                                                                      class="form-control">{{old('address_1', Auth::user()->getUserCompany->address_1)}}</textarea>
                                                            @error('address_1')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Address 2</label>
                                                            <textarea name="address_2" style="resize:none;" placeholder="Address 2"
                                                                      class="form-control">{{old('address_2', Auth::user()->getUserCompany->address_2)}}</textarea>
                                                            @error('address_2')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Post Code</label>
                                                            <input type="text" placeholder="Post Code" name="post_code" id="post_code" class="form-control" value="{{old('post_code', Auth::user()->getUserCompany->post_code)}}">
                                                            @error('post_code')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Website</label>
                                                            <input type="text" placeholder="Website" name="website" id="website" class="form-control" value="{{old('website', Auth::user()->getUserCompany->website)}}">
                                                            @error('website')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Tagline</label>
                                                            <input type="text" placeholder="Tagline" name="tagline" id="tagline" class="form-control" value="{{old('tagline', Auth::user()->getUserCompany->tagline)}}">
                                                            @error('tagline')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Phone No.</label>
                                                            <input type="text" placeholder="Phone No." name="phone_no" id="phone_no" class="form-control" value="{{old('phone_no', Auth::user()->getUserCompany->phone_no)}}">
                                                            @error('phone_no')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Logo</label>
                                                            <input type="file" placeholder="Logo" name="logo" id="logo" class="form-control-file" value="{{old('logo', Auth::user()->getUserCompany->logo)}}">
                                                            @error('logo')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Favicon</label>
                                                            <input type="file" placeholder="Favicon" name="favicon" id="favicon" class="form-control-file" value="{{old('favicon', Auth::user()->getUserCompany->favicon)}}">
                                                            @error('favicon')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                                        <div class="btn-group">
                                                            <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                                            <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages3" role="tabpanel">
                            <form action="{{route('update-bulk-settings')}}" method="post" autocomplete="off">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0 card-title">Bulk SMS</h3>
                                    </div>
                                    <div class="card-body">
                                        <p><strong class="text-danger">Note:</strong> Your Sender ID for bulk SMS service needs to be verified before you'll be able to send SMS. This process usually takes 24-48 hours. Kindly get that done in time.</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Sender ID</label>
                                                    <input type="text" class="form-control" value="{{old('sender_id',Auth::user()->getUserCompany->sender_id) }}" maxlength="10" name="sender_id" placeholder="Sender ID">
                                                    @error('sender_id') <i class="text-danger">{{$message}}</i>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a href="{{url()->previous()}}" class="btn btn-danger">Cancle</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="settings3" role="tabpanel">
                            <p class="m-0">4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script type="text/javascript" src="/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/bower_components/tinymce.js"></script>
    <script>
        $(document).ready(function(){
            $('.js-example-basic-single').select2();


            $(document).on('change', '#location', function(e){
                e.preventDefault();
                axios.post('/location/area', {location:$(this).val()})
                    .then(response=>{
                        $('#areaWrapper').html(response.data);
                        $('.js-example-basic-single').select2();
                    })
                    .catch(error=>{

                    });
            });

            $(document).on('change', '#default_account', function(e){
                e.preventDefault();
                if($(this).val() == 2){
                    $('#accountWrapper').show();
                    $('.js-example-basic-single').select2();
                }else{
                    $('#accountWrapper').hide();
                    $('.js-example-basic-single').select2();
                }
            });
        });
    </script>

@endsection
