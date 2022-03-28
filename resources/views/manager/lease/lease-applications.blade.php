@extends('layouts.master-layout')
@section('title')
    Lease Applications
@endsection

@section('current-page')
    Lease Applications
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.lease.partials._menu-application')
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-calendar bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">All-time</span>
                    <h4>{{number_format($applicants->count())}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-calendar bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">This Year</span>
                    <h4>{{number_format($appThisYear)}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-calendar bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Last Month</span>
                    <h4>{{$appLastMonth}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-calendar bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">This Month</span>
                    <h4>{{number_format($appThisMonth)}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <p>List of active listings</p>
                            @if (session()->has('success'))
                                <div class="alert alert-success background-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('success') !!}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-warning background-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('error') !!}
                                </div>
                            @endif
                            <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc">S/No.</th>
                                    <th class="sorting_asc">Applicant</th>
                                    <th class="sorting" >Property</th>
                                    <th class="sorting"  >Date</th>
                                    <th class="sorting"  >Status</th>
                                    <th class="sorting"  >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($applicants as $applicant)
                                    <tr role="row" class="odd">
                                        <td>{{$serial++}}</td>
                                        <td>{{$applicant->first_name ?? ''}} {{$applicant->surname ?? ''}}</td>
                                        <td><a class="text-primary" target="_blank" href="{{route('view-property', $applicant->getProperty->slug)}}">{{$applicant->getProperty->property_name ?? ''}}</a> </td>
                                        <td class="text-right">{{date('d M,Y', strtotime($applicant->created_at))}}</td>
                                        <td>
                                            @switch($applicant->status)
                                                @case(0)
                                                    Pending
                                                @break
                                                @case(1)
                                                    Approved
                                                @break
                                                @case(2)
                                                    Declined
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#Modal-overflow_{{$applicant->id}}" class="btn btn-mini btn-info"><i class="icofont icofont-eye-alt"></i></button>
                                            <div class="modal fade modal-flex" id="Modal-overflow_{{$applicant->id}}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-uppercase">Application Details</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body model-container">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <!-- Nav tabs -->
                                                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tab" href="#home_{{$applicant->id}}" role="tab">Applicant</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#profile_{{$applicant->id}}" role="tab">Property</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                </ul>
                                                                <!-- Tab panes -->
                                                                <div class="tab-content card-block">
                                                                    <div class="tab-pane active" id="home_{{$applicant->id}}" role="tabpanel">
                                                                        <h6 class="text-white text-uppercase bg-secondary p-2">Applicant</h6>
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
                                                                    <div class="tab-pane" id="profile_{{$applicant->id}}" role="tabpanel">
                                                                        <h6 class="text-white text-uppercase bg-secondary p-2">Property</h6>
                                                                        <div class="table-responsive">
                                                                            <table class="table m-0">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Property Name</th>
                                                                                    <td>{{$applicant->getProperty->property_name ?? ''}} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Property Type</th>
                                                                                    <td>
                                                                                        @switch($applicant->getProperty->property_type)
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
                                                                                    <td> {{$applicant->getProperty->unit_no ?? ''}} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Location</th>
                                                                                    <td> {{$applicant->getProperty->getLocation->location_name ?? ''}} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Area</th>
                                                                                    <td> {{$applicant->getProperty->getArea->area_name ?? '' }} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Address</th>
                                                                                    <td> {{$applicant->getProperty->address ?? ''}} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Rental Amount</th>
                                                                                    <td> {{'₦'.number_format($applicant->getProperty->rental_price,2) ?? ''}} </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Listing Type</th>
                                                                                    <td> {{ $applicant->getProperty->listing_type == 1 ? 'For rent' : 'For sale' }} </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12 d-flex justify-content-center">
                                                                                <a href="{{route('view-property', $applicant->getProperty->slug)}}" target="_blank" class="btn btn-sm btn-light">Learn more</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <div class="btn-group">
                                                                <button type="button"  class="btn-mini btn-default btn"><i class="ti-close mr-2"></i>Cancel</button>
                                                                @if($applicant->status == 0)
                                                                    <button type="button" class="btn-mini btn-primary btn approve" data-target="#approve-modal_{{$applicant->id}}" data-aslug="{{$applicant->url}}" data-pslug="{{$applicant->getProperty->slug}}" data-applicant="{{$applicant->first_name ?? ''}}"  data-appid="{{$applicant->id ?? ''}}" data-property="{{$applicant->getProperty->id ?? ''}} " data-toggle="modal"><i class="ti-check mr-2"></i>Generate Invoice</button>
                                                                    <div class="modal fade" id="approve-modal_{{$applicant->id}}" tabindex="-1" role="dialog">
                                                                        <div class="modal-dialog" role="document">

                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-success">
                                                                                    <h5 class="modal-title">Are You Sure?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true" class="text-white">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h6>Are you sure you want to generate an invoice for <strong id="">{{$applicant->first_name ?? ''}}</strong>'s
                                                                                        <br> lease application?</h6>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <div class="btn-group">
                                                                                        <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                                                                                        <a class="btn btn-mini btn-primary"  href="{{route('generate-invoice-for', ['applicant'=>$applicant->url, 'property'=>$applicant->getProperty->slug])}}"><i class="ti-check mr-2"></i>Yes, please</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn-mini btn-danger btn"><i class="ti-close mr-2"></i>Decline Application</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th >S/No.</th>
                                    <th >Applicant</th>
                                    <th >Property</th>
                                    <th >Date</th>
                                    <th >Status</th>
                                    <th >Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
