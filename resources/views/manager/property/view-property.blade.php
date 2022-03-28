@extends('layouts.master-layout')
@section('title')
    Property > {{$property->property_name ?? ''}}
@endsection

@section('current-page')

@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.property.partials._menu')
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\slick-carousel\css\slick.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\slick-carousel\css\slick-theme.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\owl.carousel\css\owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\owl.carousel\css\owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-xl-9 col-lg-12 ">
            <div class="card">
                <div class="card-block">
                    <div class="col-lg-12 col-xl-12">
                        <div class="sub-title">{{$property->property_name}}</div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#profile3" role="tab">Property</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#inspection" role="tab">Inspection</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="profile3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card product-detail-page">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-lg-5 col-xs-12">
                                                        <h4 class="sub-title">Internal View</h4>
                                                        <div class="port_details_all_img row">
                                                            <div class="col-lg-12 m-b-15">
                                                                <div id="big_banner">
                                                                    @foreach($property->getInteriorGallery as $interior)
                                                                        <div class="port_big_img">
                                                                            <img class="img img-fluid" src="\assets\images\property\interior\{{$interior->directory}}" alt="Interior">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 product-right">
                                                                <div id="small_banner">
                                                                    @foreach($property->getInteriorGallery as $interior)
                                                                        <div class="port_big_img">
                                                                            <img class="img img-fluid" src="\assets\images\property\interior\{{$interior->directory}}" alt="Interior">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                                                        <div class="row">
                                                            <div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <h5 class="sub-title">  {{$property->property_name ?? ''}}</h5>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class=" mb-2">Property Type:</strong> <a href="javascript:void(0);">
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
                                                                        </a>
                                                                    </span>
                                                                </div>

                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""> <strong class=" mb-2">Location: </strong> {{$property->getLocation->location_name ?? ''}} <span
                                                                            for="" class=" text-danger">|</span> {{$property->getArea->area_name ?? ''}} </span>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class=" mb-2">Rental Price: </strong>{{'₦'.number_format($property->rental_price,2) }}</span>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class=" mb-2">Frequency: </strong>{{ $property->getLeaseFrequency->frequency ?? '' }}</span>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class=" mb-2">Status: </strong>
                                                                         @switch($property->status)
                                                                            @case(0)
                                                                            <label for="" class="text-info">Vacant/Available</label>
                                                                            @break
                                                                            @case(1)
                                                                            <label for="" class="text-success">Occupied/Leased</label>
                                                                            @break
                                                                            @case(2)
                                                                            <label for="" class="text-danger">Sold</label>
                                                                            @break
                                                                            @case(3)
                                                                            <label for="" class="text-warning text-white">Undecided</label>
                                                                            @break
                                                                        @endswitch
                                                                    </span>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class=" mb-2">Listing Type: </strong>{{ $property->listing_type == 1 ? 'For Rent' : 'For Sale'  }}</span>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12">
                                                                    <h4 class="sub-title">Property Features</h4>
                                                                    <div class="table-responsive">
                                                                            <table class="table m-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Feature</th>
                                                                                    <th>Status</th>
                                                                                    <th>Value</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td scope="row">Bedrooms</td>
                                                                                        <td>{!!  $features->bedrooms == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->bedrooms_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Bathrooms</td>
                                                                                        <td>{!!  $features->bathrooms == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->bathrooms_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Study room</td>
                                                                                        <td>{!!  $features->study_room == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->study_room_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Dinning room</td>
                                                                                        <td>{!!  $features->dinning_room == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->dinning_room_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Carports</td>
                                                                                        <td>{!!  $features->carports == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->carports_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Kitchens</td>
                                                                                        <td>{!!  $features->kitchens == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->kitchens_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Garages</td>
                                                                                        <td>{!!  $features->garages == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->garages_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Flooring</td>
                                                                                        <td>{!!  $features->flooring == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->flooring_type ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Laundry</td>
                                                                                        <td>{!!  $features->laundry == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->laundry_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Balcony</td>
                                                                                        <td>{!!  $features->balcony == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->balcony_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Pool</td>
                                                                                        <td>{!!  $features->pool == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->pool_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Garden</td>
                                                                                        <td>{!!  $features->garden == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->garden_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Views</td>
                                                                                        <td>{!!  $features->views == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->views_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Security</td>
                                                                                        <td>{!!  $features->security == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->security_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td scope="row">Store room</td>
                                                                                        <td>{!!  $features->store_room == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->store_room_comment ?? ''}} </td>
                                                                                    </tr><tr>
                                                                                        <td scope="row">Lounges</td>
                                                                                        <td>{!!  $features->lounges == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                        <td> {{$features->lounges_comment ?? ''}} </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h5 class="sub-title">Property Description</h5>
                                                        {!! $property->description ?? '' !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="inspection" role="tabpanel">
                                <div class="card-block">
                                    <h5 class="sub-title">Property Inspections</h5>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="card">
                                                <div class="card-block">
                                                    <div class="table-responsive">
                                                        <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                                            <thead>
                                                            <tr role="row">
                                                                <th class="sorting_asc">S/No.</th>
                                                                <th class="sorting_asc">Full Name</th>
                                                                <th class="sorting"  >Email</th>
                                                                <th class="sorting"  >Mobile No.</th>
                                                                <th class="sorting"  >Schedule</th>
                                                                <th class="sorting"  >Status</th>
                                                                <th class="sorting"  >Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php
                                                                $s = 1;
                                                            @endphp
                                                            @foreach($inspections as $inspection)

                                                                <tr>
                                                                    <td>{{$s++}}</td>
                                                                    <td>{{$inspection->full_name ?? ''}}</td>
                                                                    <td>{{$inspection->email ?? ''}}</td>
                                                                    <td>{{$inspection->mobile_no ?? ''}}</td>
                                                                    <td>{{date('d M, Y h:ia', strtotime($inspection->schedule_date)) ?? ''}}</td>
                                                                    <td>
                                                                        @switch($inspection->status)
                                                                            @case(0)
                                                                            <label for="" class="label label-warning">Not Inspected</label>
                                                                            @break
                                                                            @case(1)
                                                                            <label for="" class="label label-success">Inspected</label>
                                                                            @break
                                                                            @case(3)
                                                                            <label for="" class="label label-danger">Declined</label>
                                                                            @break
                                                                        @endswitch
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#inspectionModal_{{$inspection->id}}" class="btn btn-mini btn-info">View</a>
                                                                        <div class="modal fade modal-flex" id="inspectionModal_{{$inspection->id}}" tabindex="-1" role="dialog">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-body">
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                        <ul class="nav nav-tabs" role="tablist">
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link active" data-toggle="tab" href="#tab-home" role="tab">Details</a>
                                                                                            </li>
                                                                                            @if($inspection->status == 0)
                                                                                                <li class="nav-item">
                                                                                                    <a class="nav-link" data-toggle="tab" href="#tab-profile" role="tab">Assignment</a>
                                                                                                </li>
                                                                                                @if(Auth::user()->id == $inspection->attended_by)
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link" data-toggle="tab" href="#tab-messages" role="tab">Status</a>
                                                                                                    </li>
                                                                                                @endif
                                                                                            @endif
                                                                                        </ul>
                                                                                        <div class="tab-content modal-body">
                                                                                            <div class="tab-pane active" id="tab-home" role="tabpanel">
                                                                                                <h6>Inspection Request Details <sup>
                                                                                                        @switch($inspection->status)
                                                                                                            @case(0)
                                                                                                            <label for="" class="label label-warning">Not Inspected</label>
                                                                                                            @break
                                                                                                            @case(1)
                                                                                                            <label for="" class="label label-success">Inspected</label>
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <label for="" class="label label-danger">Declined</label>
                                                                                                            @break
                                                                                                        @endswitch
                                                                                                    </sup> </h6>
                                                                                                <form action="">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-10">
                                                                                                            <div class="form-group">
                                                                                                                <label
                                                                                                                    for="">Full Name</label>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="form-control" value="{{$inspection->full_name}}" readonly>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-10">
                                                                                                            <div class="form-group">
                                                                                                                <label
                                                                                                                    for="">Email Address</label>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="form-control" value="{{$inspection->email}}" readonly>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-10">
                                                                                                            <div class="form-group">
                                                                                                                <label
                                                                                                                    for="">Mobile No.</label>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="form-control" value="{{$inspection->mobile_no}}" readonly>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-10">
                                                                                                            <div class="form-group">
                                                                                                                <label
                                                                                                                    for="">Schedule</label>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="form-control" value="{{date('d M, Y h:ia', strtotime($inspection->schedule_date)) ?? ''}}" readonly>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-10">
                                                                                                            <div class="form-group">
                                                                                                                <label>Message</label>
                                                                                                                <textarea
                                                                                                                    name="message"
                                                                                                                    id=""
                                                                                                                    cols="30"
                                                                                                                    rows="10" readonly style="resize: none;"
                                                                                                                    class="form-control">{{$inspection->message ?? '-'}}</textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-10">
                                                                                                            <h5 class="sub-title">Outcome</h5>
                                                                                                            <div class="form-group">
                                                                                                                <label
                                                                                                                    for="">Assigned To</label>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="form-control" value="{{$inspection->getAttendedBy->first_name ?? ''}} {{$inspection->getAttendedBy->surname ?? ''}}" readonly>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-10">
                                                                                                            <div class="form-group">
                                                                                                                <label
                                                                                                                    for="">Date Inspected</label>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="form-control" value="{{!is_null($inspection->date_attended) ? date('d M, Y h:ia', strtotime($inspection->date_attended)) : '-'}}" readonly>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-10">
                                                                                                            <div class="form-group">
                                                                                                                <label>Comment</label>
                                                                                                                <textarea
                                                                                                                    name="comment"
                                                                                                                    id=""
                                                                                                                    cols="10"
                                                                                                                    rows="5" readonly style="resize: none;"
                                                                                                                    class="form-control ">{{$inspection->comment ?? '-'}}</textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                            @if($inspection->status == 0)
                                                                                                <div class="tab-pane" id="tab-profile" role="tabpanel">
                                                                                                    <h6 class="mb-3">Inspection Assignment</h6>
                                                                                                    <form action="{{route('property-inspection')}}" method="post">
                                                                                                        @csrf
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-10">
                                                                                                                <div class="form-group">
                                                                                                                    <label
                                                                                                                        for="">Assign To</label>
                                                                                                                    <select
                                                                                                                        name="assign_to"
                                                                                                                        id=""
                                                                                                                        class="form-control">
                                                                                                                        <option
                                                                                                                            disabled selected>--Select user--</option>
                                                                                                                        @foreach($users as $user)
                                                                                                                            <option
                                                                                                                                value="{{$user->id}}">{{$user->first_name ?? '' }} {{$user->surname ?? ''}}</option>
                                                                                                                        @endforeach
                                                                                                                    </select>
                                                                                                                    @error('assign_to') <i class="text-danger">{{$message}}</i>@enderror
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-10">
                                                                                                                <div class="form-group">
                                                                                                                    <label
                                                                                                                        for="">Date & Time</label>
                                                                                                                    <input
                                                                                                                        type="datetime-local"
                                                                                                                        class="form-control" name="schedule_date">
                                                                                                                    @error('schedule_date') <i class="text-danger">{{$message}}</i>@enderror
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 d-flex justify-content-center">
                                                                                                                <input type="hidden" name="inspectionId" value="{{$inspection->id}}">
                                                                                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                                @if(Auth::user()->id == $inspection->attended_by)
                                                                                                    <div class="tab-pane" id="tab-messages" role="tabpanel">
                                                                                                        <h6>Update Status</h6>
                                                                                                        <form action="{{route('update-property-inspection-status')}}" method="post">
                                                                                                            @csrf
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-10">
                                                                                                                    <div class="form-group">
                                                                                                                        <label for="">Status</label>
                                                                                                                        <select name="status" id=""
                                                                                                                                class="form-control">
                                                                                                                            <option
                                                                                                                                disabled selected>--Select status--</option>
                                                                                                                            <option
                                                                                                                                value="1">Inspected</option>
                                                                                                                            <option value="2">Discard</option>
                                                                                                                        </select>
                                                                                                                        @error('status') <i class="text-danger">{{$message}}</i>@enderror
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-10">
                                                                                                                    <div class="form-group">
                                                                                                                        <label for="">Comment</label>
                                                                                                                        <textarea style="resize: none" name="comment"
                                                                                                                                  id="comment" cols="30"
                                                                                                                                  rows="10"
                                                                                                                                  class="form-control">{{old('comment')}}</textarea>
                                                                                                                        @error('comment') <i class="text-danger">{{$message}}</i>@enderror
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 d-flex justify-content-center">
                                                                                                                    <input type="hidden" name="inspection_id" value="{{$inspection->id}}">
                                                                                                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                @endif
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
                                                                <th class="">S/No.</th>
                                                                <th class="">Full Name</th>
                                                                <th class=""  >Email</th>
                                                                <th class=""  >Mobile No.</th>
                                                                <th class=""  >Schedule</th>
                                                                <th class=""  >Status</th>
                                                                <th class=""  >Action</th>
                                                            </tr>
                                                            </tfoot>
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
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="sub-title">Lease Records</h5>
                            <div class="table-responsive">
                                <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">S/No.</th>
                                        <th class="sorting_asc">Tenant</th>
                                        <th class="sorting"  >Start Date</th>
                                        <th class="sorting"  >End Date</th>
                                        <th class="sorting"  >Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach($leases as $applicant)
                                        <tr role="row" class="odd">
                                            <td>{{$serial++}}</td>
                                            <td>
                                                <a target="_blank" href="{{route('view-tenant', $applicant->getTenant->slug)}}">
                                                    {{$applicant->getTenant->getApplicant->first_name ?? ''}} {{$applicant->getTenant->getApplicant->surname ?? ''}}
                                                </a>
                                            </td>
                                            <td><label for="" class="label label-info">{{date('d M,Y', strtotime($applicant->start_date))}}</label></td>
                                            <td><label for="" class="label label-danger">{{date('d M,Y', strtotime($applicant->end_date))}}</label></td>
                                            <td>
                                                {!! strtotime($applicant->end_date) > strtotime(now()) ? "<span class='text-success'>Running</span>" : "<span class='text-danger'>Expired</span>" !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th >S/No.</th>
                                        <th >Tenant</th>
                                        <th >Start Date</th>
                                        <th >End Date</th>
                                        <th >Status</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-12">
                <div class="card card-border-primary">
                    <div class="card-header">
                        <h5 class="card-header-text text-uppercase">
                            <i class="icofont icofont-ui-note m-r-10"></i> Property Details
                        </h5>
                    </div>
                    <div class="card-block task-details">
                        <div class="table-responsive">
                            <table class="table table-border table-xs">

                                <tbody>
                                <tr>
                                    <td>
                                        <i class="icofont icofont-id-card"></i> Created:
                                    </td>
                                    <td class="text-right">{{!is_null($property->created_at) ? date('d M, Y', strtotime($property->created_at)) : '-'}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="ti-user"></i> Tenant:
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="javascript:void(0);">
                                                {{$property->getAllocatedTo->getApplicant->first_name ?? ''}}  {{$property->getAllocatedTo->getApplicant->surname ?? ''}}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="icofont icofont-ui-love-add"></i> Added by:
                                    </td>
                                    <td class="text-right">
                                        <a href="javascript:void(0);">{{$property->getAddedBy->first_name ?? ''}} {{$property->getAddedBy->surname ?? ''}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="icofont icofont-sand-clock"></i> Status:
                                    </td>
                                    <td class="text-right">
                                        @switch($property->status)
                                            @case(0)
                                            Vacant
                                            @break
                                            @case(1)
                                            Occupied
                                            @break
                                            @case(2)
                                            Sold
                                            @break
                                            @case(3)
                                            Undecided
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-border-danger">
                    <div class="card-header">
                        <h5 class="card-header-text text-uppercase">
                            <i class="icofont icofont-wallet m-r-10"></i> Property Account
                        </h5>
                    </div>
                    <div class="card-block task-details">
                        <div class="table-responsive">
                            <table class="table table-border table-xs">

                                <tbody>
                                <tr>
                                    <td>
                                        <i class="icofont icofont-money-bag"></i> <a href="javascript:void(0);"> Receipts:</a>
                                    </td>
                                    <td class="text-right"> <label for="" class="badge badge-danger">{{number_format($property->getPropertyReceipts->count())}}</label> </td>
                                </tr>
                                <tr>
                                    <td>
                                        Inflow
                                    </td>
                                    <td class="text-right">{{'₦'.number_format($property->getPropertyInvoices->sum('paid_amount'),2)}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        Unpaid Invoices
                                    </td>
                                    <td class="text-right">
                                        {{'₦'.number_format(($property->getPropertyInvoices->sum('total')) - ($property->getPropertyInvoices->sum('paid_amount')), 2)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="icofont icofont-ticket"></i> <a href="javascript:void(0);"> Payments:</a>
                                    </td>
                                    <td class="text-right"> <label for="" class="badge badge-danger">828</label> </td>
                                </tr>
                                <tr>
                                    <td>
                                        Outflow
                                    </td>
                                    <td class="text-right">
                                        182
                                    </td>
                                </tr>
                                <tr>
                                    <td>Unpaid Bills</td>
                                    <td class="text-right">
                                        772
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-light">View Details</a>
                    </div>
                </div>
        </div>


    </div>

@endsection

@section('extra-scripts')
    <script type="text/javascript" src="\bower_components\slick-carousel\js\slick.min.js"></script>
    <script type="text/javascript" src="\assets\pages\product-detail\product-detail.js"></script>
    <script type="text/javascript" src="\bower_components\owl.carousel\js\owl.carousel.min.js"></script>
    <script type="text/javascript" src="\assets\js\owl-custom.js"></script>
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
