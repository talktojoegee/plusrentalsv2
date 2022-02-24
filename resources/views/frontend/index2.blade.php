@extends('layouts.tenant-layout')
@section('title')
    Home
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/leftbar-list.css">
@endsection
@section('meta-title')
    keywords
@endsection
@section('meta-keyword')
    {{config('app.name')}}, home page, landlord, manage your property, real estate management system, real estate software solution.
@endsection

@section('main-content')
    <section class="banner-part">
        <div class="container">
            <div class="banner-content">
                <h1>We're {{config('app.name')}}</h1>
                <p>Browse our array of properties available for rent. Send in an application for a property of interest and we'll get in touch with you.</p>
                <a href="{{route('property-listing')}}" class="btn btn-outline">
                    <i class="fas fa-eye"></i>
                    <span>Show all properties</span>
                </a>
            </div>
        </div>
    </section>
    <section class="section feature-part">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5">
                    <div class="section-side-heading">
                        <h2>Find your needs in our best
                            <span>Featured Ads</span>
                        </h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero voluptatum repudiandae veniam maxime tenetur fugiat eaque alias nobis doloremque culpa nam.</p>
                        <a href="{{route('property-listing')}}" class="btn btn-inline">
                            <i class="fas fa-eye"></i>
                            <span>view all properties</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-7 col-lg-7">
                    <div class="feature-item-slider slider-arrow">
                        <div class="feature-card">
                            <div class="feature-img">
                                <a href="#">
                                    <img src="images/product/10.jpg" alt="feature">
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
                                    <img src="images/product/01.jpg" alt="feature">
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
                                    <img src="images/product/08.jpg" alt="feature">
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
                        <div class="feature-card">
                            <div class="feature-img">
                                <a href="#">
                                    <img src="images/product/06.jpg" alt="feature">
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
                                        <span class="feature-cate sale">Sale</span>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">automobile</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">cycle</li>
                                </ol>
                                <div class="feature-title">
                                    <h3>
                                        <a href="#">Unde eveniet ducimus nostrum maiores soluta temporibus ipsum dolor sit amet.</a>
                                    </h3>
                                </div>
                                <ul class="feature-meta">
                                    <li>
                                            <span>$455
                                                <small>/Fixed</small>
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
                    <div class="feature-thumb-slider">
                        <div>
                            <img src="images/product/10.jpg" alt="feature">
                        </div>
                        <div>
                            <img src="images/product/01.jpg" alt="feature">
                        </div>
                        <div>
                            <img src="images/product/08.jpg" alt="feature">
                        </div>
                        <div>
                            <img src="images/product/06.jpg" alt="feature">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section recomend-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Featured
                            <span>Properties</span>
                        </h2>
                        <p>Browse our array of properties available for lease. Select a property of your choice, submit an application and
                        we'll get in touch with you as soon as possible.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                        @foreach($properties as $property)
                            <div class="product-card">
                                <div class="product-head">
                                    <div class="product-img" style="background:url(/assets/images/property/interior/{{$property->getFeaturedInteriorImage->directory}}) no-repeat center; background-size:cover;">
                                        <span class="flat-badge booking">
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
                                        <ul class="product-meta">
                                            <li>
                                                <i class="fa fa-bed" title="Bedrooms"></i>
                                                <p>{{$property->getPropertyFeatures->bedrooms ?? 0}}</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-bath" title="Bathrooms"></i>
                                                <p>{{$property->getPropertyFeatures->bathrooms ?? 0}}</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-fire" title="Kitchens"></i>
                                                <p>{{$property->getPropertyFeatures->kitchens ?? 0}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="product-title">
                                        <h5>
                                            <a href="{{route('view-listing', $property->slug)}}">{{strlen($property->property_name ) > 34 ? substr(ucfirst(strtolower($property->property_name)), 0, 34).'...' : ucfirst(strtolower($property->property_name)) }}</a>
                                        </h5>
                                        <ul class="product-location">
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <p>{{$property->getLocation->location_name ?? ''}}, {{$property->getArea->area_name ?? ''}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-details">
                                        <div class="product-price">
                                            <h5>{{'₦'.number_format($property->rental_price,2)}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                        <a href="{{route('property-listing')}}" class="btn btn-inline">
                            <i class="fas fa-eye"></i>
                            <span>view all properties</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($for_rent->count() > 0 || $for_sale->count() > 0)
     <section class="section niche-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Currently Leasing/
                            <span>Selling</span>
                        </h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero voluptatum repudiandae veniam maxime tenetur.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="niche-nav">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="#ratings" class="nav-link {{$for_rent->count() > $for_sale->count() ? 'active' : '' }} " data-toggle="tab">For Lease</a>
                            </li>
                            <li>
                                <a href="#advertiser" class="nav-link {{$for_rent->count() < $for_sale->count() ? 'active' : '' }} " data-toggle="tab">For Sale</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane {{$for_rent->count() > $for_sale->count() ? 'active' : '' }} " id="ratings">
                <div class="row">
                    @foreach($for_rent as $rproperty)
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(/assets/images/property/interior/{{$rproperty->getFeaturedInteriorImage->directory}}) no-repeat center; background-size:cover;">
                                    <span class="flat-badge booking">
                                        @switch($rproperty->property_type)
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
                                            <p>{{$rproperty->getPropertyFeatures->bedrooms ?? 0}}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-bath" title="Bathrooms"></i>
                                            <p>{{$rproperty->getPropertyFeatures->bathrooms ?? 0}}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-fire" title="Kitchens"></i>
                                            <p>{{$rproperty->getPropertyFeatures->kitchens ?? 0}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-title">
                                    <h5>
                                        <a href="{{route('view-listing', $rproperty->slug)}}">{{strlen($rproperty->property_name ) > 34 ? substr(ucfirst(strtolower($rproperty->property_name)), 0, 34).'...' : ucfirst(strtolower($rproperty->property_name)) }}</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>{{$rproperty->getLocation->location_name ?? ''}}, {{$rproperty->getArea->area_name ?? ''}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>{{'₦'.number_format($rproperty->rental_price,2)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane {{$for_rent->count() < $for_sale->count() ? 'active' : '' }} " id="advertiser">
                <div class="row">
                    @foreach($for_sale as $sproperty)
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="product-card">
                                <div class="product-head">
                                    <div class="product-img" style="background:url(/assets/images/property/interior/{{$sproperty->getFeaturedInteriorImage->directory}}) no-repeat center; background-size:cover;">
                                    <span class="flat-badge booking">
                                        @switch($sproperty->property_type)
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
                                                <p>{{$sproperty->getPropertyFeatures->bedrooms ?? 0}}</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-bath" title="Bathrooms"></i>
                                                <p>{{$sproperty->getPropertyFeatures->bathrooms ?? 0}}</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-fire" title="Kitchens"></i>
                                                <p>{{$sproperty->getPropertyFeatures->kitchens ?? 0}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="product-title">
                                        <h5>
                                            <a href="{{route('view-listing', $sproperty->slug)}}">{{strlen($sproperty->property_name ) > 34 ? substr(ucfirst(strtolower($sproperty->property_name)), 0, 34).'...' : ucfirst(strtolower($sproperty->property_name)) }}</a>
                                        </h5>
                                        <ul class="product-location">
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <p>{{$sproperty->getLocation->location_name ?? ''}}, {{$sproperty->getArea->area_name ?? ''}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-details">
                                        <div class="product-price">
                                            <h5>{{'₦'.number_format($sproperty->rental_price,2)}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="center-20">
                        <a href="{{route('property-listing')}}" class="btn btn-inline">
                            <i class="fas fa-eye"></i>
                            <span>view all properties</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection

@section('extra-scripts')
    <script src="/js/custom/interaction.js"></script>
    <script src="/js/custom/axios.min.js"></script>
@endsection
