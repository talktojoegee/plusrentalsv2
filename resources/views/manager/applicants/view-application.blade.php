@extends('layouts.master-layout')
@section('title')
    Application Details for {{$applicant->first_name ?? ''}} {{$applicant->surname ?? ''}}
@endsection

@section('current-page')
    Application Details for {{$applicant->first_name ?? ''}} {{$applicant->surname ?? ''}}
@endsection
@section('current-page-brief')
   Details of <strong>{{$applicant->first_name}}'s</strong> application.
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('prospect-applications')}}"><i class="icofont icofont-tags"></i>Manage Applications</a>
        <a class="btn btn-primary btn-mini" href="{{route('new-application')}}"><i class="icofont icofont-tasks"></i>Add New Application</a>
        <a class="btn btn-danger btn-mini" href=""><i class="icofont icofont-megaphone"></i>Reports</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\slick-carousel\css\slick.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\slick-carousel\css\slick-theme.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\owl.carousel\css\owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\owl.carousel\css\owl.theme.default.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                     <div class="btn-group">
                         <a class="btn btn-danger btn-mini" href="{{route('new-application')}}"><i class="ti-check"></i>Decline</a>
                         <a class="btn btn-success btn-mini" href="{{route('approve-prospect-application',
['slug'=>$applicant->getProperty->slug,
'applicant'=>$applicant->url]) }}"><i class="ti-check"></i>Approve</a>

                    </div>
                    <div class="col-lg-12 col-xl-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Applicant</a>
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
                                                    <div class="general-info">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-6">
                                                                <div class="table-responsive">
                                                                    <table class="table m-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">Full Name</th>
                                                                                <td>{{$applicant->first_name ?? ''}} {{$applicant->surname ?? ''}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Gender</th>
                                                                                <td>{{$applicant->gender == 1 ? 'Male' : 'Female'}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Residency Date</th>
                                                                                <td>{{!is_null($applicant->residency_date) ? date('d-m-Y', strtotime($applicant->residency_date)) : '-' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Marital Status</th>
                                                                                <td>{{$applicant->marital_status == 1 ? 'Male' : 'Female'}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Address</th>
                                                                                 <td>{{$applicant->address ?? '-'}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-xl-6">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">Email</th>
                                                                                <td><a href="mailto:{{$applicant->email ?? ''}}"><span class="__cf_email__" >{{$applicant->email ?? ''}}</span></a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Mobile Number</th>
                                                                                <td>{{$applicant->mobile_no ?? ''}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Means of Identification</th>
                                                                                <td>@xyz</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Attachment</th>
                                                                                <td>demo.skype</td>
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
                                        <div class="edit-info" style="display: none;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="general-info">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="Full Name">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-radio">
                                                                                    <div class="group-add-on">
                                                                                        <div class="radio radiofill radio-inline">
                                                                                            <label>
                                                                                                <input type="radio" name="radio" checked=""><i class="helper"></i> Male
                                                                                            </label>
                                                                                                                </div>
                                                                                                                <div class="radio radiofill radio-inline">
                                                                                                                    <label>
                                                                                                <input type="radio" name="radio"><i class="helper"></i> Female
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input id="dropper-default" class="form-control" type="text" placeholder="Select Your Birth Date">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <select id="hello-single" class="form-control">
                                                                                    <option value="">---- Marital Status ----</option>
                                                                                    <option value="married">Married</option>
                                                                                    <option value="unmarried">Unmarried</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="Address">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!-- end of table col-lg-6 -->
                                                            <div class="col-lg-6">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="Mobile Number">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-social-twitter"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="Twitter Id">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-social-skype"></i></span>
                                                                                    <input type="email" class="form-control" placeholder="Skype Id">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon"><i class="icofont icofont-earth"></i></span>
                                                                                    <input type="text" class="form-control" placeholder="website">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!-- end of table col-lg-6 -->
                                                        </div>
                                                        <!-- end of row -->
                                                        <div class="text-center">
                                                            <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                        </div>
                                                    </div>
                                                    <!-- end of edit info -->
                                                </div>
                                                <!-- end of col-lg-12 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of edit-info -->
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
                                                                        @foreach($applicant->getProperty->getInteriorGallery as $interior)
                                                                            <div class="port_big_img">
                                                                                <img class="img img-fluid" src="\assets\images\property\interior\{{$interior->directory}}" alt="Interior">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 product-right">
                                                                    <div id="small_banner">
                                                                        @foreach($applicant->getProperty->getInteriorGallery as $interior)
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
                                                                            @foreach($applicant->getProperty->getExteriorGallery as $exterior)
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
                                                                    <div class="col-lg-12">
                                                                    <span class="txt-muted d-inline-block">Property Type: <a href="javascript:void(0);">
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
                                                                        </a>
                                                                    </span>
                                                                        <span class="f-right">Availablity : <a href="#!"> Vacant </a> </span>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <h5 class="pro-desc">  {{$applicant->getProperty->property_name ?? ''}}</h5>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-2">
                                                                    <span class="txt-muted"> <strong>Location: </strong> {{$applicant->getProperty->getLocation->location_name ?? ''}} <span
                                                                            for="" class=" text-danger">></span> {{$applicant->getProperty->getArea->area_name ?? ''}} </span>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <span class="text-primary"><strong>Rental Price: </strong>{{'₦'.number_format($applicant->getProperty->rental_price,2) }}</span> |
                                                                        <span class="text-muted"> <strong>Security Deposit: </strong> {{'₦'.number_format($applicant->getProperty->security_deposit,2) }}</span> |
                                                                        <span class="text-danger"> <strong>Late Fee: </strong> {{'₦'.number_format($applicant->getProperty->late_fee,2) }}</span>
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

@endsection

@section('extra-scripts')
    <script type="text/javascript" src="\bower_components\slick-carousel\js\slick.min.js"></script>
    <!-- product detail js -->
    <script type="text/javascript" src="\assets\pages\product-detail\product-detail.js"></script>

    <script type="text/javascript" src="\bower_components\owl.carousel\js\owl.carousel.min.js"></script>
    <script type="text/javascript" src="\assets\js\owl-custom.js"></script>
@endsection
