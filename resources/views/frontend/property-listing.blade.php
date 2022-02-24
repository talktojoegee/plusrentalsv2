@extends('layouts.main-layout')
@section('title')
    Property Listing
@endsection
@section('meta-keywords')
    Real estate, smart homes, property listing, properties, rent payment, tenant portal,
@endsection
@section('meta-description')
    Property Listing
@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="parallax titlebar" data-background="images/listings-parallax.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505">
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Property Listing</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li>Property Listing</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="utf-main-search-container-area inner-map-search-block inner-search-item">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('partials._search-form')
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-md-8">
                @if($search == 1)
                <div class="widget utf-sidebar-widget-item">
                    <div class="utf-boxed-list-headline-item">
                        <h3>Search Result </h3>
                        <p> <i class="text-danger icon-line-awesome-strikethrough"></i> {{$keyword ?? ''}}<br>
                            <i class="text-danger icon-material-outline-map"></i> Abuja <i class="icon-line-awesome-angle-right"></i>
                            <i class="text-danger icon-feather-map-pin"></i> Wuse 2
                        </p>
                    </div>
                </div>
                @endif

                <div class="utf-listings-container-area list-layout">
                    @if(count($properties) > 0 )
                        @foreach($properties as $property)
                            <div class="utf-listing-item">
                                <a href="{{route('view-listing', $property->slug)}}" class="utf-smt-listing-img-container">
                                    <div class="utf-listing-badges-item">
                                                    <span class="featured">
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
                                        @if($property->listing_type == 1)
                                            <span class="for-rent">For Rent</span>
                                        @else
                                            <span class="for-sale">For Sale</span>
                                        @endif
                                    </div>
                                    <div class="utf-listing-img-content-item">
                                        <img class="utf-user-picture" src="/assets/drive/{{$property->getCompany->logo ?? 'realtor.png' }}" alt="{{$property->getCompany->company_name ?? '' }} " />
                                    </div>
                                    <div class="utf-listing-carousel-item">
                                        @foreach($property->getInteriorGallery as $interior)
                                            <div>
                                                <img src="/assets/images/property/interior/{{$interior->directory ?? ''}}" alt="{{$property->property_name ?? ''}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </a>
                                <div class="utf-listing-content">
                                    <div class="utf-listing-title">
                                        <span class="utf-listing-price">{{'₦'.number_format($property->rental_price,2)}}/{{$property->getLeaseFrequency->frequency ?? ''}}</span>
                                        <h4><a href="{{route('view-listing', $property->slug)}}">{{strlen($property->property_name ) > 42 ? substr(ucfirst(strtolower($property->property_name)), 0, 42).'...' : ucfirst(strtolower($property->property_name)) }}</a></h4>
                                        <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> {{$property->getLocation->location_name ?? ''}}, {{$property->getArea->area_name ?? ''}}</span>
                                    </div>
                                    <ul class="utf-listing-features">
                                        <li><i class="fa fa-bed"></i> Beds<span>{{$property->getPropertyFeatures->bedrooms ?? 0}}</span></li>
                                        <li><i class="fa fa-shower"></i> Baths<span>{{$property->getPropertyFeatures->bathrooms ?? 0}}</span></li>
                                        <li><i class="fa fa-fire"></i> Kitchen<span>{{$property->getPropertyFeatures->kitchens ?? 0}}</span></li>
                                        <li><i class="icon-material-outline-restaurant"></i>Dinning<span>{{$property->getPropertyFeatures->dinning_room_comment ?? 0}}</span></li>
                                    </ul>
                                    <div class="utf-listing-user-info">
                                        <a href="#"><i class="icon-line-awesome-user"></i> {{$property->getCompany->company_name ?? '' }} </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <!-- Listings Container / End -->


                <div class="utf-pagination-container margin-top-20">
                   {{$properties->links()}}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="sidebar">
                    <!-- Widget -->
                    <div class="widget utf-sidebar-widget-item">
                        <div class="utf-detail-banner-add-section">
                            <a href="#">
                                <img src="/images2/banner-add-2.jpg" alt="banner-add-2">
                            </a>
                        </div>
                    </div>
                    <div class="widget utf-sidebar-widget-item">
                    <div class="widget utf-sidebar-widget-item">
                        <div class="utf-boxed-list-headline-item">
                            <h3>Recently Added</h3>
                        </div>
                        <ul class="widget-tabs">
                            <!-- Post #1 -->
                            <li>
                                <div class="widget-content">
                                    <div class="widget-thumb"> <a href="#">
                                            <img src="/images2/blog-widget-03.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="widget-text">
                                        <h5><a href="#">How to Woo a Recruiter and Land Your Dream.</a></h5>
                                        <span>$22,000/mo</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <!-- Post #2 -->
                            <li>
                                <div class="widget-content">
                                    <div class="widget-thumb"> <a href="#">
                                            <img src="/images2/blog-widget-02.jpg" alt=""></a> </div>
                                    <div class="widget-text">
                                        <h5><a href="">Hey Its Time To Get Up And Get Hired.</a></h5>
                                        <span>$22,000/mo</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="widget utf-sidebar-widget-item">
                        <div class="utf-boxed-list-headline-item">
                            <h3>Social Sharing</h3>
                        </div>
                        <ul class="utf-social-icons rounded">
                            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
                            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>
                            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-scripts')
    <script src="/js/custom/price-range.js"></script>
@endsection
