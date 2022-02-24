@extends('layouts.master-layout')
@section('title')
    Add New Rental Owner
@endsection

@section('current-page')
    Add New Rental Owner
@endsection
@section('current-page-brief')
Fill the form below to submit a new tenant application on the behalf of someone. The application will go through a series of approval before finally approved.
@endsection

@section('event-area')
    @include('manager.rental-owner.partials._event-menu')
@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="card">
                <div class="card-header">
                    <h5>Add New Rental Owner</h5>
                    <p>Register new rental owner or landlord to the system by filling the form below with the necessary information.
                     You can later assign this owner to a property within the system.</p>
                </div>
                <div class="card-block">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form autocomplete="off" action="{{route('add-new-rental-owner')}}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Ownership Type </label>
                                        <select name="ownership_type" id="ownership_type" class="form-control">
                                            <option disabled selected>--Select ownership type</option>
                                            <option value="1">Individual Owner</option>
                                            <option value="2">Company/Trust</option>
                                        </select>
                                        @error('ownership_type')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row individual">
                                <div class="col-md-4 col-sm-4 col-lg-4 ">
                                    <div class="form-group">
                                        <label for="">Title </label>
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title')}}">
                                        @error('title')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">First Name <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name')}}">
                                        @error('first_name')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Surname <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{old('surname')}}">
                                        @error('surname')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Email Address <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{old('email')}}">
                                        @error('email')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Mobile No.<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" placeholder="Mobile No." name="mobile_no" value="{{old('mobile_no')}}">
                                        @error('mobile_no')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for=""> Address <sup class="text-danger">*</sup></label>
                                        <textarea style="resize: none;" name="address" id="address" placeholder="Type address here..." class="form-control">{{old('address')}}</textarea>
                                        @error('address')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row individual">
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Marital Status</label>
                                        <select name="marital_status" id="marital_status" class="form-control">
                                            <option selected disabled>--Select marital status--</option>
                                            <option value="1">Single</option>
                                            <option value="2">Married</option>
                                            <option value="3">Divorced</option>
                                            <option value="4">Separated</option>
                                            <option value="5">Widow</option>
                                            <option value="6">Widower</option>
                                            <option value="7">Complicated</option>
                                            <option value="8">Rather not say</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <label for="">Gender</label>
                                    <div class="form-radio">
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="gender" checked="checked" value="1">
                                                <i class="helper"></i>Male
                                            </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="gender" value="2">
                                                <i class="helper"></i>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row company">
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Company Name</label>
                                        <input type="text" placeholder="Company Name" name="company_name" value="{{old('company_name')}}" class="form-control">
                                        @error('company_name')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Official Phone No.</label>
                                        <input type="text" placeholder="Official Phone No." name="official_phone_no" value="{{old('official_phone_no')}}" class="form-control">
                                        @error('official_phone_no')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Official Email</label>
                                        <input type="text" placeholder="Official Email" name="official_email" value="{{old('official_email')}}" class="form-control">
                                        @error('official_email')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row company">
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Office Address</label>
                                        <textarea name="office_address" id="office_address" placeholder="Office Address" style="resize: none;" class="form-control"></textarea>
                                        @error('office_address')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <div class="btn-group">
                                        <a href="{{url()->previous()}}" class="btn btn-mini btn-danger"><i class="ti-close"></i> Cancel</a>
                                        <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check"></i> Submit</button>
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
    <script>
        $(document).ready(function(){
            $('.individual').hide();
            $('.company').hide();
            $(document).on('change', '#ownership_type', function(e){
                e.preventDefault();

                if($(this).val() == 1){
                    $('.individual').show();
                    $('.company').hide();
                }else{
                    $('.company').show();
                    $('.individual').hide();
                }
            });
        });
    </script>
@endsection
