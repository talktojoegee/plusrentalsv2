@extends('layouts.master-layout')
@section('title')
    Add New User
@endsection

@section('current-page')
    Add New User
@endsection
@section('current-page-brief')
    Add New User
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-primary btn-mini" href="{{route('manage-users')}}"><i class="icofont icofont-tags"></i>Manage Users</a>
        <a class="btn btn-secondary btn-mini" href="{{route('add-new-user')}}"><i class="icofont icofont-tags"></i>Add New User</a>
        <a class="btn btn-danger btn-mini" href=""><i class="icofont icofont-megaphone"></i>Reports</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">

@endsection
@section('main-content')
    <div class="row" >
        <div class="col-lg-8  col-xl-8 col-md-8 offset-md-2 offset-xl-2 offset-lg-2">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Add New User</h5>
                    <p><strong class="text-danger">Note:</strong> A random password will be generated and sent to this user via email.</p>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form action="{{route('add-new-user')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" placeholder="First Name" value="{{old('first_name')}}" name="first_name" class="form-control">
                                    @error('first_name')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Surname</label>
                                    <input type="text" placeholder="Surname" value="{{old('surname')}}" name="surname" class="form-control">
                                    @error('surname')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                          <div class="row">
                              <div class="col-md-6 col-lg-6">
                                  <div class="form-group">
                                      <label for="">Email Address</label>
                                      <input type="email" placeholder="Email Address" value="{{old('email')}}" name="email" class="form-control">
                                      @error('email')
                                      <i class="text-danger mr-2">{{$message}}</i>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-md-6 col-lg-6">
                                  <div class="form-group">
                                      <label for="">Mobile No.</label>
                                      <input type="text" placeholder="Mobile No." value="{{old('mobile_no')}}" name="mobile_no" class="form-control">
                                      @error('mobile_no')
                                      <i class="text-danger mr-2">{{$message}}</i>
                                      @enderror
                                  </div>
                              </div>
                          </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" id="address" style="resize: none;" class="form-control">{{old('address')}}</textarea>
                                    @error('address')
                                        <i class="text-danger mt-2">{{$message}}</i>
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
    </div>
@endsection


@section('extra-scripts')

@endsection
