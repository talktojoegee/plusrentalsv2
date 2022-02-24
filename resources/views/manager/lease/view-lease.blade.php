@extends('layouts.master-layout')
@section('title')
    Lease Detail
@endsection

@section('current-page')
     Details
@endsection
@section('current-page-brief')
   Details
@endsection

@section('event-area')
    @include('manager.lease.partials._menu')
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
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Tenant</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#owner" role="tab">Rental Owner</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Property</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <div class="card-block">
                                    <div class="view-info">
                                        <div class="row">
                                            <div class="col-lg-12">
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
                                </div>
                            </div>
                            <div class="tab-pane" id="owner" role="tabpanel">
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
                            <div class="tab-pane" id="profile3" role="tabpanel">
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
                                                                    @foreach($lease->getProperty->getInteriorGallery as $interior)
                                                                        <div class="port_big_img">
                                                                            <img class="img img-fluid" src="\assets\images\property\interior\{{$interior->directory}}" alt="Interior">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 product-right">
                                                                <div id="small_banner">
                                                                    @foreach($lease->getProperty->getInteriorGallery as $interior)
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
                                                                        @foreach($lease->getProperty->getExteriorGallery as $exterior)
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
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="col-lg-12">
                                                                    <span class="txt-muted d-inline-block">Property Type: <a href="javascript:void(0);">
                                                                        @switch($lease->getProperty->property_type)
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
                                                                    <span class="f-right">Status : <a href="#!"> Renting.. </a> </span>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <h5 class="pro-desc">  {{$lease->getProperty->property_name ?? ''}}</h5>
                                                                </div>
                                                                <div class="col-lg-12 mb-2">
                                                                    <span class="txt-muted"> <strong>Location: </strong> {{$lease->getProperty->getLocation->location_name ?? ''}} <span
                                                                            for="" class=" text-danger">></span> {{$lease->getProperty->getArea->area_name ?? ''}} </span>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <span class="text-primary"><strong>Rental Price: </strong>{{'₦'.number_format($lease->getProperty->rental_price,2) }}</span> |
                                                                    <span class="text-muted"> <strong>Security Deposit: </strong> {{'₦'.number_format($lease->getProperty->security_deposit,2) }}</span> |
                                                                    <span class="text-danger"> <strong>Late Fee: </strong> {{'₦'.number_format($lease->getProperty->late_fee,2) }}</span>
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
                                                                                <td scope="row">Bedrooms</td>
                                                                                <td>{!!  $features->bedrooms == 1 ? "<i class='ti-check text-success'></i>" : "<i class='ti-close text-danger'></i>" !!}</td>
                                                                                <td> {{$features->bedrooms_comment ?? ''}} </td>
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
                    <div class="sub-title">Lease Renewals</div>
                    <div class="table-responsive">
                        <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc">S/No.</th>
                                <th class="sorting_asc">Tenant</th>
                                <th class="sorting"  >Start Date</th>
                                <th class="sorting"  >End Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach($lease->getLeaseRenewals as $lease)
                                <tr role="row" class="odd">
                                    <td>{{$serial++}}</td>
                                    <td>{{$lease->getTenant->getApplicant->first_name ?? ''}} {{$lease->getTenant->getApplicant->surname ?? ''}}</td>
                                    <td class="text-success">{{date('d-M,Y', strtotime($lease->start_date))}}</td>
                                    <td class="text-danger">{{date('d-M,Y', strtotime($lease->end_date))}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th >S/No.</th>
                                <th >Tenant</th>
                                <th >Start Date</th>
                                <th >End Date</th>
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
    <script type="text/javascript" src="\bower_components\slick-carousel\js\slick.min.js"></script>
    <script type="text/javascript" src="\assets\pages\product-detail\product-detail.js"></script>
    <script type="text/javascript" src="\bower_components\owl.carousel\js\owl.carousel.min.js"></script>
    <script type="text/javascript" src="\assets\js\owl-custom.js"></script>
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js">
@endsection
