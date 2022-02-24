@extends('layouts.tenant-layout')

@section('title')
   New Maintenance Request
@endsection

@section('meta-title')
    New Maintenance Request
@endsection

@section('meta-keywords')
    New Maintenance Request
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/profile.css">
@endsection
@section('current-page')
    New Maintenance Request
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
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h3> New Maintenance Request</h3>
                            <a href="{{route('maintenance')}}">All</a>
                        </div>
                        <form action="{{route('new-maintenance-request')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Title </label>
                                        <input type="text" placeholder="Title" name="title" value="{{old('title')}}" class="form-control">
                                        @error('title')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option selected disabled>--Select category--</option>
                                            @foreach($categories as $category)
                                                <option value="1">{{$category->task_category_name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Priority</label>
                                        <select name="priority" id="priority" class="form-control">
                                            <option value="1" selected>Normal</option>
                                            <option value="2">Standard</option>
                                            <option value="3">High</option>
                                            <option value="4">Emergency</option>
                                        </select>
                                        @error('priority')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="">Attachment <small>(Optional)</small></label>
                                    <input type="file" class="form-control-file" name="attachment">
                                    @error('attachment')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="description" style="resize: none;" class="form-control">{{old('description')}}</textarea>
                                        @error('description')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                    <div class="btn-group">
                                        <a href="{{route('maintenance')}}" class="btn-secondary btn">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-scripts')

@endsection
