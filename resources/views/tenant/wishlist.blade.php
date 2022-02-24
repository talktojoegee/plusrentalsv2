@extends('layouts.master-layout')

@section('title')
    Wishlist
@endsection

@section('meta-title')
    Wishlist
@endsection

@section('meta-keywords')
    Wishlist
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/bookmark.css">
@endsection
@section('current-page')
    Watchlist
@endsection
@section('breadcrumb')
    @include('partials._breadcrumb')
@endsection
@section('main-content')
    @include('customer.partials._dash-header')
    <section class="bookmark-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-filter">
                        <div class="product-page-number">
                            <p>My Watchlist</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @if (count($watchlist) > 0)
                    @foreach ($watchlist as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3 card-grid">
                            <div class="product-card">
                                <div class="product-head">
                                    <div class="product-img" style="background:url(/attachments/featured-images/{{$item->getAdvert->featured_image}}) no-repeat center; background-size:cover;">

                                        <span class="flat-badge rent">{{$item->getAdvert->getCategory->category_name ?? ''}}</span>

                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="product-tag">
                                        <i class="fas fa-tags"></i>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="#">{{$item->getAdvert->getCategory->category_name ?? ''}}</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{$item->getAdvert->getSubCategory->sub_category_name ?? ''}}</li>
                                        </ol>
                                    </div>
                                    <div class="product-title">
                                        <h5>
                                            <a href="{{route('view-advert', $item->getAdvert->slug)}}">{{strlen($item->getAdvert->title) > 17 ? substr($item->getAdvert->title,0,17).'...' : $item->getAdvert->title  }}</a>
                                        </h5>
                                        <ul class="product-location">
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>
                                                <p>{{$item->getAdvert->getLocation->location_name ?? ''}}</p>
                                            </li>
                                            <li>
                                                <i class="fas fa-clock"></i>
                                                <p>{{$item->getAdvert->created_at->diffForHumans()}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-details">
                                        <div class="product-price">
                                            <h5>{{'₦'.number_format($item->getAdvert->price,2)}}</h5>
                                            <span>/@if($item->getAdvert->price_type == 0) Negotiable @else Fixed @endif</span>
                                        </div>
                                        <ul class="product-widget">
                                            <li>
                                                <button class="tooltip addToWishlist" data-product="{{$item->getAdvert->id}}">



                                                        <i class="far fa-heart fas"></i>

                                                    <span class="tooltext top">Watchlist</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 p-3 ">
                        <p class="text-center">
                            You currently do not have any ads in your watchlist.
                        </p>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{url()->previous()}}" class="btn btn-inline">
                                <i class="fas fa-backward"></i>
                                <span>Go Back</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {{$watchlist->links('vendors.pagination.default')}}
                </div>
            </div>
        </div>
    </section>
@endsection
