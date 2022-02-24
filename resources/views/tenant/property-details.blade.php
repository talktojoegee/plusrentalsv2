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
                    @if(!Auth::check())
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
                    @endif

                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <button type="button" data-target="#leaseApplicationModal" data-toggle="modal" class="btn btn-inline btn-outline"><i class="fa fa-check"></i><span>Submit Lease Application</span></button>
                    </div>
                    <div class="ad-details-price">
                        <h5>{{'₦'.number_format($property->rental_price,2)}}</h5>
                        <i class="flaticon-bargain"></i>
                    </div>
                    <button class="ad-details-number">
                        <i class="fas fa-phone-alt"></i>
                        <span>Click to show the number</span>
                    </button>
                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>Realtor</h5>
                        </div>
                        <div class="ad-details-profile">
                            <div class="author-img">
                                <a href="#">
                                    <img src="/images/avatar/01.jpg" alt="avatar">
                                    <span class="author-status"></span>
                                </a>
                            </div>
                            <div class="author-intro">
                                <h4>
                                    <a href="#">{{$property->getRentalOwner->ownership_type == 1 ? $property->getRentalOwner->first_name .' '.$property->getRentalOwner->surname : $property->getRentalOwner->company_name }} </a>
                                </h4>
                            </div>
                            <hr>
                            <ul class="author-widget">
                                <li>
                                    <a href="tel:{{$property->getRentalOwner->mobile_no ?? '' }}">
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
    <section class="related-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Similar
                            <span>Listings</span>
                        </h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero voluptatum repudiandae veniam maxime tenetur.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="related-slider slider-arrow">
                        <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(images/product/01.jpg) no-repeat center; background-size:cover;">
                                    <i class="cross-badge fas fa-bolt"></i>
                                    <span class="flat-badge booking">booking</span>
                                    <ul class="product-meta">
                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <p>264</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-mouse"></i>
                                            <p>134</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <p>4.5/7</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-tag">
                                    <i class="fas fa-tags"></i>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Luxury</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Duplex House</li>
                                    </ol>
                                </div>
                                <div class="product-title">
                                    <h5>
                                        <a href="rightbar-details.html">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>Uttara, Dhaka</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <p>30 min ago!</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>$1500</h5>
                                        <span>/Per Day</span>
                                    </div>
                                    <ul class="product-widget">
                                        <li>
                                            <a href="compare.html" class="tooltip">
                                                <i class="fas fa-compress"></i>
                                                <span class="tooltext top">compare</span>
                                            </a>
                                        </li>
                                        <li>
                                            <button class="tooltip">
                                                <i class="far fa-heart"></i>
                                                <span class="tooltext top">bookmark</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(images/product/03.jpg) no-repeat center; background-size:cover;">
                                    <i class="cross-badge fas fa-bolt"></i>
                                    <span class="flat-badge sale">sale</span>
                                    <ul class="product-meta">
                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <p>264</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-mouse"></i>
                                            <p>134</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <p>4.5/7</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-tag">
                                    <i class="fas fa-tags"></i>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">Stationary</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">books</li>
                                    </ol>
                                </div>
                                <div class="product-title">
                                    <h5>
                                        <a href="rightbar-details.html">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>Uttara, Dhaka</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <p>30 min ago!</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>$470</h5>
                                        <span>/fixed</span>
                                    </div>
                                    <ul class="product-widget">
                                        <li>
                                            <a href="compare.html" class="tooltip">
                                                <i class="fas fa-compress"></i>
                                                <span class="tooltext top">compare</span>
                                            </a>
                                        </li>
                                        <li>
                                            <button class="tooltip">
                                                <i class="far fa-heart"></i>
                                                <span class="tooltext top">bookmark</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(images/product/10.jpg) no-repeat center; background-size:cover;">
                                    <i class="cross-badge fas fa-bolt"></i>
                                    <span class="flat-badge rent">rent</span>
                                    <ul class="product-meta">
                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <p>264</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-mouse"></i>
                                            <p>134</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <p>4.5/7</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-tag">
                                    <i class="fas fa-tags"></i>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">automobile</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">private car</li>
                                    </ol>
                                </div>
                                <div class="product-title">
                                    <h5>
                                        <a href="rightbar-details.html">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>Uttara, Dhaka</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <p>30 min ago!</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>$3300</h5>
                                        <span>/per month</span>
                                    </div>
                                    <ul class="product-widget">
                                        <li>
                                            <a href="compare.html" class="tooltip">
                                                <i class="fas fa-compress"></i>
                                                <span class="tooltext top">compare</span>
                                            </a>
                                        </li>
                                        <li>
                                            <button class="tooltip">
                                                <i class="far fa-heart"></i>
                                                <span class="tooltext top">bookmark</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(images/product/09.jpg) no-repeat center; background-size:cover;">
                                    <i class="cross-badge fas fa-bolt"></i>
                                    <span class="flat-badge sale">sale</span>
                                    <ul class="product-meta">
                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <p>264</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-mouse"></i>
                                            <p>134</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <p>4.5/7</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-tag">
                                    <i class="fas fa-tags"></i>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">animals</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">cat</li>
                                    </ol>
                                </div>
                                <div class="product-title">
                                    <h5>
                                        <a href="rightbar-details.html">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>Uttara, Dhaka</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <p>30 min ago!</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>$900</h5>
                                        <span>/Negotiable</span>
                                    </div>
                                    <ul class="product-widget">
                                        <li>
                                            <a href="compare.html" class="tooltip">
                                                <i class="fas fa-compress"></i>
                                                <span class="tooltext top">compare</span>
                                            </a>
                                        </li>
                                        <li>
                                            <button class="tooltip">
                                                <i class="far fa-heart"></i>
                                                <span class="tooltext top">bookmark</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(images/product/02.jpg) no-repeat center; background-size:cover;">
                                    <i class="cross-badge fas fa-bolt"></i>
                                    <span class="flat-badge sale">sale</span>
                                    <ul class="product-meta">
                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <p>264</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-mouse"></i>
                                            <p>134</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <p>4.5/7</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-tag">
                                    <i class="fas fa-tags"></i>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">fashion</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">shoes</li>
                                    </ol>
                                </div>
                                <div class="product-title">
                                    <h5>
                                        <a href="rightbar-details.html">Lorem ipsum dolor sit amet consect adipisicing elit</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>Uttara, Dhaka</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <p>30 min ago!</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>$460</h5>
                                        <span>/fixed</span>
                                    </div>
                                    <ul class="product-widget">
                                        <li>
                                            <a href="compare.html" class="tooltip">
                                                <i class="fas fa-compress"></i>
                                                <span class="tooltext top">compare</span>
                                            </a>
                                        </li>
                                        <li>
                                            <button class="tooltip">
                                                <i class="far fa-heart"></i>
                                                <span class="tooltext top">bookmark</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                        <a href="rightbar-list.html" class="btn btn-inline">
                            <i class="fas fa-eye"></i>
                            <span>view all related</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message {{$property->getRentalOwner->ownership_type == 1 ? $property->getRentalOwner->first_name .' '.$property->getRentalOwner->surname : $property->getRentalOwner->company_name}}</h5>
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
                        <input type="hidden" name="to" value="{{$property->getRentalOwner->id}}">
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
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Surname</label>
                                    <input type="text" placeholder="Surname" value="{{old('surname')}}" name="surname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="text" placeholder="Email Address" value="{{old('email')}}" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="">Mobile No.</label>
                                    <input type="text" placeholder="Mobile No." value="{{old('mobile_no')}}" name="mobile_no" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <label for="">Residency Date <small>(Optional)</small></label>
                                <input type="date" name="date_of_residency" value="{{old('date_of_residency')}}" class="form-control">
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
