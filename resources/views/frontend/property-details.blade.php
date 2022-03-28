@extends('layouts.main-layout')
@section('title')
    Home
@endsection
@section('meta-keywords')
    Real estate, smart homes, property listing, properties, rent payment, tenant portal,
@endsection
@section('meta-description')
    PlusRentals is a property manage...
@endsection
@section('extra-styles')

@endsection

@section('main-content')
    <div class="parallax titlebar" data-background="/images2/listings-parallax.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505">
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Property Detail</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li>Property Detail</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row margin-bottom-50">
            <div class="col-md-12">
                <div class="property-slider default">
                    @foreach($property->getInteriorGallery as $interior)
                    <a href="/assets/images/property/interior/{{$interior->directory ?? ''}}" data-background-image="/assets/images/property/interior/{{$interior->directory ?? ''}}" class="item mfp-gallery"></a>
                    @endforeach
                </div>
                <div class="property-slider-nav">
                    @foreach ($property->getInteriorGallery as $image)
                    <div class="item"><img src="/assets/images/property/interior/{{$image->directory ?? ''}}" alt="{{ucfirst(strtolower($property->property_name))}}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                @if(session()->has('success'))
                    <div class="notification success closeable">
                        {!! session()->get('success') !!}
                        <a class="close"></a>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="notification warning closeable">
                        {!! session()->get('error') !!}
                        <a class="close"></a>
                    </div>
                @endif
                @if ($errors->any())
                        <div class="notification warning closeable">
                    @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            <a class="close"></a>
                    @endforeach
                        </div>
                    @endif
                <div id="titlebar-dtl-item" class="property-titlebar margin-bottom-0">
                    <div class="property-title">
                        <div class="property-pricing">{{'₦'.number_format($property->rental_price,2)}}/{{$property->getLeaseFrequency->frequency ?? ''}}</div>
                        <h2>{{ucfirst(strtolower($property->property_name))}} <span class="property-badge-sale">
                                @if($property->listing_type == 1)
                                    For Rent
                                @else
                                    For Sale
                                @endif
                            </span></h2>
                        <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> {{$property->getLocation->location_name ?? ''}}, {{$property->getArea->area_name ?? ''}}</span>
                        <ul class="property-main-features">
                            <li>Beds<span>{{$property->getPropertyFeatures->bedrooms ?? 0}}</span></li>
                            <li>Baths<span>{{$property->getPropertyFeatures->bathrooms ?? 0}}</span></li>
                            <li>Kitchens<span>{{$property->getPropertyFeatures->kitchens ?? 0}}</span></li>
                        </ul>
                    </div>
                </div>

                <div class="property-description">
                    <div class="utf-desc-headline-item">
                        <h3><i class="icon-material-outline-description"></i> Property Description</h3>
                    </div>
                    <div class="show-more">
                        {!! $property->description ?? '' !!}
                        <a href="#" class="show-more-button">Show More <i class="sl sl-icon-plus"></i></a>
                    </div>
                    <div class="utf-desc-headline-item">
                        <h3><i class="sl sl-icon-briefcase"></i> Property Details</h3>
                    </div>
                    <ul class="property-features margin-top-0">
                        <li>Price: <span>{{'₦'.number_format($property->rental_price,2)}}/{{$property->getLeaseFrequency->frequency ?? ''}}</span></li>
                        <li>Property Type: <span>
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
                            </span></li>
                        <li>Listing Type: <span>@if($property->listing_type == 1)
                                    For Rent
                                @else
                                    For Sale
                                @endif</span></li>
                    </ul>
                    <!-- Features -->
                    <div class="utf-desc-headline-item">
                        <h3><i class="sl sl-icon-briefcase"></i> Property Features</h3>
                    </div>
                    <ul class="property-features margin-top-0">
                        <li>
                            {!!  $property->getPropertyFeatures->bedrooms == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Bedrooms:  {{$property->getPropertyFeatures->bedrooms_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->bathrooms == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Bathrooms:{{$property->getPropertyFeatures->bathrooms_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->study_room == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Study room:  {{$property->getPropertyFeatures->study_room_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->dinning_room == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Dinning room:  {{$property->getPropertyFeatures->dinning_room_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->carports == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Carports:  {{$property->getPropertyFeatures->carports_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->kitchens == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Kitchens:  {{$property->getPropertyFeatures->kitchens_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->garages == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Garages:  {{$property->getPropertyFeatures->garages_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->flooring == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Flooring:  {{$property->getPropertyFeatures->flooring_type ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->laundry == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Laundry:  {{$property->getPropertyFeatures->laundry_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->balcony == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Balcony: {{$property->getPropertyFeatures->balcony_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->pool == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Pool: {{$property->getPropertyFeatures->pool_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->garden == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Garden: {{$property->getPropertyFeatures->garden_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->views == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Views: {{$property->getPropertyFeatures->views_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->security == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Security: {{$property->getPropertyFeatures->security_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->store_room == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Store room: {{$property->getPropertyFeatures->store_room_comment ?? '-'}}
                        </li>
                        <li>
                            {!!  $property->getPropertyFeatures->lounges == 1 ? "<i class='icon-material-outline-check-circle' style='color: green'></i>" : "<i class='sl sl-icon-close text-danger'></i>" !!}
                            Lounges: {{$property->getPropertyFeatures->lounges_comment ?? '-'}}
                        </li>
                    </ul>

                    <!-- Add Comment -->
                    <div class="utf-inner-blog-section-title">
                        <h4><i class="icon-line-awesome-comments-o"></i> Schedule Property Inspection</h4>
                    </div>
                    <div class="margin-top-15"></div>
                    <form action="{{route('schedule-property-inspection')}}" class="ad-review-form utf-sidebar-widget-item" method="post">
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
                            <div class="col-md-12 col-sm-12 col-lg-12 add-comment">
                                <label for="">Message</label>
                                <textarea style="resize: none;" name="message" placeholder="I'm interested in {{$property->property_name ?? '...'}}" class="form-control">{{old('message')}}</textarea>
                                @error('message')
                                <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <input type="hidden" name="properti" value="{{$property->id}}">
                        </div>
                        <div class="row ">
                            <div class="col-md-12 col-sm-12 col-lg-12 utf-centered-button">
                                <button type="submit" class="button"><i class="icon-feather-check"></i><span>Submit</span></button>
                            </div>
                        </div>
                    </form>
                @if($property->getSimilarVacantPropertyListingByLocationId($property->location_id)->where('id', '!=', $property->id)->count() > 0)
                    <div class="utf-desc-headline-item">
                        <h3><i class="icon-material-outline-description"></i> Similar Properties</h3>
                    </div>
                    <div class="utf-layout-switcher hidden">
                        <a href="#" class="list"><i class="fa fa-th-list"></i></a>
                    </div>
                    <div class="utf-listings-container-area list-layout">
                        @foreach($property->getSimilarVacantPropertyListingByLocationId($property->location_id)->where('id', '!=', $property->id) as $similar_p)
                            <div class="utf-listing-item"> <a href="#" class="utf-smt-listing-img-container">
                                    <div class="utf-listing-badges-item"> <span class="for-rent"> </span> </div>
                                    <div class="utf-listing-img-content-item">
                                        <img class="utf-user-picture" src="/assets/drive/{{$similar_p->getCompany->logo ?? 'realtor.png' }}" alt="{{$similar_p->getCompany->company_name ?? '' }} " />
                                    </div>
                                    <img src="/assets/images/property/interior/{{$similar_p->getFeaturedInteriorImage->directory}}" alt="{{$similar_p->property_name ?? '' }}"> </a>
                                <div class="utf-listing-content">
                                    <div class="utf-listing-title">
                                        <span class="utf-listing-price">{{'₦'.number_format($similar_p->rental_price,2)}}/{{$similar_p->getLeaseFrequency->frequency ?? ''}}</span>
                                        <h4>
                                            <a href="{{route('view-listing', $similar_p->slug)}}">{{strlen($similar_p->property_name ) > 34 ? substr(ucfirst(strtolower($similar_p->property_name)), 0, 34).'...' : ucfirst(strtolower($similar_p->property_name)) }}</a>
                                        </h4>
                                        <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i>{{$similar_p->getLocation->location_name ?? ''}}, {{$similar_p->getArea->area_name ?? ''}}</span>
                                    </div>
                                    <ul class="utf-listing-features">
                                        <li><i class="fa fa-bed"></i> Beds<span>{{$similar_p->getPropertyFeatures->bedrooms ?? 0}}</span></li>
                                        <li><i class="fa fa-shower"></i> Baths<span>{{$similar_p->getPropertyFeatures->bathrooms ?? 0}}</span></li>
                                        <li><i class="fa fa-fire"></i> Kitchen<span>{{$similar_p->getPropertyFeatures->kitchens ?? 0}}</span></li>
                                        <li><i class="icon-material-outline-restaurant"></i>Dinning<span>{{$property->getPropertyFeatures->dinning_room_comment ?? 0}}</span></li>
                                    </ul>
                                    <div class="utf-listing-user-info">
                                        <a href="#"><i class="icon-line-awesome-user"></i> {{$similar_p->getCompany->company_name ?? '' }} </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <h3 class="text-center">There're no similar properties in this location.</h3>
                    @endif
                    <div class="clearfix"></div>
                    <div class="margin-top-35"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <a  href="#utf-signin-dialog-block"  class="popup-with-zoom-anim log-in-button sign-in button"><i class="icon-feather-send"></i> {{$property->listing_type == 1 ? "Submit Lease Application" : "Submit Buyer Request"}} </a>
                <div class="sidebar">
                    <div class="widget utf-sidebar-widget-item">
                        <div class="utf-detail-banner-add-section">
                            <a href="#"><img src="/images2/banner-add-2.jpg" alt="banner-add-2"></a>
                        </div>
                    </div>
                    <div class="widget utf-sidebar-widget-item">
                        <div class="agent-widget">
                            <div class="utf-boxed-list-headline-item">
                                <h3>Realtor</h3>
                            </div>
                            <div class="agent-title">
                                <div class="agent-photo"><img src="/assets/drive/{{$property->getCompany->logo ?? 'realtor.png' }}" alt="{{$property->getCompany->company_name ?? '' }}" /></div>
                                <div class="agent-details">
                                    <h4><a href="{{$property->getCompany->website ?? 'javascript:void(0);'}}" target="_blank">{{$property->getCompany->company_name ?? '' }}</a></h4>
                                    <span>{{ $property->getCompany->phone_no ?? '' }}</span>
                                    <span>{{ $property->getCompany->email ?? '' }}</span>
                                    <span><a href="agents-profile.html">View My Listing</a></span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget utf-sidebar-widget-item">
                        <div class="utf-boxed-list-headline-item">
                            <h3>Featured Properties</h3>
                        </div>
                        <div class="utf-listing-carousel-item outer">
                            <!-- Item -->
                            <div class="item">
                                <div class="utf-listing-item compact">
                                    <a href="single-property-page-2.html" class="utf-smt-listing-img-container">
                                        <div class="utf-listing-badges-item"> <span class="featured">Featured</span> <span class="for-sale">For Sale</span> </div>
                                        <div class="utf-listing-img-content-item">
                                            <span class="utf-listing-compact-title-item">Renovated Luxury Apartment <i>$18,000/mo</i></span>
                                        </div>
                                        <img src="/images2/listing-01.jpg" alt="">
                                        <ul class="listing-hidden-content">
                                            <li><i class="fa fa-bed"></i> Beds <span>3</span></li>
                                            <li><i class="icon-feather-codepen"></i> Baths <span>2</span></li>
                                            <li><i class="fa fa-car"></i> Garages <span>2</span></li>
                                            <li><i class="fa fa-arrows-alt"></i> Sq Ft <span>780</span></li>
                                        </ul>
                                    </a>
                                </div>
                            </div>
                            <!-- Item / End -->

                            <!-- Item -->
                            <div class="item">
                                <div class="utf-listing-item compact">
                                    <a href="single-property-page-2.html" class="utf-smt-listing-img-container">
                                        <div class="utf-listing-badges-item"> <span class="featured">Featured</span> <span class="for-sale">For Sale</span> </div>
                                        <div class="utf-listing-img-content-item">
                                            <span class="utf-listing-compact-title-item">Renovated Luxury Apartment <i>$18,000/mo</i></span>
                                        </div>
                                        <img src="/images2/listing-02.jpg" alt="">
                                        <ul class="listing-hidden-content">
                                            <li><i class="fa fa-bed"></i> Beds <span>3</span></li>
                                            <li><i class="icon-feather-codepen"></i> Baths <span>2</span></li>
                                            <li><i class="fa fa-car"></i> Garages <span>2</span></li>
                                            <li><i class="fa fa-arrows-alt"></i> Sq Ft <span>780</span></li>
                                        </ul>
                                    </a>
                                </div>
                            </div>
                            <!-- Item / End -->

                            <!-- Item -->
                            <div class="item">
                                <div class="utf-listing-item compact">
                                    <a href="single-property-page-2.html" class="utf-smt-listing-img-container">
                                        <div class="utf-listing-badges-item"> <span class="featured">Featured</span> <span class="for-sale">For Sale</span> </div>
                                        <div class="utf-listing-img-content-item">
                                            <span class="utf-listing-compact-title-item">Renovated Luxury Apartment <i>$18,000/mo</i></span>
                                        </div>
                                        <img src="/images2/listing-03.jpg" alt="">
                                        <ul class="listing-hidden-content">
                                            <li><i class="fa fa-bed"></i> Beds <span>3</span></li>
                                            <li><i class="icon-feather-codepen"></i> Baths <span>2</span></li>
                                            <li><i class="fa fa-car"></i> Garages <span>2</span></li>
                                            <li><i class="fa fa-arrows-alt"></i> Sq Ft <span>780</span></li>
                                        </ul>
                                    </a>
                                </div>
                            </div>
                            <!-- Item / End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
        <div class="utf-signin-form-part">
            <div class="utf-popup-container-part-tabs">
                <div class="utf-popup-tab-content-item" id="login">
                    <div class="utf-welcome-text-item">
                        <h3>Submit An Application</h3>
                        <span>
                            Thank you for your interest in this property. We'll be glad to have this interest materialized. Submit an application and we'll get back to you as soon as possible.
                        </span>
                    </div>
                    <form method="post" action="{{route('register-tenant-app')}}" id="login-form" autocomplete="off">
                        @csrf
                        <div class="utf-no-border">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" value="{{old('first_name')}}" placeholder="First Name" />
                            @error('first_name') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="utf-no-border">
                            <label for="">Surname</label>
                            <input type="text" name="surname"  placeholder="Surname" value="{{old('surname')}}"/>
                            @error('surname') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="utf-no-border">
                            <label for="">Email Address</label>
                            <input type="text" name="email"  placeholder="Email Address" value="{{old('email')}}"/>
                            @error('email') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="utf-no-border">
                            <label for="">Mobile No.</label>
                            <input type="text" name="mobile_no"  placeholder="Mobile No." value="{{old('mobile_no')}}"/>
                            @error('mobile_no') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="utf-no-border">
                            <label for="">Residency Date</label>
                            <input type="date" name="date_of_residency"  placeholder="Date of Residency" value="{{old('date_of_residency')}}"/>
                            @error('date_of_residency') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="utf-no-border">
                            <label for="">Address</label>
                            <textarea name="address" style="resize:none;" placeholder="Address">{{old('address')}}</textarea>
                            @error('address') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="utf-no-border">
                            <input type="hidden" name="property" value="{{$property->id}}">
                            <button class="button" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

@endsection
