@extends('layouts.master-layout')
@section('title')
    {{config('app.name')}}'s Modules
@endsection

@section('current-page')
    {{config('app.name')}}'s Modules
@endsection
@section('current-page-brief')
    {{config('app.name')}}'s Modules
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
    <link rel="stylesheet" href="/css/custom/toastify.css">

@endsection
@section('main-content')
    <div class="row" >
        <div class="col-lg-4  col-xl-4 col-md-4">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Add New Module</h5>
                    <p>Add the various modules</p>
                    <form action="{{route('add-new-module')}}" method="post">
                        @csrf
                        <div class="input-group input-group-button">
                            <input type="text" name="module_name" id="module_name" value="{{old('module_name')}}" class="form-control" placeholder="Module Name">
                            <span class="input-group-addon btn btn-primary" id="basic-addon10">
                            <button id="" type="submit" class="btn btn-primary btn-mini"> <i class="ti-check mr-2"></i> Submit</button>
                        </span>
                        </div>
                        @error('module_name') <i class="text-danger">{{$message}}</i> @enderror
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8  col-xl-8 col-md-8">

            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title"> {{config('app.name')}}'s Modules</h5>
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
                                <th>Module Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @php
                                $serial = 1;
                            @endphp
                            <tbody id="roleWrapper">
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$module->module_name ?? ''}}</td>
                                    <td>{{!is_null($module->created_at) ? date('d M, Y', strtotime($module->created_at)) : '-' }}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#default-Modal_{{$module->id}}" class="btn btn-primary btn-mini"><i class="ti-eye mr-2"></i></button>
                                        <div class="modal fade" id="default-Modal_{{$module->id}}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit {{$module->module_name ?? ''}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('update-module')}}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="">Module Name</label>
                                                                <input type="text" name="module_name" value="{{$module->module_name ?? ''}}" class="form-control">
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12 d-flex justify-content-end">
                                                                    <div class="btn-group">
                                                                        <input type="hidden" name="module" value="{{$module->id}}">
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
