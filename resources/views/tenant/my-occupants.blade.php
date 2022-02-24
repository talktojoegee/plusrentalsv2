@extends('layouts.main-layout')
@section('title')
    {{Auth::user()->getProperty->property_name ?? ''}}'s Occupants
@endsection
@section('meta-keywords')
    Real estate, smart homes, property listing, properties, rent payment, tenant portal,
@endsection
@section('meta-description')
    is a property manage...
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/datatable.min.css">
    <style>
        .dataTables_wrapper .dataTables_filter input{
            height: 30px!important;
            width: 150px !important;
        }
        .dataTables_wrapper .dataTables_length select{
            height: 30px;
        }
    </style>
@endsection

@section('main-content')
    <div class="parallax titlebar" data-background="/images2/listings-parallax.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505" style="background-image: url(&quot;/images2/listings-parallax.jpg&quot;); background-attachment: fixed; background-size: 1519px 958.869px; background-position: 50% -532.7px;"><div class="parallax-overlay" style="background-color: rgb(48, 48, 48); opacity: 0.8;"></div>
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('profile')}}">Home</a></li>
                                <li>{{Auth::user()->getProperty->property_name ?? ''}}'s Occupants</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @include('tenant.partials._dashboard-sidebar')
            <div class="col-md-9 widget utf-sidebar-widget-item">
                    @if(session()->has('success'))

                        <div class="notification success closeable">
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                        <div class="utf-inner-list-headline-item">
                            <h3>Occupants</h3>
                        </div>
                    <div class="card">
                        <div class="" style="">
                            <a class="button float-right" title="Add New Occupant" href="{{route('add-new-occupant')}}"><i class="icon-feather-plus"></i> Add New Occupant</a>
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        <th>Relationship</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach(Auth::user()->getTenantOccupants as $occupant)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td>{{$occupant->title ?? ''}} {{$occupant->first_name ?? ''}} {{$occupant->last_name ?? ''}}</td>
                                            <td>{{$occupant->email ?? ''}}</td>
                                            <td>{{$occupant->mobile_no ?? ''}}</td>
                                            <td>{{$occupant->relationship ?? ''}}</td>
                                            <td>{{!is_null($occupant->created_at) ? date('d M, Y', strtotime($occupant->created_at)) : ''}}</td>
                                            <td>
                                                <div class="account-title">
                                                    <a  class="popup-with-zoom-anim log-in-button sign-in" href="#occupantModal_{{$occupant->id}}">
                                                        <i class="sl sl-icon-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="zoom-anim-dialog mfp-hide dialog-with-tabs" style="width: 600px; margin: 10px auto 0px auto;" id="occupantModal_{{$occupant->id}}" >
                                                    <div class="utf-signin-form-part" style="background: white;">
                                                        <div class="utf-popup-container-part-tabs">
                                                            <div class="utf-popup-tab-content-item">
                                                                <div class="utf-welcome-text-item">
                                                                    <h3>Occupant Details</h3>
                                                                </div>
                                                                <form action="{{route('update-occupant')}}" method="post">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="">Title <small>(Optional)</small></label>
                                                                                <input type="text" placeholder="Title" name="title" value="{{old('title',$occupant->title)}}" class="form-control">
                                                                                @error('title')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="">First Name</label>
                                                                                <input type="text" placeholder="First Name" name="first_name" value="{{old('first_name',$occupant->first_name)}}" class="form-control">
                                                                                @error('first_name')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="">Surname</label>
                                                                                <input type="text" placeholder="Surname" name="surname" value="{{old('surname',$occupant->last_name)}}" class="form-control">
                                                                                @error('surname')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="">Birth Date <small>(Optional)</small></label>
                                                                                <input type="date" placeholder="Birth Date" name="birth_date" value="{{old('birth_date',$occupant->birth_date)}}" class="form-control">
                                                                                @error('birth_date')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="">Email Address <small>(Optional)</small></label>
                                                                                <input type="email" placeholder="Email Address" name="email" value="{{old('email',$occupant->email)}}" class="form-control">
                                                                                @error('email')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="">Mobile No.</label>
                                                                                <input type="text" placeholder="Mobile No." name="mobile_no" value="{{old('mobile_no',$occupant->mobile_no)}}" class="form-control">
                                                                                @error('mobile_no')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Relationship</label>
                                                                                <input type="text" placeholder="Relationship" name="relationship" value="{{old('relationship',$occupant->relationship)}}" class="form-control">
                                                                                @error('relationship')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="">Comment</label>
                                                                                <textarea name="comment" id="comment" style="resize: none;" class="form-control">{{old('comment',$occupant->comment)}}</textarea>
                                                                                @error('comment')
                                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                            <input type="hidden" name="occupant" value="{{$occupant->id}}">
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                                                            <div class="btn-group">
                                                                                <button class="button" type="submit">Save changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        <th>Relationship</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/js/custom/datatable.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        });
    </script>
@endsection
