@extends('layouts.master-layout')
@section('title')
    Add New Tenant
@endsection

@section('current-page')
    Add New Tenant
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
                    <h5>Add New Tenant</h5>
                    <p><strong class="text-danger">NOTE:</strong> payment pending</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
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
                                <form action="{{route('add-new-lease')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
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
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">First Name <sup class="text-danger">*</sup></label>
                                                <input type="text" name="first_name" placeholder="First Name" value="{{old('first_name')}}" class="form-control">
                                                @error('first_name')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Surname <sup class="text-danger">*</sup></label>
                                                <input type="text" name="first_name" placeholder="Surname" value="{{old('surname')}}" class="form-control">
                                                @error('surname')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Mobile No. <sup class="text-danger">*</sup></label>
                                                <input type="text" name="mobile_no" placeholder="Mobile No." value="{{old('mobile_no')}}" class="form-control">
                                                @error('mobile_no')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Residency Date <sup class="text-danger">*</sup></label>
                                                <input type="date" name="mobile_no" placeholder="Mobile No." value="{{old('mobile_no')}}" class="form-control">
                                                @error('mobile_no')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Lease Period</label>
                                                <div class="input-group input-group-button">
                                                <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                                    <span class="">Start Date</span>
                                                </span>
                                                    <input type="date" class="form-control" name="start_date" placeholder="Start Date">
                                                    <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                                    <span class="">Frequency</span>
                                                </span>
                                                    <select name="frequency" id="frequency" class="form-control ">
                                                        <option disabled selected>--Select frequency--</option>
                                                        @foreach($frequencies as $frequency)
                                                            <option value="{{$frequency->id}}">{{$frequency->frequency ?? ""}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('frequency') <small class="form-text text-danger">{{$message}}</small> @enderror
                                                <br>
                                                @error('start_date') <small class="form-text text-danger">{{$message}}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="">Rent Amount</label>
                                                <input type="number" name="rent_amount" step="0.01" placeholder="Rent Amount" class="form-control">
                                                @error('rent_amount')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="">Security Deposit</label>
                                                <input type="number" step="0.01" name="security_deposit" placeholder="Security Deposit" class="form-control">
                                                @error('security_deposit')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="1" name="terms_and_conditions">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span>By clicking submit you are agreeing to the Terms and Conditions.</span>
                                                </label>
                                            </div>
                                            @error('terms_and_conditions')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
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
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Property Details</h5>
                                <div class="view-info" id="property_details">

                                </div>
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
    <script src="/assets/js/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $(document).on('change', '#property', function(e){
                e.preventDefault();
                axios.post('/lease/get-property',{property:$(this).val()})
                    .then(response=>{
                        $('#property_details').html(response.data);
                        $('.js-example-basic-single').select2();
                    });
            });
        });
    </script>
@endsection
