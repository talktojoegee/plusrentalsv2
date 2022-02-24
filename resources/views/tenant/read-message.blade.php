@extends('layouts.master-layout')

@section('title')
    Message
@endsection

@section('meta-title')
    Message
@endsection

@section('meta-keywords')
    Message
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/rightbar-details.css">
    <link rel="stylesheet" href="/css/custom/bookmark.css">
@endsection
@section('main-content')
    <section class="ad-details-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>Message</h5>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 card-grid col-sm-12 col-md-12 col-lg-12">
                            <div class="product-card inline">
                                <div class="product-head">
                                    <div class="dash-avatar">
                                            <a href="#">
                                                <img src="/attachments/avatar/{{$message->getFrom->avatar ?? 'avatar.png'}}" alt="avatar">
                                            </a>
                                        </div>
                                </div>
                                <div class="product-info">
                                    <div class="product-tag">
                                        <i class="fa fa-clock-o"></i>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="javascript:void(0);">{{date('d F, Y h:ia', strtotime($message->created_at))}}</a>
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="product-title">
                                            {!! $message->message !!}
                                        <ul class="product-location">
                                            <li>
                                                <i class="fas fa-clock"></i>
                                                <p>{{$message->created_at->diffForHumans()}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>Replies ({{number_format(count($message->getMessageReplies))}})</h5>
                        </div>
                        <div class="ad-details-review">
                            <ul class="review-list">
                                @foreach ($message->getMessageReplies as $reply)

                                <li class="review-item">
                                        @if($reply->from_id != Auth::user()->id)
                                        <div class="review">
                                            <div class="review-head">
                                                <div class="review-author">
                                                    <div class="review-avatar">
                                                        <a href="#">
                                                            <img src="/attachments/avatar/{{$reply->getRepliedBy->avatar ?? 'avatar.png'}}" alt="review">
                                                        </a>
                                                    </div>
                                                    <div class="review-meta">
                                                        <h6>
                                                            <a href="#">{{$reply->getRepliedBy->first_name ?? ''}} {{$reply->getRepliedBy->surname ?? ''}} - </a>
                                                            <span>{{date('d F, Y h:ia', strtotime($reply->created_at))}}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-content">
                                               {!! $reply->reply !!}
                                            </div>
                                        </div>
                                        @endif
                                        @if($reply->from_id == Auth::user()->id)
                                        <div class="review">
                                            <div class="review-head">
                                                <div class="review-author">
                                                    <div class="review-avatar">
                                                        <a href="#">
                                                            <img src="/attachments/avatar/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="review">
                                                        </a>
                                                    </div>
                                                    <div class="review-meta">
                                                        <h6>
                                                            <a href="#">{{$reply->getRepliedBy->first_name ?? ''}} {{$reply->getRepliedBy->surname ?? ''}}</a>
                                                        </h6>
                                                        <h6>Seller -
                                                            <span>{{date('d F, Y h:ia', strtotime($reply->created_at))}}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-content">
                                                 {!! $reply->reply !!}
                                            </div>
                                        </div>
                                        @endif
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
                           <div class="ad-details-title">
                                <h5>Reply Message</h5>
                            </div>
                                <form class="ad-review-form" method="post" action="{{route('reply-message')}}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Reply message..." name="reply"  style="resize: none;"></textarea>
                                        @error('reply')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="message" value="{{$message->id}}">
                                    <button class="btn btn-inline" type="submit">
                                        <i class="fas fa-tint"></i>
                                        <span>Reply</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
