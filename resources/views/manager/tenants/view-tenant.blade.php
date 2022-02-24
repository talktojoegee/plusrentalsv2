@extends('layouts.master-layout')
@section('title')
    Tenant - {{$tenant->getApplicant->title ?? ''}} {{$tenant->getApplicant->first_name ?? ''}}
@endsection

@section('current-page')
    Tenant - {{$tenant->getApplicant->title ?? ''}} {{$tenant->getApplicant->first_name ?? ''}}
@endsection
@section('current-page-brief')
    Tenant - {{$tenant->getApplicant->title ?? ''}} {{$tenant->getApplicant->first_name ?? ''}}
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('manage-tenants')}}"><i class="icofont icofont-tags"></i>Manage Tenants</a>
        <a class="btn btn-primary btn-mini" href="{{route('add-lease-application')}}"><i class="icofont icofont-tasks"></i>Add New Lease</a>
    </div>
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
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    <div class="col-lg-12 col-xl-12">
                        <div class="dropdown-primary dropdown open">
                            <button class="btn btn-mini btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item waves-light waves-effect" href="#">Renew Rent</a>
                                <a class="dropdown-item waves-light waves-effect" href="#">Update Lease Status</a>
                            </div>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tenant" role="tab">Tenant</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#property" role="tab">Property</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#home3" role="tab">Rental Owner</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane " id="home3" role="tabpanel">
                                <div class="card-block">
                                    <div class="view-info">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="general-info">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-xl-6">
                                                            <div class="table-responsive">
                                                                <table class="table m-0">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th scope="row">Ownership Type</th>
                                                                        <td><label for="" class="label label-info">{{$tenant->getProperty->getRentalOwner->ownership_type == 1 ? 'Individual' : 'Company/Trust'}}</label> </td>
                                                                    </tr>
                                                                    @if($tenant->getProperty->getRentalOwner->ownership_type == 1)
                                                                        <tr>
                                                                            <th scope="row">Full Name</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->title ?? ''}} {{$tenant->getProperty->getRentalOwner->first_name ?? ''}} {{$tenant->getProperty->getRentalOwner->surname ?? ''}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Gender</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->gender == 1 ? 'Male' : 'Female'}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Email</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->email ?? ''}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Mobile No.</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->mobile_no ?? ''}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Address</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->address ?? ''}}</td>
                                                                        </tr>

                                                                    @endif
                                                                    @if($tenant->getProperty->getRentalOwner->ownership_type == 2)
                                                                        <tr>
                                                                            <th scope="row">Company Name</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->company_name ?? ''}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Official Email</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->email ?? ''}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Official Phone No.</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->mobile_no ?? ''}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Office Address</th>
                                                                            <td>{{$tenant->getProperty->getRentalOwner->address ?? ''}}</td>
                                                                        </tr>
                                                                    @endif

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
                            <div class="tab-pane active" id="tenant" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Product detail page start -->
                                        <div class="card product-detail-page">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-lg-6 col-xl-6">
                                                        <div class="sub-title">Tenant Details</div>
                                                        <div class="table-responsive">
                                                            <table class="table m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Full Name</th>
                                                                    <td>{{$tenant->getApplicant->title ?? ''}} {{$tenant->getApplicant->first_name ?? ''}} {{$tenant->getApplicant->surname ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Gender</th>
                                                                    <td>{{$tenant->getApplicant->gender == 1 ? 'Male' : 'Female'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Marital Status</th>
                                                                    <td>
                                                                        @switch($tenant->getApplicant->gender)
                                                                            @case(1)
                                                                            Single
                                                                            @break
                                                                            @case(2)
                                                                            Divorce
                                                                            @break
                                                                            @case(3)
                                                                            Separate
                                                                            @break
                                                                            @case(4)
                                                                            Widowed
                                                                            @break
                                                                            @case(5)
                                                                            Married
                                                                            @break
                                                                            @default
                                                                            '-'
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td>{{$tenant->getApplicant->email ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Mobile No.</th>
                                                                    <td>{{$tenant->getApplicant->mobile_no ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Address</th>
                                                                    <td>{{$tenant->getApplicant->address ?? ''}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Residency Date</th>
                                                                    <td>{{ date('d M, Y', strtotime($tenant->getApplicant->residency_date)) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Date Applied</th>
                                                                    <td>{{ date('d M, Y', strtotime($tenant->getApplicant->created_at)) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Status</th>
                                                                    <td>
                                                                        @switch($tenant->status)
                                                                            @case(1)
                                                                            <label for="" class="badge badge-success">Renting</label>
                                                                            @break
                                                                            @case(2)
                                                                            <label for="" class="badge badge-warning">Expired</label>
                                                                            @break
                                                                            @case(3)
                                                                            <label for="" class="badge badge-danger">Evicted</label>
                                                                            @break
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Start Date</th>
                                                                    <td><label for="" class="label label-success">{{ date('d M, Y', strtotime($tenant->start_date)) }}</label> </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">End Date</th>
                                                                    <td><label for="" class="label label-danger">{{ date('d M, Y', strtotime($tenant->end_date)) }}</label> </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-xl-6">
                                                        <div class="sub-title">Occupant Details</div>
                                                        <div class="table-responsive">
                                                            <table class="table m-0">
                                                                <thead>
                                                                    <th>#</th>
                                                                    <th>Full Name</th>
                                                                    <th>Relationship</th>
                                                                    <th>Mobile No.</th>
                                                                    <th>Action</th>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product detail page end -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="property" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Product detail page start -->
                                        <div class="card product-detail-page">
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-lg-5 col-xs-12">
                                                        <h4 class="sub-title">Internal View</h4>
                                                        <div class="port_details_all_img row">
                                                            <div class="col-lg-12 m-b-15">
                                                                <div id="big_banner">
                                                                    @foreach($tenant->getProperty->getInteriorGallery as $interior)
                                                                        <div class="port_big_img">
                                                                            <img class="img img-fluid" src="\assets\images\property\interior\{{$interior->directory}}" alt="Interior">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 product-right">
                                                                <div id="small_banner">
                                                                    @foreach($tenant->getProperty->getInteriorGallery as $interior)
                                                                        <div class="port_big_img">
                                                                            <img class="img img-fluid" src="\assets\images\property\interior\{{$interior->directory}}" alt="Interior">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-lg-12 col-xs-12">
                                                                <h4 class="sub-title">External View</h4>
                                                                <div class="card-block">
                                                                    <div class="owl-carousel carousel-dot owl-theme">
                                                                        @foreach($tenant->getProperty->getExteriorGallery as $exterior)
                                                                            <div class="item">
                                                                                <img class="d-block img-fluid" src="\assets\images\property\exterior\{{$exterior->directory}}" alt="Exterior">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                                                        <div class="row">
                                                            <div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <h5 class="sub-title">  {{$tenant->getProperty->property_name ?? ''}}</h5>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><span class="label label-info">Property Type:</span> <a href="javascript:void(0);">
                                                                        @switch($tenant->getProperty->property_type)
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
                                                                    <span class="txt-muted"> <strong class="label label-info">Location: </strong> {{$tenant->getProperty->getLocation->location_name ?? ''}} <span
                                                                            for="" class=" text-danger">></span> {{$tenant->getProperty->getArea->area_name ?? ''}} </span>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class="label label-info mb-2">Frequency: </strong>{{ $tenant->getProperty->getLeaseFrequency->frequency ?? '' }}</span>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class="label label-info mb-2">Listing Type: </strong>{{ $tenant->getProperty->listing_type == 1 ? 'For rent' : 'For sale' }}</span>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class=""><strong class="label label-info">Rental Price: </strong>{{'₦'.number_format($tenant->getProperty->rental_price,2) }}</span>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-12 mb-2 col-lg-12">
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
                                                                                <td>{!!  $tenant->getPropertyFeatures->bedrooms == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->bedrooms_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Bathrooms</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->bathrooms == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->bathrooms_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Study room</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->study_room == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->study_room_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Dinning room</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->dinning_room == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->dinning_room_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Carports</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->carports == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->carports_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Kitchens</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->kitchens == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->kitchens_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Garages</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->garages == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->garages_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Flooring</td>
                                                                                <td>{!! $tenant->getPropertyFeatures->flooring == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->flooring_type ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Laundry</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->laundry == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->laundry_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Balcony</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->balcony == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->balcony_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Pool</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->pool == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->pool_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Garden</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->garden == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->garden_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Views</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->views == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->views_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Security</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->security == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->security_comment ?? ''}} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">Store room</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->store_room == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->store_room_comment ?? ''}} </td>
                                                                            </tr><tr>
                                                                                <td scope="row">Lounges</td>
                                                                                <td>{!!  $tenant->getPropertyFeatures->lounges == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$tenant->getPropertyFeatures->lounges_comment ?? ''}} </td>
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
                                        <!-- Product detail page end -->
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
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Lease Records</h5>
                    <div class="table-responsive">

                        <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                            <thead>
                            <tr role="row" class="text-uppercase">
                                <th class="sorting"  >S/No.</th>
                                <th class="sorting" >Date</th>
                                <th class="sorting"  >Property Name</th>
                                <th class="sorting"  >Start Date</th>
                                <th class="sorting_asc" >End Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $l = 1;
                            @endphp
                            @foreach($leaserenewals as $renew)
                                <tr>
                                    <td>{{$l++}}</td>
                                    <td>{{date('d M, Y', strtotime($renew->created_at))}}</td>
                                    <td> <a href="{{route('view-property', $renew->getProperty->slug)}}" class="text-primary">{{strlen($renew->getProperty->property_name) > 45 ? substr($renew->getProperty->property_name,0,45).'...' : $renew->getProperty->property_name }}</a>
                                    </td>
                                    <td class="text-success ">{{date('d M, Y', strtotime($renew->start_date))}}</td>
                                    <td class="text-danger ">{{date('d M, Y', strtotime($renew->end_date))}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr class="text-uppercase">
                                <th>S/No.</th>
                                <th>Date</th>
                                <th>Property Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script type="text/javascript" src="\bower_components\slick-carousel\js\slick.min.js"></script>
    <!-- product detail js -->
    <script type="text/javascript" src="\assets\pages\product-detail\product-detail.js"></script>

    <script type="text/javascript" src="\bower_components\owl.carousel\js\owl.carousel.min.js"></script>
    <script type="text/javascript" src="\assets\js\owl-custom.js"></script>

    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
