@extends('layouts.tenant-layout')

@section('title')
    Property Details
@endsection

@section('meta-title')
    Property Details
@endsection

@section('meta-keywords')
    Property Details
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/rightbar-details.css">
@endsection
@section('main-content')
    <section class="ad-details-part">
        <div class="container">
            <div class="row">
                @if(session()->has('success'))
                    <div class="col-md-12 mt-4">
                        <div class="alert alert-success">
                            {!! session()->get('success') !!}
                        </div>
                    </div>
                @endif
                @if($errors->any())
                    <div class="col-md-12 mt-4">
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="col-lg-8">
                    <div class="ad-details-card">
                        <div class="ad-details-breadcrumb">
                            <ol class="breadcrumb">
                                <li>
                                    <span class="flat-badge sale">
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
                                    </span>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0);">{{$property->getLocation->location_name ?? ''}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{$property->getArea->area_name ?? ''}}</li>
                            </ol>
                        </div>
                        <div class="ad-details-heading">
                            <h2>
                                <a href="{{url()->current()}}">{{ucfirst(strtolower($property->property_name))}}</a>
                            </h2>
                        </div>
                        <div class="ad-details-title">
                            <h5>Interior View</h5>
                        </div>
                        <div class="ad-details-slider slider-arrow">
                             @foreach($property->getInteriorGallery as $interior)
                                <div>
                                    <img src="/assets/images/property/interior/{{$interior->directory ?? ''}}" alt="{{$property->property_name ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="ad-thumb-slider">
                            @foreach ($property->getInteriorGallery as $image)
                                <div>
                                    <img src="/assets/images/property/interior/{{$image->directory ?? ''}}" alt="{{$property->property_name ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="ad-details-title">
                            <h5>External View</h5>
                        </div>
                        <div class="ad-details-slider slider-arrow">
                            @foreach($property->getExteriorGallery as $exterior)
                                <div>
                                    <img src="/assets/images/property/exterior/{{$exterior->directory ?? ''}}" alt="{{$property->property_name ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="ad-thumb-slider">
                            @foreach ($property->getExteriorGallery as $ex_image)
                                <div>
                                    <img src="/assets/images/property/exterior/{{$ex_image->directory ?? ''}}" alt="{{$property->property_name ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>Schedule Property Inspection</h5>
                        </div>
                        <div class="ad-details-specific">
                            <form action="{{route('schedule-property-inspection')}}" class="ad-review-form" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="">Full Name</label>
                                        <input type="text" value="{{old('full_name')}}" placeholder="Full Name" name="full_name" class="form-control">
                                        @error('full_name')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="">Email Address</label>
                                        <input type="text" value="{{old('email_address')}}" placeholder="Email Address" name="email_address" class="form-control">
                                        @error('email_address')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="">Mobile No.</label>
                                        <input type="text" value="{{old('mobile_no')}}" placeholder="Mobile No." name="mobile_no" class="form-control">
                                        @error('mobile_no')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <label for="">Schedule Date & Time</label>
                                        <input type="datetime-local" value="{{old('schedule_date_time')}}" placeholder="Date & Time" name="schedule_date_time" class="form-control">
                                        @error('schedule_date_time')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <label for="">Message</label>
                                        <textarea name="message" id="message" style="resize: none;" placeholder="I'm interested in {{$property->property_name ?? '...'}}" class="form-control">{{old('message')}}</textarea>
                                        @error('message')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="properti" value="{{$property->id}}">
                                </div>
                                <div class="row ">
                                    <div class="col-md-12 col-sm-12 col-lg-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-inline"><i class="fas fa-check"></i><span>Submit</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <button type="button" data-target="#leaseApplicationModal" data-toggle="modal" class="btn btn-inline btn-outline"><i class="fa fa-check"></i><span>Submit Lease Application</span></button>
                    </div>
                    <div class="ad-details-price">
                        <h5>{{'₦'.number_format($property->rental_price,2)}}</h5>
                        <i class="flaticon-bargain"></i>
                    </div>
                    <a href="tel:{{$property->getCompany->phone_no ?? '+234'}}" class="ad-details-number">
                        <i class="fas fa-phone-alt"></i>
                        <span>Click to call realtor</span>
                    </a>
                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>Realtor</h5>
                        </div>
                        <div class="ad-details-profile">
                            <div class="author-img">
                                <a href="{{$property->getCompany->website ?? 'javascript:void(0);'}}" target="_blank">
                                    <img height="100" width="100" src="/assets/drive/{{$property->getCompany->logo ?? 'realtor.png' }}" alt="{{$property->getCompany->company_name ?? '' }}">
                                </a>
                            </div>
                            <div class="author-intro">
                                <h4>si
                                    <a href="{{$property->getCompany->website ?? 'javascript:void(0);'}}" target="_blank">{{$property->getCompany->company_name ?? '' }} </a>
                                </h4>
                            </div>
                            <hr>
                            <ul class="author-widget">
                                <li>
                                    <a href="tel:{{ $property->getCompany->phone_no ?? '' }}">
                                        <i class="fas fa-phone-alt"></i>
                                    </a>
                                </li>
                                @if(!Auth::check())
                                    <li>
                                        <a href="javascript:void(0);"  data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>Property Features</h5>
                        </div>
                        <div class="ad-details-safety">
                            <ul>
                                <li>
                                    {!!  $property->getPropertyFeatures->bedrooms == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Bedrooms: </strong> {{$property->getPropertyFeatures->bedrooms_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->bathrooms == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Bathrooms: </strong> {{$property->getPropertyFeatures->bathrooms_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->study_room == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Study room: </strong> {{$property->getPropertyFeatures->study_room_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->dinning_room == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Dinning room: </strong> {{$property->getPropertyFeatures->dinning_room_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->carports == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Carports: </strong> {{$property->getPropertyFeatures->carports_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->kitchens == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Kitchens: </strong> {{$property->getPropertyFeatures->kitchens_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->garages == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Garages: </strong> {{$property->getPropertyFeatures->garages_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->flooring == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Flooring: </strong> {{$property->getPropertyFeatures->flooring_type ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->laundry == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Laundry: </strong> {{$property->getPropertyFeatures->laundry_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->balcony == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Balcony: </strong> {{$property->getPropertyFeatures->balcony_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->pool == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Pool: </strong> {{$property->getPropertyFeatures->pool_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->garden == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Garden: </strong> {{$property->getPropertyFeatures->garden_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->views == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Views: </strong> {{$property->getPropertyFeatures->views_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->security == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Security: </strong> {{$property->getPropertyFeatures->security_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->store_room == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Store room: </strong> {{$property->getPropertyFeatures->store_room_comment ?? ''}}</p>
                                </li>
                                <li>
                                    {!!  $property->getPropertyFeatures->lounges == 1 ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" !!}
                                    <p><strong>Lounges: </strong> {{$property->getPropertyFeatures->lounges_comment ?? ''}}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>featured ads</h5>
                        </div>
                        <div class="ad-details-feature slider-arrow">
                            <div class="feature-card">
                                <div class="feature-img">
                                    <a href="#">
                                        <img src="/images/product/10.jpg" alt="feature">
                                    </a>
                                </div>
                                <div class="feature-badge">
                                    <p>Featured</p>
                                </div>
                                <div class="feature-bookmark">
                                    <button type="button">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                                <div class="feature-content">
                                    <ol class="breadcrumb">
                                        <li>
                                            <span class="feature-cate rent">Rent</span>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">automobile</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Private Car</li>
                                    </ol>
                                    <div class="feature-title">
                                        <h3>
                                            <a href="#">Unde eveniet ducimus nostrum maiores soluta temporibus ipsum dolor sit amet.</a>
                                        </h3>
                                    </div>
                                    <ul class="feature-meta">
                                        <li>
                                                <span>$1200
                                                    <small>/Monthly</small>
                                                </span>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <span>56 minute ago!</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-img">
                                    <a href="#">
                                        <img src="/images/product/01.jpg" alt="feature">
                                    </a>
                                </div>
                                <div class="feature-badge">
                                    <p>Featured</p>
                                </div>
                                <div class="feature-bookmark">
                                    <button type="button">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                                <div class="feature-content">
                                    <ol class="breadcrumb">
                                        <li>
                                            <span class="feature-cate booking">Booking</span>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Property</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">House</li>
                                    </ol>
                                    <div class="feature-title">
                                        <h3>
                                            <a href="#">Unde eveniet ducimus nostrum maiores soluta temporibus ipsum dolor sit amet.</a>
                                        </h3>
                                    </div>
                                    <ul class="feature-meta">
                                        <li>
                                                <span>$800
                                                    <small>/Per Day</small>
                                                </span>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <span>56 minute ago!</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-img">
                                    <a href="#">
                                        <img src="/images/product/08.jpg" alt="feature">
                                    </a>
                                </div>
                                <div class="feature-badge">
                                    <p>Featured</p>
                                </div>
                                <div class="feature-bookmark">
                                    <button type="button">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                                <div class="feature-content">
                                    <ol class="breadcrumb">
                                        <li>
                                            <span class="feature-cate sale">sale</span>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Gadget</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Iphone</li>
                                    </ol>
                                    <div class="feature-title">
                                        <h3>
                                            <a href="#">Unde eveniet ducimus nostrum maiores soluta temporibus ipsum dolor sit amet.</a>
                                        </h3>
                                    </div>
                                    <ul class="feature-meta">
                                        <li>
                                                <span>$1150
                                                    <small>/Negotiable</small>
                                                </span>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <span>56 minute ago!</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($property->getSimilarVacantPropertyListingByLocationId($property->location_id)->count() > 0)
        <section class="related-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Similar
                            <span>Properties</span>
                        </h2>
                        <p>Here are similar properties in the same location.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="related-slider slider-arrow">
                        @foreach($property->getSimilarVacantPropertyListingByLocationId($property->location_id) as $similar_p)
                            <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(/assets/images/property/interior/{{$similar_p->getFeaturedInteriorImage->directory}}) no-repeat center; background-size:cover;">
                                    <i class="cross-badge fas fa-bolt"></i>
                                    <span class="flat-badge booking">
                                         @switch($similar_p->property_type)
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
                                    </span>
                                    <ul class="product-meta">
                                        <li>
                                            <i class="fa fa-bed" title="Bedrooms"></i>
                                            <p>{{$similar_p->getPropertyFeatures->bedrooms ?? 0}}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-bath" title="Bathrooms"></i>
                                            <p>{{$similar_p->getPropertyFeatures->bathrooms ?? 0}}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-fire" title="Kitchens"></i>
                                            <p>{{$similar_p->getPropertyFeatures->kitchens ?? 0}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-title">
                                    <h5>
                                        <a href="{{route('view-listing', $similar_p->slug)}}">{{strlen($similar_p->property_name ) > 34 ? substr(ucfirst(strtolower($similar_p->property_name)), 0, 34).'...' : ucfirst(strtolower($similar_p->property_name)) }}</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>{{$similar_p->getLocation->location_name ?? ''}}, {{$similar_p->getArea->area_name ?? ''}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>{{'₦'.number_format($similar_p->rental_price,2)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message {{$property->getCompany->company_name ?? '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="ad-review-form" method="post" action="route('message-seller')}}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Type message here..." name="message" style="resize: none;"></textarea>
                        </div>
                        <input type="hidden" name="to" value="{{$property->getCompany->id}}">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-inline" type="submit">
                                <i class="fas fa-tint"></i>
                                <span>submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="leaseApplicationModal" tabindex="-1" role="dialog" aria-labelledby="leaseApplicationModalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit An Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Thank you for your interest in this property. We'll be glad to have this interest materialized. Submit an application and we'll get back to you as soon as possible.</p>
                    <form class="ad-review-form" method="post" action="{{route('register-tenant-app')}}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" placeholder="First Name" value="{{old('first_name')}}" name="first_name" class="form-control">
                                    @error('first_name') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Surname</label>
                                    <input type="text" placeholder="Surname" value="{{old('surname')}}" name="surname" class="form-control">
                                    @error('surname') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="text" placeholder="Email Address" value="{{old('email')}}" name="email" class="form-control">
                                    @error('email') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Mobile No.</label>
                                    <input type="text" placeholder="Mobile No." value="{{old('mobile_no')}}" name="mobile_no" class="form-control">
                                    @error('mobile_no') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <label for="">Residency Date <small>(Optional)</small></label>
                                <input type="date" name="date_of_residency" value="{{old('date_of_residency')}}" class="form-control">
                                @error('date_of_residency') <i class="text-danger mt-2">{{$message}}</i> @enderror
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <label for="">Address</label>
                                <textarea name="address" placeholder="Address" style="resize: none;" class="form-control"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="property" value="{{$property->id}}">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-inline" type="submit">
                                <i class="fas fa-tint"></i>
                                <span>submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-scripts')
    <script src="/js/custom/price-range.js"></script>
@endsection
