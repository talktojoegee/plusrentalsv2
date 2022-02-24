@extends('layouts.master-layout')
@section('title')
    New Email Template
@endsection

@section('current-page')
    New Email Template
@endsection
@section('current-page-brief')
    New Email Template
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-primary btn-mini" href="{{route('compose-email')}}"><i class="icofont icofont-tags"></i>Compose Email</a>
        <a class="btn btn-secondary btn-mini" href="{{route('manage-email-templates')}}"><i class="icofont icofont-tags"></i>Manage Email Templates</a>
        <a class="btn btn-warning btn-mini" href="{{route('new-email-template')}}"><i class="icofont icofont-tasks"></i>Add New Email Template</a>
        <a class="btn btn-danger btn-mini" href=""><i class="icofont icofont-megaphone"></i>Reports</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">

@endsection
@section('main-content')
    <div class="row" >
        <div class="col-lg-8  col-xl-8 col-md-8">

            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">New Email Template</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form action="{{route('new-email-template')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Template Name</label>
                                    <input type="text" placeholder="Template Name" value="{{old('template_name')}}" name="template_name" class="form-control">
                                    @error('template_name')
                                        <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" placeholder="Subject" value="{{old('subject')}}" name="subject" class="form-control">
                                    @error('subject')
                                        <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Body</label>
                                    <textarea name="body" id="body" placeholder="Body" class="form-control content">{{old('body')}}</textarea>
                                    @error('body')
                                        <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Cancel</a>
                                    <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4  col-xl-4 col-md-4">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Keywords</h5>
                    <p>Use the keywords in curly braces...</p>
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                            <tr>
                                <th scope="row">{firstName}</th>
                                <td>Someone's first name</td>
                            </tr>
                            <tr>
                                <th scope="row">{surname}</th>
                                <td>Someone's surname</td>
                            </tr>
                            <tr>
                                <th scope="row">{emailAddress}</th>
                                <td>Someone's email address</td>
                            </tr>
                            <tr>
                                <th scope="row">{mobileNo}</th>
                                <td>Someone's mobile number.</td>
                            </tr>
                            <tr>
                                <th scope="row">{startDate}</th>
                                <td>Rent/lease or event start date.</td>
                            </tr>
                            <tr>
                                <th scope="row">{endDate}</th>
                                <td>Rent/lease or event end date.</td>
                            </tr>
                            <tr>
                                <th scope="row">{address}</th>
                                <td>Someone's residential/office address.</td>
                            </tr>
                              <tr>
                                <th scope="row">{amount}</th>
                                <td>It could be rent or any financial amount.</td>
                            </tr>
                            <tr>
                                <th scope="row">{paymentMethod}</th>
                                <td>Payment method (e.g cash, bank transfer, etc).</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra-scripts')
    <script type="text/javascript" src="/js/custom/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/custom/tinymce.js"></script>
@endsection
