@extends('layouts.master-layout')
@section('title')
    Manage FAQs
@endsection

@section('current-page')
    Manage FAQs
@endsection
@section('current-page-brief')
    Manage all FAQs
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('manage-faqs')}}"><i class="icofont icofont-tags"></i>Manage FAQs</a>
        <a class="btn btn-primary btn-mini" href="{{route('add-new-question-answer')}}"><i class="icofont icofont-tasks"></i>Add New FAQs</a>
    </div>
@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Frequently Asked Questions</h5>
                </div>
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        @php $serial = 1; @endphp
                        @foreach($faqs as $faq)
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="heading_{{$faq->id}}">
                                <h3 class="card-title accordion-title">
                                    <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$faq->id}}" aria-expanded="false" aria-controls="collapseOne">
                                        <label for="" class="badge badge-danger">{{$serial++}}</label> {{$faq->question}}
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse_{{$faq->id}}" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="heading_{{$faq->id}}" style="">
                                <div class="accordion-content accordion-desc">
                                    {!! $faq->answer ?? '' !!}
                                    <hr>
                                   <p class="text-center"> <a href="{{route('update-question-answer', $faq->id)}}" ><i class="ti-pencil text-warning"></i> Edit</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')

@endsection
