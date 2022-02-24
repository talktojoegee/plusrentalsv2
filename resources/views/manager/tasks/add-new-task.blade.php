@extends('layouts.master-layout')
@section('title')
    Add New Task
@endsection

@section('current-page')
    Add New Task
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('manage-tasks')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Tasks</a>
        <a href="{{route('add-new-task')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Add New Task</a>
        <button class="btn btn-danger btn-mini"><i class="icofont icofont-megaphone"></i>Reports</button>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Add New Task</h5>
                    <p>Add a new task to the system using the form below.</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-block">
                                @if(session()->has('success'))
                                    <div class="alert alert-success background-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled text-white"></i>
                                        </button>
                                        {!! session()->get('success') !!}
                                    </div>
                                @endif
                                <form action="{{route('add-new-task')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Property</label>
                                                <select name="property" id="property" class="form-control js-example-basic-single" value="{{old('property')}}">
                                                    <option disabled selected>-- Select property --</option>
                                                    @foreach($properties as $property)
                                                        <option value="{{$property->id}}">{{$property->property_name ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('property')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Assign To </label>
                                                <select name="assign_to[]" multiple="multiple" id="assign_to" class="form-control js-example-basic-multiple" value="{{old('assign_to')}}">
                                                    <option disabled selected>-- Select applicant --</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('assign_to')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" value="{{old('title')}}" placeholder="Title" class="form-control">
                                                @error('title') <small class="form-text text-danger">{{$message}}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" placeholder="Description" rows="5" style="resize: none;"
                                                          class="form-control">{{old('description')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Task Period</label>
                                                <div class="input-group input-group-button">
                                                <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                                    <span class="">Start Date</span>
                                                </span>
                                                    <input type="date" class="form-control" name="start_date" placeholder="Start Date">
                                                    <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                                    <span class="">End Date</span>
                                                </span>
                                                    <input type="date" class="form-control" name="end_date" placeholder="End Date">
                                                </div>
                                                @error('end_date') <small class="form-text text-danger">{{$message}}</small> @enderror
                                                <br>
                                                @error('start_date') <small class="form-text text-danger">{{$message}}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                            <label for="">Attachment</label>
                                            <input type="file" name="attachment[]" multiple class="form-control-file">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Property Details</h5>
                                <div class="view-info" id="property_details">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();

            $(document).on('change', '#property', function(e){
                e.preventDefault();
                axios.post('/lease/get-property',{property:$(this).val()})
                    .then(response=>{
                        $('#property_details').html(response.data);
                        $('.js-example-basic-single').select2();
                    });
            });
        });
    </script>
@endsection
