@extends('layouts.master-layout')
@section('title')
    Manage Email Templates
@endsection

@section('current-page')
    Manage Email Templates
@endsection
@section('current-page-brief')
    Manage email templates for various events or occasions.
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
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <p>List of active listings</p>
                            <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                <thead>
                                <tr role="row" class="text-uppercase">
                                    <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" >S/No.</th>
                                    <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" >Template Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" >Subject</th>
                                    <th class="sorting" tabindex="0" aria-controls="focus-key" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($templates as $template)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$template->template_name ?? ''}}</td>
                                        <td>{{$template->subject}}</td>
                                        <td>
                                            <a href="{{route('edit-email-template', $template->slug)}}"  class="btn btn-mini btn-info"><i class="icofont icofont-eye-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr class="text-uppercase">
                                    <th>S/No.</th>
                                    <th>Template Name</th>
                                    <th>Subject</th>
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
