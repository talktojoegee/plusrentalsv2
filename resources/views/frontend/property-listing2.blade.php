@extends('layouts.main-layout')

@section('title')
    Property Listing
@endsection

@section('meta-title')
    Property Listing
@endsection

@section('meta-keywords')
    Property Listing
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="css/custom/leftbar-list.css">
@endsection
@section('main-content')
    <section class="single-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>Property Listing</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Property Listing</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ad-list-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-filter">
                        <div class="product-page-number">
                            <p>Showing 1–9 of 130 results</p>
                        </div>
                        <select class="product-short-select custom-select">
                            <option selected>Short by Best Sell</option>
                            <option value="1">Short by New Item</option>
                            <option value="2">Short by Popularity</option>
                            <option value="3">Short by Average review</option>
                        </select>
                        <ul class="product-card-type">
                            <li class="grid-hori">
                                <i class="fas fa-grip-horizontal"></i>
                            </li>
                            <li class="grid-verti active">
                                <i class="fas fa-grip-vertical"></i>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row content-reverse">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="product-sidebar">
                                <div class="product-sidebar-title">
                                    <h6>Filter by Price</h6>
                                </div>
                                <div class="product-sidebar-content">
                                    <div class="price-range">
                                        <input type="text" id="amount" readonly>
                                        <div id="slider-range"></div>
                                    </div>
                                    <button type="button" class="product-filter-btn">
                                        <i class="fas fa-search"></i>
                                        <span>search</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-sidebar">
                                <div class="product-sidebar-title">
                                    <h6>Filter by Location</h6>
                                </div>
                                <div class="product-sidebar-content">
                                    <ul class="nasted-dropdown">
                                        @foreach($locations as $location)
                                            <li>
                                                <div class="nasted-menu">
                                                    <p>
                                                        <span class="fas fa-tags"></span>{{$location->location_name ?? ''}}
                                                    </p>
                                                    @if( count($location->getLocationAreas) > 0 )
                                                    <i class="fas fa-chevron-down"></i>
                                                    @endif
                                                </div>
                                                @if( count($location->getLocationAreas) > 0 )
                                                    <ul class="nasted-menu-list">
                                                        @foreach($location->getLocationAreas as $area)
                                                            <li>
                                                                <a href="#">{{$area->area_name ?? ''}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @if(count($properties) > 0 )
                            @foreach($properties as $property)
                                <div class="col-sm-6 col-md-4 col-lg-4 card-grid">
                                    <div class="product-card">
                                        <div class="product-head">
                                            <div class="product-img" style="background:url(/assets/images/property/interior/{{$property->getFeaturedInteriorImage->directory}}) no-repeat center; background-size:cover;">
                                                <span class="flat-badge rent">
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
                                </div>
                            @endforeach
                        @else
                            <h4>There're currently no vacant properties.</h4>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link active" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">...</li>
                                <li class="page-item">
                                    <a class="page-link" href="#">67</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('extra-scripts')
    <script src="/js/custom/price-range.js"></script>
@endsection
