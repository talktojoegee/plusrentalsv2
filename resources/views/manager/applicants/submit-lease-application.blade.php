@extends('layouts.master-layout')
@section('title')
    Submit Lease Application for {{$applicant->first_name ?? ''}}
@endsection

@section('current-page')
    Submit Lease Application for <span class="text-primary">{{$applicant->first_name ?? ''}}</span>
@endsection
@section('current-page-brief')
    Submit Lease Application for <span class="text-primary">{{$applicant->first_name ?? ''}}</span>
@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('leases')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Leases</a>
        <a href="{{route('add-new-lease')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Add New Lease</a>
        <a href="{{route('lease-applications')}}" class="btn btn-warning btn-mini"><i class="icofont icofont-tasks"></i>Lease Applications</a>
        <button class="btn btn-danger btn-mini"><i class="icofont icofont-megaphone"></i>Reports</button>
    </div>
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
                    <p>Add a new lease to the system using the form below.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Property Details</h5>
                                <div class="view-info" id="property_details">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="general-info">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xl-12 col-md-12">
                                                        <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Property</h6>
                                                        <div class="table-responsive">
                                                            <table class="table m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Property Name.</th>
                                                                    <td>{{$property->property_name ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Property Type</th>
                                                                    <td>
                                                                        @switch($property->property_type)
                                                                            @case(1)
                                                                            Apartment
                                                                            @break
                                                                            @case(2)
                                                                            House
                                                                            @break
                                                                            @case(3)
                                                                            Land
                                                                            @break
                                                                            @case(4)
                                                                            Townhouse
                                                                            @break
                                                                            @case(5)
                                                                            Garden Cottage
                                                                            @break
                                                                            @case(6)
                                                                            Farm
                                                                            @break
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Unit No.</th>
                                                                    <td>{{$property->unit_no ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Location</th>
                                                                    <td>{{$property->getLocation->location_name ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Area</th>
                                                                    <td>{{$property->getArea->area_name ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Address</th>
                                                                    <td>{{$property->address ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Rental Amount</th>
                                                                    <td>{{ '₦'.number_format($property->rental_price ?? 0,2)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Security Fee</th>
                                                                    <td>{{ '₦'.number_format($property->security_deposit ?? 0,2)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Late Fee</th>
                                                                    <td class="text-danger">{{ '₦'.number_format($property->late_fee ?? 0,2)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Recurring Charge</th>
                                                                    <td class="text-info">
                                                                        @switch($property->frequency)
                                                                            @case('1')
                                                                            Monthly
                                                                            @break
                                                                            @case('2')
                                                                            Quarterly
                                                                            @break
                                                                            @case('3')
                                                                            Bi-annually
                                                                            @break
                                                                            @case('4')
                                                                            Annual
                                                                            @break
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <h5 class="sub-title">Applicant Details</h5>
                                <div class="view-info" id="applicant_details">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="general-info">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xl-12 col-md-12">
                                                        <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Applicant</h6>
                                                        <div class="table-responsive">
                                                            <table class="table m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Full Name</th>
                                                                    <td>{{$applicant->first_name ?? ''}} {{$applicant->surname ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Mobile No.</th>
                                                                    <td> {{$applicant->mobile_no ?? ''}} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td> {{$applicant->email ?? ''}} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Gender</th>
                                                                    <td> {{$applicant->gender == 1 ? 'Male' : 'Female' }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Marital Status</th>
                                                                    <td> {{$applicant->gender == 1 ? 'Male' : 'Female' }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Address</th>
                                                                    <td> {{$applicant->address ?? ''}} </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <input type="hidden" name="property" value="{{$property->id}}">
                                            <input type="hidden" name="applicant" value="{{$applicant->id}}">
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
