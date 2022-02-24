@extends('layouts.master-layout')
@section('title')
    Add New Lease Application
@endsection

@section('current-page')
    Add New Lease Application
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.lease.partials._menu')
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Add New Lease Application</h5>
                    <p>Use the form below to submit an application.</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6 off-set-md-3 offset-lg-3">
                        <div class="card">
                            <div class="card-block">
                                @if(session()->has('success'))
                                    <div class="alert alert-success background-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled text-white"></i>
                                        </button>
                                        {!! session()->get('success') !!}
                                    </div>
                                @endif
                                <form action="{{route('add-lease-application')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" placeholder="First Name" value="{{old('first_name')}}" name="first_name" class="form-control">
                                                @error('first_name')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Surname</label>
                                                <input type="text" placeholder="Surname" value="{{old('surname')}}" name="surname" class="form-control">
                                                @error('surname')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Email Address</label>
                                                <input type="text" placeholder="Email Address" value="{{old('email')}}" name="email" class="form-control">
                                                @error('email')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Mobile No.</label>
                                                <input type="text" placeholder="Mobile No." value="{{old('mobile_no')}}" name="mobile_no" class="form-control">
                                                @error('mobile_no')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Residency Date <small>(Optional)</small></label>
                                                <input type="date" placeholder="Residency Date" value="{{old('date_of_residency')}}" name="date_of_residency" class="form-control">
                                                @error('date_of_residency')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Property</label>
                                                <select name="property" id="property" class="form-control js-example-basic-single" value="{{old('property')}}">
                                                    <option disabled selected>-- Select property --</option>
                                                    @foreach($properties as $property)
                                                        <option value="{{$property->id}}">{{$property->property_name ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('property')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">

                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" name="address" id="address" placeholder="Type address here...">{{old('address')}}</textarea>
                                                @error('address') <small class="form-text text-danger">{{$message}}</small> @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
