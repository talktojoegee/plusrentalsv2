@extends('layouts.master-layout')
@section('title')
    Profile
@endsection

@section('current-page')

@endsection
@section('current-page-brief')

@endsection

@section('event-area')

@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="cover-profile">
                <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" style="height: 350px !important; " src="\assets\images\bg-img1.jpg" alt="bg-img">
                    <div class="card-block user-info">
                        <div class="col-md-12">
                            <div class="media-left">
                                <a href="#" class="profile-image">
                                    <img class="user-img img-radius" height="180" width="180" src="\assets\drive\{{$user->avatar ?? 'avatar.png'}}" alt="{{$user->first_name ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body row">
                                <div class="col-lg-12">
                                    <div class="user-title">
                                        <h2>{{$user->first_name ?? '' }} {{$user->surname ?? '' }}</h2>
                                        <span class="text-white">{{$user->position ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('success'))<div class="alert alert-success background-success">
                {!! session()->get('success') !!}
            </div> @endif
            <div class="tab-header card">
                <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>
                        <div class="slide"></div>
                    </li>
                    @if($user->id == Auth::user()->id)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#security" role="tab">Security</a>
                        <div class="slide"></div>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="personal" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Personal Info</h5>
                        </div>
                        <div class="card-block">
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">Full Name</th>
                                                                <td>{{$user->first_name ?? '' }} {{$user->surname ?? '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Member Since</th>
                                                                <td>{{date('d M, Y', strtotime($user->created_at)) ?? '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Address</th>
                                                                <td>{{$user->address ?? '' }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">Email</th>
                                                                <td>{{$user->email ?? '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Mobile Number</th>
                                                                <td>{{$user->mobile_no ?? '' }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->id == $user->id)
                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Settings</h5>
                        </div>
                        <div class="card-block">
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                    <form action="{{route('update-manager-profile')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">First Name</label>
                                                                    <input type="text" name="first_name" placeholder="First Name" value="{{old('first_name', $user->first_name)}}" class="form-control">
                                                                    @error('first_name') <i class="text-danger">{{$message}}</i> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Surname</label>
                                                                    <input type="text" name="surname" placeholder="Surname" value="{{old('surname', $user->surname)}}" class="form-control">
                                                                    @error('surname') <i class="text-danger">{{$message}}</i> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Mobile No.</label>
                                                                    <input type="text" name="mobile_no" placeholder="Mobile No." value="{{old('mobile_no', $user->mobile_no)}}" class="form-control">
                                                                    @error('mobile_no') <i class="text-danger">{{$message}}</i> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Position</label>
                                                                    <input type="text" name="position" placeholder="Position" value="{{old('position', $user->position)}}" class="form-control">
                                                                    @error('position') <i class="text-danger">{{$message}}</i> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Address</label>
                                                                    <textarea name="address" id="address"
                                                                              class="form-control" placeholder="Address" style="resize: none">{{old('address', $user->address)}}</textarea>
                                                                    @error('address') <i class="text-danger">{{$message}}</i> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Avatar</label>
                                                                    <input type="file" name="avatar" class="form-control-file">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group d-flex justify-content-center">
                                                                    <input type="hidden" value="{{$user->id}}" name="user">
                                                                    <button class="btn-primary btn-mini btn" type="submit">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="security" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Security</h5>
                        </div>
                        <div class="card-block">
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                    <form action="{{route('change-manager-password')}}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Current Password</label>
                                                                    <input type="password" name="current_password" placeholder="Current Password"  class="form-control">
                                                                    @error('current') <i class="text-danger">{{$message}}</i> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">New Password</label>
                                                                    <input type="password" name="password" placeholder="New Password"  class="form-control">
                                                                    @error('password') <i class="text-danger">{{$message}}</i> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Re-type Password</label>
                                                                    <input type="password" placeholder="Re-type Password" name="password_confirmation" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group d-flex justify-content-center">
                                                                    <input type="hidden" value="{{$user->id}}" name="user">
                                                                    <button class="btn-primary btn-mini btn" type="submit">Change password</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')

@endsection
