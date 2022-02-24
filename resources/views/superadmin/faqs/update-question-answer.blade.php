@extends('layouts.master-layout')
@section('title')
    Update FAQs
@endsection

@section('current-page')
    Update FAQs
@endsection
@section('current-page-brief')

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
    <form action="{{route('update-faq')}}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-lg-8 col-md-8 col-sm-12">
                @if(session()->has('success'))
                    <div class="alert alert-success background-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-warning background-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('error') !!}
                    </div>
                @endif
                <div class="card">
                    <div class="card-block">
                        <div class="sub-title">Add New FAQs</div>
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Question</label>
                                                <input type="text" name="question" placeholder="Question" value="{{old('question', $faq->question)}}" class="form-control">
                                                @error('question')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                                <input type="hidden" name="faq" value="{{$faq->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Answer</label>
                                                <textarea name="answer" id="answer" class="content form-control" placeholder="Type answer here...">{{old('answer', $faq->answer)}}</textarea>
                                                @error('answer')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a href="{{url()->previous()}}" class="btn btn-secondary btn-mini">Cancel</a>
                                                <button type="submit" class="btn btn-mini btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection

@section('extra-scripts')

    <script type="text/javascript" src="/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/bower_components/tinymce.js"></script>

@endsection
