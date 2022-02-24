@extends('layouts.master-layout')
@section('title')
    Property Inspection
@endsection

@section('current-page')
    Property Inspection
@endsection
@section('current-page-brief')
    All property inspection requests
@endsection

@section('event-area')
    @include('manager.property.partials._menu')
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @if (session()->has('error'))
                        <div class="alert alert-warning background-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success background-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-warning background-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                @foreach ($errors->all() as $error)
                                    <div>{{$error}}</div>
                                @endforeach
                            </div>
                        @endif
                    <div class="tab-content card-block">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <p>All property inspection requests </p>
                                <div class="table-responsive">

                                    <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                        <thead>
                                        <tr role="row" class="text-uppercase">
                                            <th class="sorting"  >S/No.</th>
                                            <th class="sorting" >Full Name</th>
                                            <th class="sorting" >Property</th>
                                            <th class="sorting"  >Email</th>
                                            <th class="sorting"  >Mobile No.</th>
                                            <th class="sorting"  >Schedule</th>
                                            <th class="sorting"  >Status</th>
                                            <th class="sorting"  >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($inspections as $inspection)
                                            <tr>
                                                <td>{{$serial++}}</td>
                                                <td>{{$inspection->full_name ?? '' }}</td>
                                                <td><a href="{{route('view-property', $inspection->getProperty->slug)}}" class="text-primary">{{strlen($inspection->getProperty->property_name) > 24 ? substr($inspection->getProperty->property_name,0,24).'...' : $inspection->getProperty->property_name }}</a></td>
                                                <td>{{$inspection->email ?? '' }}</td>
                                                <td>{{$inspection->mobile_no ?? '' }}</td>
                                                <td>{{date('d M, Y h:ia', strtotime($inspection->schedule_date))}}</td>
                                                <td>
                                                    @switch($inspection->status)
                                                        @case(0)
                                                        <label for="" class="label label-warning">Not Inspected</label>
                                                        @break
                                                        @case(1)
                                                        <label for="" class="label label-success">Inspected</label>
                                                        @break
                                                        @case(3)
                                                        <label for="" class="label label-danger">Declined</label>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#inspectionModal_{{$inspection->id}}" class="btn btn-mini btn-info">View</a>
                                                    <div class="modal fade modal-flex" id="inspectionModal_{{$inspection->id}}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <ul class="nav nav-tabs" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-toggle="tab" href="#tab-home" role="tab">Details</a>
                                                                        </li>
                                                                        @if($inspection->status == 0)
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" data-toggle="tab" href="#tab-profile" role="tab">Assignment</a>
                                                                        </li>
                                                                            @if(Auth::user()->id == $inspection->attended_by)
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" data-toggle="tab" href="#tab-messages" role="tab">Status</a>
                                                                        </li>
                                                                            @endif
                                                                        @endif
                                                                    </ul>
                                                                    <div class="tab-content modal-body">
                                                                        <div class="tab-pane active" id="tab-home" role="tabpanel">
                                                                            <h6>Inspection Request Details <sup>
                                                                                    @switch($inspection->status)
                                                                                        @case(0)
                                                                                        <label for="" class="label label-warning">Not Inspected</label>
                                                                                        @break
                                                                                        @case(1)
                                                                                        <label for="" class="label label-success">Inspected</label>
                                                                                        @break
                                                                                        @case(3)
                                                                                        <label for="" class="label label-danger">Declined</label>
                                                                                        @break
                                                                                    @endswitch
                                                                                </sup> </h6>
                                                                            <form action="">
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Full Name</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control" value="{{$inspection->full_name}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Email Address</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control" value="{{$inspection->email}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Mobile No.</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control" value="{{$inspection->mobile_no}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Schedule</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control" value="{{date('d M, Y h:ia', strtotime($inspection->schedule_date)) ?? ''}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label>Message</label>
                                                                                            <textarea
                                                                                                name="message"
                                                                                                id=""
                                                                                                cols="30"
                                                                                                rows="10" readonly style="resize: none;"
                                                                                                class="form-control">{{$inspection->message ?? '-'}}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <h5 class="sub-title">Outcome</h5>
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Assigned To</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control" value="{{$inspection->getAttendedBy->first_name ?? ''}} {{$inspection->getAttendedBy->surname ?? ''}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Date Inspected</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control" value="{{!is_null($inspection->date_attended) ? date('d M, Y h:ia', strtotime($inspection->date_attended)) : '-'}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label>Comment</label>
                                                                                            <textarea
                                                                                                name="comment"
                                                                                                id=""
                                                                                                cols="10"
                                                                                                rows="5" readonly style="resize: none;"
                                                                                                class="form-control ">{{$inspection->comment ?? '-'}}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        @if($inspection->status == 0)
                                                                            <div class="tab-pane" id="tab-profile" role="tabpanel">
                                                                            <h6 class="mb-3">Inspection Assignment</h6>
                                                                            <form action="{{route('property-inspection')}}" method="post">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Assign To</label>
                                                                                            <select
                                                                                                name="assign_to"
                                                                                                id=""
                                                                                                class="form-control">
                                                                                                <option
                                                                                                    disabled selected>--Select user--</option>
                                                                                                @foreach($users as $user)
                                                                                                    <option
                                                                                                        value="{{$user->id}}">{{$user->first_name ?? '' }} {{$user->surname ?? ''}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('assign_to') <i class="text-danger">{{$message}}</i>@enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="">Date & Time</label>
                                                                                            <input
                                                                                                type="datetime-local"
                                                                                                class="form-control" name="schedule_date">
                                                                                            @error('schedule_date') <i class="text-danger">{{$message}}</i>@enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                                        <input type="hidden" name="inspectionId" value="{{$inspection->id}}">
                                                                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                            @if(Auth::user()->id == $inspection->attended_by)
                                                                            <div class="tab-pane" id="tab-messages" role="tabpanel">
                                                                                <h6>Update Status</h6>
                                                                                <form action="{{route('update-property-inspection-status')}}" method="post">
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col-md-10">
                                                                                            <div class="form-group">
                                                                                                <label for="">Status</label>
                                                                                                <select name="status" id=""
                                                                                                        class="form-control">
                                                                                                    <option
                                                                                                        disabled selected>--Select status--</option>
                                                                                                    <option
                                                                                                        value="1">Inspected</option>
                                                                                                    <option value="2">Discard</option>
                                                                                                </select>
                                                                                                @error('status') <i class="text-danger">{{$message}}</i>@enderror
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <div class="form-group">
                                                                                                <label for="">Comment</label>
                                                                                                <textarea style="resize: none" name="comment"
                                                                                                          id="comment" cols="30"
                                                                                                          rows="10"
                                                                                                          class="form-control">{{old('comment')}}</textarea>
                                                                                                @error('comment') <i class="text-danger">{{$message}}</i>@enderror
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 d-flex justify-content-center">
                                                                                            <input type="hidden" name="inspection_id" value="{{$inspection->id}}">
                                                                                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            @endif
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr role="row" class="text-uppercase">
                                            <th >S/No.</th>
                                            <th>Full Name</th>
                                            <th >Property</th>
                                            <th >Email</th>
                                            <th >Mobile No.</th>
                                            <th >Schedule</th>
                                            <th >Status</th>
                                            <th >Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
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
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
