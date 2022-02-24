@extends('layouts.master-layout')
@section('title')
    Add New Application
@endsection

@section('current-page')
    Add New Application
@endsection
@section('current-page-brief')
Fill the form below to submit a new tenant application on the behalf of someone. The application will go through a series of approval before finally approved.
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('prospect-applications')}}"><i class="icofont icofont-tags"></i>Manage Applications</a>
        <a class="btn btn-primary btn-mini" href="{{route('new-application')}}"><i class="icofont icofont-tasks"></i>Add New Application</a>
        <a class="btn btn-danger btn-mini" href=""><i class="icofont icofont-megaphone"></i>Reports</a>
    </div>
@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="card">
                <div class="card-header">
                    <h5>New Tenant Application</h5>
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
                    <form autocomplete="off" action="{{route('new-application')}}" method="post">
                        @csrf
                            <div class="row">
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

                            </div>
                            <div class="row">
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
                                        <label for="">Date of Residency <sup class="text-danger">*</sup></label>
                                        <input type="date" class="form-control" placeholder="Date of Residency" name="date_of_residency" value="{{old('date_of_residency')}}">
                                        @error('date_of_residency')
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
                            <div class="row">
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
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Means of Identification</label>
                                        <select name="means_of_identification" id="means_of_identification" class="form-control">
                                            <option disabled selected>--Select means of identification--</option>
                                            <option value="1">Passport</option>
                                            <option value="2">Driver's License</option>
                                            <option value="3">National ID Card</option>
                                            <option value="4">INEC Registration Card</option>
                                        </select>
                                        @error('means_of_identification')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Attachment</label>
                                        <input type="file" name="attachment" class="form-control-file" value="{{old('attachment')}}">
                                        @error('attachment')
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
                                        <button class="btn btn-primary btn-mini"><i class="ti-check"></i> Submit</button>
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
