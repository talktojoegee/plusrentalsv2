@extends('layouts.master-layout')

@section('title')
    My Adverts
@endsection

@section('meta-title')
    My Adverts
@endsection

@section('meta-keywords')
    My Adverts
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/bookmark.css">
@endsection
@section('current-page')
    My Adverts
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
                <div class="product-filter d-flex justify-content-end">
                    <ul class="product-card-type">
                        <li class="grid-verti active">
                            <i class="fas fa-grip-vertical"></i>
                        </li>
                        <li class="grid-hori">
                            <i class="fas fa-grip-horizontal"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            @if (count($my_ads) > 0)
                @foreach ($my_ads as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3 card-grid">
                        <div class="product-card">
                            <div class="product-head">
                                <div class="product-img" style="background:url(/attachments/featured-images/{{$item->featured_image ?? ''}}) no-repeat center; background-size:cover;">
                                    <i class="cross-badge fas fa-bolt"></i>
                                    <span class="flat-badge rent">{{$item->getCategory->category_name ?? ''}}</span>
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
                                            <a href="javascript:void(0);">{{$item->getCategory->category_name ?? ''}}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">{{$item->getSubCategory->sub_category_name ?? ''}}</li>
                                    </ol>
                                </div>
                                <div class="product-title">
                                    <h5>
                                        <a href="{{route('my-advert-detail', $item->slug)}}">{{strlen($item->title) > 51 ? substr($item->title,0,51).'...' : $item->title }}</a>
                                    </h5>
                                    <ul class="product-location">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <p>{{$item->getLocation->location_name ?? ''}}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <p>{{$item->created_at->diffForHumans()}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-details">
                                    <div class="product-price">
                                        <h5>{{'₦'.number_format($item->price,2)}}</h5>
                                        <span>/Negotiable</span>
                                    </div>
                                    <ul class="product-widget">
                                        <li>
                                            <button class="tooltip">
                                                <i class="fas fa-heart"></i>
                                                <span class="tooltext top">wishlist</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 col-xl-12 col-sm-12">
                    <p>Start advertising. You currently have no ads running</p>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="pagination">
                    {{$my_ads->links()}}
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
