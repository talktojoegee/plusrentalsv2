@extends('layouts.master-layout')
@section('title')
    Applications
@endsection

@section('current-page')
    Applications <small>(Prospects/Potential tenants)</small>
@endsection
@section('current-page-brief')
    Eliminate manual entries and save time by using {{config('app.name')}}'s rental application. Applicants can apply online and you'll be able to sort, filter and screen with just a few clicks.
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('prospect-applications')}}"><i class="icofont icofont-tags"></i>Manage Applications</a>
        <a class="btn btn-primary btn-mini" href="{{route('new-application')}}"><i class="icofont icofont-tasks"></i>Add New Application</a>
    </div>
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
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <p>List of active listings</p>
                                <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                    <thead>
                                    <tr role="row" class="text-uppercase">
                                        <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="S/No: activate to sort column ascending" >S/No.</th>
                                        <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="Unit: activate to sort column ascending" >Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="Rent: activate to sort column ascending" >Property</th>
                                        <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="Beds date: activate to sort column ascending" >Applicant</th>
                                        <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="Baths: activate to sort column ascending" >Email</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Listed: activ">Mobile No.</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status: activ">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="Residency Date: activate to sort column ascending" >Residency Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($applications as $item)
                                        <tr role="row" class="odd">
                                            <td>{{$serial++}}</td>
                                            <td class="sorting_1">{{!is_null($item->created_at) ? date('d M, Y', strtotime($item->created_at)) : '-'}}</td>
                                            <td>
                                                <a href="{{route('view-property', $item->getProperty->slug)}}">{{ strlen($item->getProperty->property_name) > 35 ? substr($item->getProperty->property_name, 0,35).'..' : $item->getProperty->property_name }}</a>
                                            </td>
                                            <td>{{$item->first_name ?? ''}} {{$item->surname ?? ''}}</td>
                                            <td><a href="mailto:{{$item->email ?? ''}}">{{$item->email ?? ''}}</a></td>
                                            <td>{{$item->mobile_no ?? ''}}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <label for="" class="label label-warning">Pending</label>
                                                @elseif($item->status == 1)
                                                    <label for="" class="label label-success">Approved</label>
                                                @elseif($item->status == 2)
                                                    <label for="" class="label label-danger">Declined</label>
                                                @endif
                                            </td>
                                            <td>{{!is_null($item->residency_date) ? date('d M, Y', strtotime($item->residency_date)) : '-'}}</td>
                                            <td>
                                                <a href="{{route('view-application', $item->url)}}" class="btn btn-info btn-mini"><i class="icofont icofont-eye-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="text-uppercase">
                                        <th>S/No.</th>
                                        <th>Date</th>
                                        <th>Property</th>
                                        <th>Applicant</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        <th>Status</th>
                                        <th>Residency Date</th>
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
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
