@extends('layouts.master-layout')
@section('title')
    Add New Lease
@endsection

@section('current-page')

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
                    <h5>Add New Lease</h5>
                    <p><strong class="text-danger">NOTE:</strong> This process will make an applicant due for ...</p>
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
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Applicant <small>(Tenant)</small></label>
                                                <select name="applicant" id="applicant" class="form-control js-example-basic-single" value="{{old('applicant')}}">
                                                    <option disabled selected>-- Select applicant --</option>
                                                    @foreach($applicants as $applicant)
                                                        <option value="{{$applicant->id}}">{{$applicant->first_name ?? ''}} {{$applicant->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('applicant')
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
                                <h5 class="sub-title">Applicant Details</h5>
                                <div class="view-info" id="applicant_details">

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
            $(document).on('change', '#applicant', function(e){
                e.preventDefault();
                axios.post('/lease/get-applicant/',{applicant:$(this).val()})
                    .then(response=>{
                        $('#applicant_details').html(response.data);
                        $('.js-example-basic-single').select2();
                    });
            });
        });
    </script>
@endsection
