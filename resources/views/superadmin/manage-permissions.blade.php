@extends('layouts.admin-layout')
@section('title')
    Manage Permissions
@endsection

@section('current-page')

@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-primary btn-mini" href="{{url()->previous()}}"><i class="ti-back-left"></i>Go Back</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/toastify.css">

@endsection
@section('main-content')
    <div class="row" >
        <div class="col-lg-4  col-xl-4 col-md-4">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Add New Permissions</h5>
                    <p>Use the form below to add a new unique permission.</p>
                    <form action="{{route('add-new-permission')}}" method="post">
                        @csrf
                        <div class="input-group input-group-button">
                            <input type="text" name="permission_name" id="permission_name" class="form-control" placeholder="Permission Name">
                            <span class="input-group-addon btn btn-primary" id="basic-addon10">
                            <button id="" type="submit" class="btn btn-primary btn-mini"> <i class="ti-check mr-2"></i> Submit</button>
                        </span>
                        </div>
                        @error('permission_name') <i class="text-danger mt-2">{{$message}}</i> @enderror
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8  col-xl-8 col-md-8">

            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title"> Manage Permissions</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="table-responsive" >
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @php
                                $serial = 1;
                            @endphp
                            <tbody id="roleWrapper">
                            @foreach($permissions as $role)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$role->name ?? ''}}</td>
                                    <td>{{!is_null($role->created_at) ? date('d M, Y', strtotime($role->created_at)) : '-' }}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#default-Modal_{{$role->id}}" class="btn btn-primary btn-mini"><i class="ti-eye mr-2"></i></button>
                                        <div class="modal fade" id="default-Modal_{{$role->id}}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{$role->name ?? ''}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('edit-role')}}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="">Role Name</label>
                                                                <input type="text" name="role" value="{{$role->name ?? ''}}" class="form-control">
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12 d-flex justify-content-end">
                                                                    <div class="btn-group">
                                                                        <input type="hidden" name="roleId" value="{{$role->id}}">
                                                                        <button type="button" class="btn btn-default waves-effect btn-mini " data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light ">Save changes</button>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra-scripts')

@endsection
