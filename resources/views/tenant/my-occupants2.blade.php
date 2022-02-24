@extends('layouts.tenant-layout')

@section('title')
    {{Auth::user()->getProperty->property_name ?? ''}}'s Occupants
@endsection

@section('meta-title')
    {{Auth::user()->getProperty->property_name ?? ''}}'s Occupants
@endsection

@section('meta-keywords')
    {{Auth::user()->getProperty->property_name ?? ''}}'s Occupants
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/profile.css">
    <link rel="stylesheet" href="/css/custom/datatable.min.css">
@endsection
@section('current-page')
    {{Auth::user()->getProperty->property_name ?? ''}}'s <span class="text-white">Occupants</span>
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
    @include('tenant.partials._dash-header2')
    <section class="profile-part">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-warning">
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h3>{{Auth::user()->getProperty->property_name ?? ''}}'s <span class="text-primary">Occupants</span></h3>
                            <a href="{{route('add-new-occupant')}}"><i class="fa fa-plus"></i></a>
                        </div>
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
                                                <a href="javascript:void(0);" class="tooltip" data-toggle="modal" data-target="#occupantModal_{{$occupant->id}}">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="tooltext top">Details</span>
                                                </a>
                                            </div>
                                            <div class="modal fade" id="occupantModal_{{$occupant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit {{$occupant->first_name ?? ''}}'s Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
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
                                                                            <button type="button" data-dismiss="modal" class="btn-secondary btn">Cancel</button>
                                                                            <button class="btn btn-primary" type="submit">Save changes</button>
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
    </section>
@endsection

@section('extra-scripts')
    <script src="/js/custom/datatable.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        });
    </script>
@endsection
