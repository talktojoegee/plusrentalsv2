@extends('layouts.main-layout')

@section('title')
    {{Auth::user()->getProperty->property_name ?? ''}}'s Maintenance
@endsection

@section('meta-title')
    {{Auth::user()->getProperty->property_name ?? ''}}'s Maintenance
@endsection

@section('meta-keywords')
    {{Auth::user()->getProperty->property_name ?? ''}}'s Maintenance
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
@section('current-page')
    {{Auth::user()->getProperty->property_name ?? ''}}'s <span class="text-white">Maintenance</span>
@endsection
@section('main-content')
    <div class="parallax titlebar" data-background="/images2/listings-parallax.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505" style="background-image: url(&quot;/images2/listings-parallax.jpg&quot;); background-attachment: fixed; background-size: 1519px 958.869px; background-position: 50% -532.7px;"><div class="parallax-overlay" style="background-color: rgb(48, 48, 48); opacity: 0.8;"></div>
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Maintenance Requests</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('profile')}}">Home</a></li>
                                <li>Maintenance Requests</li>
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
            <div class="">
                <div class="col-md-9 widget utf-sidebar-widget-item" style="box-sizing: border-box; padding: 10px;">
                    @if(session()->has('success'))
                        <div class="notification success closeable">
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="notification warning closeable">
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                    <div class="utf-inner-list-headline-item">
                        <h3>Maintenance Requests</h3>
                    </div>
                        <div class="table-responsive mt-5">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket No.</th>
                                    <th>Title</th>
                                    <th>Priority</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach(Auth::user()->getAllTenantMaintenanceRequests as $task)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$task->ticket_no ?? ''}}</td>
                                        <td>{{strlen($task->title) > 30 ? substr($task->title,0,30).'...'  : $task->title}} </td>
                                        <td>
                                            @switch($task->status)
                                                @case(0)
                                                <label for="" class="text-muted">Normal</label>
                                                @break
                                                @case(1)
                                                <label for="" class="text-info">Standard</label>
                                                @break
                                                @case(2)
                                                <label for="" class="text-warning">High</label>
                                                @break
                                                @case(3)
                                                <label for="" class="text-danger">Emergency</label>
                                                @break
                                            @endswitch

                                        </td>
                                        <td>{{!is_null($task->created_at) ? date('d M, Y', strtotime($task->created_at)) : ''}}</td>
                                        <td>
                                            <div class="account-title">
                                                <a href="{{route('maintenance-detail', $task->id)}}" class="tooltip" >
                                                    <i class="sl sl-icon-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>

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
            $('#started').DataTable();
            $('#completed').DataTable();
        });
    </script>
@endsection
