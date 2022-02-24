@extends('layouts.master-layout')
@section('title')
    Email Settings
@endsection

@section('current-page')
    Email Settings
@endsection
@section('current-page-brief')
    Email Settings
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
        <div class="col-lg-10 offset-lg-1 offset-xl-1  col-xl-10 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Email Settings</h5>
                    <form action="">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="email" placeholder="Email Address" name="email_address" class="form-control">
                                    @error('email_address')
                                        <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" placeholder="Password" name="password" class="form-control">
                                    @error('password')
                                        <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 d-flex justify-content-center">
            <div class="card mt-3">
                <div class="card-block">
                    <div class="btn-group">
                        <a href="{{url()->previous()}}" class="btn btn-mini btn-warning"><i class="icofont icofont-square-left mr-2"></i> Back</a>
                        <button class="btn btn-mini btn-primary" id="printReceiptBtn"><i class="ti-printer mr-2"></i> Print</button>
                        <button class="btn btn-secondary btn-mini"><i class="icofont icofont-ui-email mr-2"></i> Email</button>

                            <a href="#" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Decline Receipt</a>
                            <a href="#" class="btn btn-success btn-mini"><i class="ti-check mr-2"></i> Approve Receipt</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra-scripts')

@endsection
