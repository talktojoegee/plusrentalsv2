@extends('layouts.master-layout')

@section('title')
    My Advert > {{$my_ad->title ?? ''}}
@endsection

@section('meta-title')
    My Advert > {{$my_ad->title ?? ''}}
@endsection

@section('meta-keywords')
    My Advert > {{$my_ad->title ?? ''}}
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/rightbar-details.css">
@endsection
@section('main-content')
        <section class="ad-details-part">
            <div class="container">
                <div class="row">
                    @if(session()->has('message-success'))
                    <div class="col-md-12 mt-4">
                        <div class="alert alert-success">
                            {!! session()->get('message-success') !!}
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-8">
                        <div class="ad-details-card">
                            <div class="ad-details-breadcrumb">
                                <ol class="breadcrumb">
                                    <li>
                                        <span class="flat-badge sale">@if($my_ad->ad_type == 0) Sales @else Promo @endif</span>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0);">{{$my_ad->getCategory->category_name ?? ''}}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$my_ad->getSubCategory->sub_category_name ?? ''}}</li>
                                </ol>
                            </div>
                            <div class="ad-details-heading">
                                <h2>
                                    <a href="{{url()->current()}}">{{$my_ad->title ?? ''}}</a>
                                </h2>
                            </div>
                            <ul class="ad-details-meta">
                                <li>
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                        <p>Views
                                            <span>({{number_format(count($my_ad->getViews))}})</span>
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-star"></i>
                                        <p>review
                                            <span>({{number_format(count($my_ad->getAdvertReviews))}})</span>
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-heart"></i>
                                        <p>Watchlist
                                            <span>({{number_format(count($my_ad->getWatchlist))}})</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <div class="ad-details-slider slider-arrow">
                                @foreach ($my_ad->getGalleryImages as $item)
                                    <div>
                                        <img src="/attachments/product-gallery/{{$item->directory ?? ''}}" alt="{{$my_ad->title}}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="ad-thumb-slider">
                                @foreach ($my_ad->getGalleryImages as $image)
                                    <div>
                                        <img src="/attachments/product-gallery/{{$image->directory ?? ''}}" alt="{{$my_ad->title ?? ''}}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="ad-details-action">
                                <ul>
                                    <li>
                                        <button type="button">
                                            <i class="fas fa-heart"></i>
                                            <span>Watchlist</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <span>report</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="ad-details-card">
                            <div class="ad-details-title">
                                <h5>Specification</h5>
                            </div>
                            <div class="ad-details-specific">
                                <ul>
                                    <li>
                                        <h6>price:</h6>
                                        <p>{{'₦'.number_format($my_ad->price,2)}}</p>
                                    </li>
                                    <li>
                                        <h6>seller type:</h6>
                                        <p>personal</p>
                                    </li>
                                    <li>
                                        <h6>published:</h6>
                                        <p>{{date('d F,Y', strtotime($my_ad->created_at))}}</p>
                                    </li>
                                    <li>
                                        <h6>location:</h6>
                                        <p>{{$my_ad->getLocation->location_name ?? ''}}</p>
                                    </li>
                                    <li>
                                        <h6>category:</h6>
                                        <p>{{$my_ad->getCategory->category_name ?? ''}}</p>
                                    </li>
                                    <li>
                                        <h6>condition:</h6>
                                        <p>@if($my_ad->product_condition == 0) Used @else New @endif</p>
                                    </li>
                                    <li>
                                        <h6>price type:</h6>
                                       <p>@if($my_ad->price_type == 0) Negotiable @else Fixed @endif</p>
                                    </li>
                                    <li>
                                        <h6>ad type:</h6>
                                        <p>@if($my_ad->ad_type == 0) Sales @else Promo @endif</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="ad-details-card">
                            <div class="ad-details-title">
                                <h5>description</h5>
                            </div>
                            <div class="ad-details-descrip">
                                {!! $my_ad->description ?? '' !!}
                            </div>
                        </div>
                        <div class="ad-details-card">
                            <div class="ad-details-title">
                                <h5>reviews ({{number_format(count($my_ad->getAdvertReviews))}})</h5>
                            </div>
                            <div class="ad-details-review">
                                <ul class="review-list">
                                    @foreach ($my_ad->getAdvertReviews as $review)
                                        <li class="review-item">
                                            <div class="review">
                                                <div class="review-head">
                                                    <div class="review-author">
                                                        <div class="review-avatar">
                                                            <a href="#">
                                                                <img src="/images/avatar/03.jpg" alt="review">
                                                            </a>
                                                        </div>
                                                        <div class="review-meta">
                                                            <h6>
                                                                <a href="#">{{$review->getCustomer->first_name ?? ''}} {{$review->getCustomer->surname ?? ''}}</a>-
                                                                <span>{{date('d F, Y h:ia', strtotime($review->created_at))}}</span>
                                                            </h6>
                                                            <ul>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <li>
                                                                        <i class="fas fa-star {{$review->rating >= $i ? 'active' : ''}}"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-content">
                                                    {{$review->content ?? ''}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                               <div class="col-md-12 mt-4">
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">
                                            {!! session()->get('success') !!}
                                        </div>
                                    @endif
                                </div>
                                @if(Auth::check())
                                    <form class="ad-review-form" method="post" action="{{route('drop-review')}}">
                                        @csrf

                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Full name" value="{{Auth::user()->first_name}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" readonly>
                                            </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Describe" name="review" placeholder="Type review here..." style="resize: none;"></textarea>
                                            @error('review')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                        <div class="star-rating">
                                            <input type="radio" name="rating" value="5" id="star-5">
                                            <label for="star-5"></label>

                                            <input type="radio" name="rating" value="4" id="star-4">
                                            <label for="star-4"></label>

                                            <input type="radio" name="rating" value="3" id="star-3">
                                            <label for="star-3"></label>

                                            <input type="radio" name="rating" value="2" id="star-2">
                                            <label for="star-2"></label>

                                            <input type="radio" name="rating" value="1" id="star-1">
                                            <label for="star-1"></label>
                                        </div>
                                        @error('rating')
                                            <i class="text-danger text-center">{{$message}}</i>
                                        @enderror
                                        <input type="hidden" name="advert" value="{{$my_ad->id}}">
                                        <button class="btn btn-inline" type="submit">
                                            <i class="fas fa-tint"></i>
                                            <span>drop your review</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ad-details-price">
                            <h5>{{'₦'.number_format($my_ad->price,2)}}</h5>
                            <span>/@if($my_ad->price_type == 0) Negotiable @else Fixed @endif</span>
                            <i class="flaticon-bargain"></i>
                        </div>
                        <button class="ad-details-number">
                            <i class="fas fa-phone-alt"></i>
                            <span>Click to show the number</span>
                        </button>
                        <div class="ad-details-card">
                            <div class="ad-details-title">
                                <h5>author info</h5>
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
                                        <a href="#">{{$my_ad->getCustomer->first_name ?? ''}} {{$my_ad->getCustomer->surname ?? ''}}</a>
                                    </h4>
                                    {{$my_ad->getCustomer->about ?? ''}}
                                </div>
                                <ul class="author-widget">
                                    <li>
                                        <a href="tel:{{$my_ad->getCustomer->company_phone ?? $my_ad->getCustomer->phone_no }}">
                                            <i class="fas fa-phone-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"  data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="favourite-seller">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="author-list">
                                    <li>
                                        <h6>total ads</h6>
                                        <p>{{number_format(count($my_ad->getCustomer->getCustomerAdverts))}}</p>
                                    </li>
                                    <li>
                                        <h6>total Reviews</h6>
                                        <p>{{number_format(count($total_reviews))}}</p>
                                    </li>

                                </ul>
                                <div class="author-details">
                                    <h6>Member since: {{date('d F, Y', strtotime($my_ad->getCustomer->created_at))}}</h6>
                                    <h6>address:{{$my_ad->getCustomer->address ?? $my_ad->getCustomer->company_address }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="ad-details-card">
                            <div class="ad-details-title">
                                <h5>safety tips</h5>
                            </div>
                            <div class="ad-details-safety">
                                <ul>
                                    <li>
                                        <i class="fas fa-dot-circle"></i>
                                        <p>Check the item before you buy</p>
                                    </li>
                                    <li>
                                        <i class="fas fa-dot-circle"></i>
                                        <p>Pay only after collecting item</p>
                                    </li>
                                    <li>
                                        <i class="fas fa-dot-circle"></i>
                                        <p>Beware of unrealistic offers</p>
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
                            <h2>Our Related
                                <span>Ads</span>
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
        <h5 class="modal-title" id="exampleModalLabel">Message {{$my_ad->getCustomer->first_name ?? ''}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="ad-review-form" method="post" action="{{route('message-seller')}}">
            @csrf
            <div class="form-group">
                <textarea class="form-control" placeholder="Type message here..." name="message" style="resize: none;"></textarea>
            </div>
            <input type="hidden" name="to" value="{{$my_ad->customer_id}}">
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
