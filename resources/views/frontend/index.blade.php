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
    <div class="parallax" data-background="/images2/home-parallax-1.jpg" data-color="#36383e" data-color-opacity="0.72" data-img-width="2500" data-img-height="1600">
        <div class="utf-parallax-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="utf-main-search-container-area">
                            <div class="utf-banner-headline-text-part">
                                <h2>Best Place To Find <span class="typed-words"></span></h2>
                                <span>From as low as $10 per day with limited time offer discounts.</span>
                            </div>
                            @include('partials._search-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($properties->where('listing_type',1)) > 0)
        <section class="fullwidth" data-background-color="#ffffff">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="utf-section-headline-item centered margin-bottom-30 margin-top-0">
                            <h3 class="headline"><span>Currently Renting</span> For Rent</h3>
                            <div class="utf-headline-display-inner-item">Currently Renting</div>
                            <p class="utf-slogan-text">Find properties currently renting at different locations.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="carousel">
                            @foreach($properties->where('listing_type',1) as $property)
                                <div class="utf-carousel-item-area">
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
                                                <h4><a href="{{route('view-listing', $property->slug)}}">{{strlen($property->property_name ) > 25 ? substr(ucfirst(strtolower($property->property_name)), 0, 25).'...' : ucfirst(strtolower($property->property_name)) }}</a></h4>
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(count($properties->where('listing_type',2)) > 0)
        <section class="fullwidth" data-background-color="#fbfbfb">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="utf-section-headline-item centered margin-bottom-30 margin-top-0">
                            <h3 class="headline"><span>Selling</span> For Sale</h3>
                            <div class="utf-headline-display-inner-item">Selling</div>
                            <p class="utf-slogan-text">Get a property that suites your lifestyle.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="carousel">
                            @foreach($properties->where('listing_type',2) as $property)
                                <div class="utf-carousel-item-area">
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
                                                <h4><a href="{{route('view-listing', $property->slug)}}">{{strlen($property->property_name ) > 25 ? substr(ucfirst(strtolower($property->property_name)), 0, 25).'...' : ucfirst(strtolower($property->property_name)) }}</a></h4>
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Start Section Callout -->
    <div class="jbm-section-callout">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 callout-bg-1 callout-section-left pos-relative">
                    <div class="callout-bg"></div>
                    <div class="jbm-callout-in jbm-callout-in-padding pull-right">
                        <div class="jbm-section-title margin-top-80 margin-bottom-80">
                            <h2>Are You A Property Owner?</h2>
                            <span class="section-tit-line"></span>
                            <p>List and manage all your properties all in one place. Generate reports, manage tenants, send reminders and much more..</p>
                            <a href="#" class="button margin-top-10">Add New Property</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 callout-bg-2 callout-section-right pos-relative">
                    <div class="callout-bg"></div>
                    <div class="jbm-callout-in jbm-callout-in-padding pull-left">
                        <div class="jbm-section-title margin-bottom-80 margin-top-80">
                            <h2>Find Your Browse Properti</h2>
                            <span class="section-tit-line"></span>
                            <p>Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                            <a href="listings-list-with-sidebar.html" class="button margin-top-10">Browse Properti</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Section Callout -->

    <!-- Photo Section -->
    <div class="utf-photo-section-block">
        <div class="utf-photo-text-content white-font">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <h2>Download Browse Hundreds of Properti</h2>
                        <p>Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic type setting, remaining essentially unchanged. It was popularised.</p>
                        <ul class="utf-download-text">
                            <li>
                                <a href="#" class="tooltip top" title="Windows App">
                                    <i class="icon-line-awesome-windows"></i>
                                    <span>Windows</span>
                                    <p>Available Now</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltip top" title="App Store">
                                    <i class="icon-line-awesome-apple"></i>
                                    <span>App Store</span>
                                    <p>Available Now</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltip top" title="Google Play">
                                    <i class="icon-line-awesome-android"></i>
                                    <span>Google Play</span>
                                    <p>Get in On</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="download-img">
                            <img src="/images2/mockup3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Photo Section / End -->

    <section class="fullwidth" data-background-color="linear-gradient(to bottom,rgba(0,0,0,0.03) 0%,rgba(255,255,255,0))">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="utf-section-headline-item centered margin-bottom-30 margin-top-0">
                        <h3 class="headline"><span>Our Blog & Articles</span> Latest Blog Post</h3>
                        <div class="utf-headline-display-inner-item">Our Blog & Articles</div>
                        <p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-post">
                        <a href="blog_detail_right_sidebar.html" class="post-img"> <img src="/images2/blog-post-01.jpg" alt=""> </a>
                        <div class="utf-post-content-area">
                            <h3><a href="blog_detail_right_sidebar.html">What It Really Takes to Make $100k Before You Turn 30</a></h3>
                            <ul class="utf-blog-item-post-list">
                                <li>By, John Williams</li>
                                <li>20 Jan, 2021</li>
                            </ul>
                            <p>Lorem Ipsum is simply dummy text of printing industry Lorem Ipsum been industry standard dummy text since book.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-post">
                        <a href="blog_detail_right_sidebar.html" class="post-img"> <img src="/images2/blog-post-02.jpg" alt=""> </a>
                        <div class="utf-post-content-area">
                            <h3><a href="blog_detail_right_sidebar.html">The Best Canadian Merchant Account Providers.</a></h3>
                            <ul class="utf-blog-item-post-list">
                                <li>By, John Williams</li>
                                <li>20 Jan, 2021</li>
                            </ul>
                            <p>Lorem Ipsum is simply dummy text of printing industry Lorem Ipsum been industry standard dummy text since book.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-post">
                        <a href="blog_detail_right_sidebar.html" class="post-img"> <img src="/images2/blog-post-03.jpg" alt=""> </a>
                        <div class="utf-post-content-area">
                            <h3><a href="blog_detail_right_sidebar.html">Hey Job Seeker, It’s Time To Get Up And Get Hired.</a></h3>
                            <ul class="utf-blog-item-post-list">
                                <li>By, John Williams</li>
                                <li>20 Jan, 2021</li>
                            </ul>
                            <p>Lorem Ipsum is simply dummy text of printing industry Lorem Ipsum been industry standard dummy text since book.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-scripts')

@endsection
