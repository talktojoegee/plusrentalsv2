@extends('layouts.tenant-layout')

@section('title')
    Maintenance Detail
@endsection

@section('meta-title')
    Maintenance Detail
@endsection

@section('meta-keywords')
    Maintenance Detail
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/rightbar-details.css">
    <link rel="stylesheet" href="/css/custom/profile.css">
@endsection
@section('current-page')
    Maintenance <span class="text-white">{{$task->title ?? ''}}</span>
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
    @include('tenant.partials._dash-header2')
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
                        <div class="ad-details-title">
                            <h5>Conversation</h5>
                        </div>
                        <div class="pull-right">
                            <a href="{{url()->current()}}/#reply">Reply</a>
                        </div>
                        <div class="ad-details-review">
                            <ul class="review-list">
                                <li class="review-item">
                                    <div class="review">
                                        <div class="review-head">
                                            <div class="review-author">
                                                <div class="review-avatar">
                                                    <a href="#">
                                                        <img src="/images/avatar/{{$task->getTenant->avatar ?? 'avatar.png'}}" alt="{{$task->getTenant->getApplicant->first_name ?? ''}}">
                                                    </a>
                                                </div>
                                                <div class="review-meta">
                                                    <h6><a href="javascript:void(0);">{{$task->getTenant->getApplicant->first_name ?? ''}} {{$task->getTenant->getApplicant->surname ?? ''}} - </a><span>{{!is_null($task->created_at) ? date('d M, Y', strtotime($task->created_at)) : '-'}}</span></h6>
                                                    <ul>
                                                        <li><h5>{{$task->title ?? ''}}</h5></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            {!! $task->description ?? '' !!}
                                        </div>
                                    </div>
                                    @foreach($task->getTaskFrontendConversations as $conversation)
                                        <div class="review">
                                            <div class="review-head">
                                                <div class="review-author">
                                                    <div class="review-avatar">
                                                        <a href="#"><img src="/images/avatar/04.jpg" alt="review"></a>
                                                    </div>
                                                    <div class="review-meta">
                                                        <h6><a href="javascript:void(0);">{{$conversation->getUser->first_name .' '.$conversation->getUser->surname ?? Auth::user()->getApplicant->first_name .' '.Auth::user()->getApplicant->surname  }}</a></h6>
                                                        <h6>{{$conversation->getUser->id == Auth::user()->id ? 'Author' : 'Tenant' }} - <span>{{!is_null($conversation->created_at) ? date('d M, Y', strtotime($conversation->created_at)) : '-' }}</span></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-content">
                                                {!! $conversation->message !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                            <form class="ad-review-form" method="post" action="{{route('maintenance-leave-comment')}}" id="reply">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" placeholder="What's on your mind?">{{old('comment')}}</textarea>
                                    @error('comment')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <input type="hidden" name="task" value="{{$task->id}}">
                                <button class="btn btn-inline" type="submit"><i class="fas fa-tint"></i><span>Leave comment</span></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ad-details-card">
                        <div class="ad-details-title">
                            <h5>Realtor</h5>
                        </div>
                        <div class="ad-details-profile">
                            <div class="author-img">
                                <a href="#">
                                    <img src="/images/avatar/{{$task->getProperty->getRentalOwner->avatar ?? 'avatar.png'}}" alt="{{config('app.name')}}">
                                </a>
                            </div>
                            <div class="author-intro">
                                <h4>
                                    <a href="#">{{$task->getProperty->getRentalOwner->ownership_type == 1 ? $task->getProperty->getRentalOwner->first_name .' '.$task->getProperty->getRentalOwner->surname : $task->getProperty->getRentalOwner->company_name }} </a>
                                </h4>
                            </div>
                            <hr>
                            <ul class="author-widget">
                                <li>
                                    <a href="tel:$property->getRentalOwner->mobile_no ?? '' }}">
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
                </div>
            </div>
        </div>
    </section>
@endsection
@section('extra-scripts')
    <script src="/js/custom/price-range.js"></script>
@endsection
