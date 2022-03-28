@extends('layouts.master-layout')
@section('title')
    Tenant Report
@endsection

@section('current-page')

@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('leases')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Tenants</a>
        <a href="{{route('add-new-lease')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Add New Lease</a>
        <a href="{{route('lease-applications')}}" class="btn btn-warning btn-mini"><i class="icofont icofont-tasks"></i>Lease Applications</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Generate Property Report</h5>
                    <div class="col-lg-12 col-xl-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">General</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">By Status</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <form action="{{route('generate-tenant-report')}}" class="" method="GET">
                                    @csrf
                                    <div class="input-group input-group-button">
                                        <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">From</span>
                                        </span>
                                        <input type="date" class="form-control" name="start_date" placeholder="From" value="{{date('Y-m-d')}}">
                                        <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">To</span>
                                        </span>
                                        <input type="date" class="form-control" name="end_date" placeholder="To" value="{{date('Y-m-d')}}">
                                        <button type="submit" class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">Submit</span>
                                        </button>
                                    </div>
                                    @error('start_date') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                    @error('end_date') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                </form>
                                @if($status == 1 && $section == 'general')
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                <h5 class="sub-title" >Period</h5>
                                                <p>From: <label for="" class="label label-success">{{date('d M, Y', strtotime($start))}}</label>
                                                    To: <label for="" class="label label-danger">{{date('d M, Y', strtotime($end))}}</label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($status == 1 && $section == 'status')
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                <h5 class="sub-title" >Selection</h5>
                                                <p>Status: <label for="" class="label label-success">
                                                        @switch($stat)
                                                            @case(1)
                                                            Renting
                                                            @break
                                                            @case(2)
                                                            Expired
                                                            @break
                                                            @case(3)
                                                            Evicted
                                                            @break
                                                        @endswitch
                                                    </label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="profile3" role="tabpanel">
                                <form action="{{route('generate-tenant-report-by-status')}}" class="" method="GET">
                                    @csrf
                                    <div class="input-group input-group-button">
                                        <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">Status</span>
                                        </span>
                                        <select name="status" id="" class="form-control ">
                                            <option selected disabled>--Select status--</option>
                                            <option value="1">Renting</option>
                                            <option value="2">Expired</option>
                                            <option value="3">Evicted</option>
                                        </select>
                                        <button type="submit" class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">Submit</span>
                                        </button>
                                    </div>
                                    @error('status') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($status == 1)
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card statustic-progress-card">
                <div class="card-header">
                    <h5>Overall</h5>
                </div>
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <label class="label label-warning">
                                {{$tenants->count() > 0 ? ceil($tenants->count() * 100 ) : 0 }}% <i class="m-l-10 ti-pie-chart"></i>
                            </label>
                        </div>
                        <div class="col text-right">
                            <h5 class="">{{number_format($tenants->count() ) }}</h5>
                        </div>
                    </div>
                    <div class="progress m-t-15">
                        <div class="progress-bar bg-c-yellow" style="width:{{$tenants->count() > 0 ? ceil($tenants->count() * 100 ) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card statustic-progress-card">
                <div class="card-header">
                    <h5>Evicted</h5>
                </div>
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <label class="label label-danger">
                                {{$tenants->count() > 0 ? ceil($tenants->where('status',3)->count()/$tenants->count() * 100 ) : 0 }}% <i class="m-l-10 ti-pie-chart"></i>
                            </label>
                        </div>
                        <div class="col text-right">
                            <h5 class="">{{number_format($tenants->where('status',3)->count())}}</h5>
                        </div>
                    </div>
                    <div class="progress m-t-15">
                        <div class="progress-bar bg-c-pink" style="width:{{$tenants->count() > 0 ? ceil($tenants->where('status',3)->count()/$tenants->count() * 100 ) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card statustic-progress-card">
                <div class="card-header">
                    <h5>Expired</h5>
                </div>
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <label class="label bg-c-lite-green">
                                {{$tenants->count() > 0 ? ceil($tenants->where('status',2)->count()/$tenants->count() * 100 ) : 0 }}% <i class="m-l-10 ti-pie-chart"></i>
                            </label>
                        </div>
                        <div class="col text-right">
                            <h5 class="">{{number_format($tenants->where('status',2)->count())}}</h5>
                        </div>
                    </div>
                    <div class="progress m-t-15">
                        <div class="progress-bar bg-c-lite-green" style="width:{{$tenants->count() > 0 ? ceil($tenants->where('status',2)->count()/$tenants->count() * 100 ) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card statustic-progress-card">
                <div class="card-header">
                    <h5>Renting</h5>
                </div>
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <label class="label label-success">
                                {{$tenants->count() > 0 ? ceil($tenants->where('status',1)->count()/$tenants->count() * 100 ) : 0 }}% <i class="m-l-10 ti-pie-chart"></i>
                            </label>
                        </div>
                        <div class="col text-right">
                            <h5 class="">{{number_format($tenants->where('status',1)->count())}}</h5>
                        </div>
                    </div>
                    <div class="progress m-t-15">
                        <div class="progress-bar bg-c-green" style="width:{{$tenants->count() > 0 ? ceil($tenants->where('status',1)->count()/$tenants->count() * 100 ) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <p>A list of all tenants.</p>
                            @if (session()->has('success'))
                                <div class="alert alert-success background-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('success') !!}
                                </div>
                            @endif
                            <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc">S/No.</th>
                                    <th class="sorting_asc">Tenant</th>
                                    <th class="sorting" >Property</th>
                                    <th class="sorting"  >Frequency</th>
                                    <th class="sorting"  >Start Date</th>
                                    <th class="sorting"  >End Date</th>
                                    <th class="sorting"  >Status</th>
                                    <th class="sorting"  >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($tenants as $tenant)
                                    <tr role="row" class="odd">
                                        <td>{{$serial++}}</td>
                                        <td>{{$tenant->getApplicant->first_name ?? ''}} {{$tenant->getApplicant->surname ?? ''}}</td>
                                        <td><a class="text-primary" target="_blank" href="{{route('view-property', $tenant->getProperty->slug)}}">{{$tenant->getProperty->property_name ?? ''}}</a> </td>
                                        <td class="">{{$tenant->getProperty->getLeaseFrequency->frequency ?? ''}}</td>
                                        <td><label for="" class="label label-info">{{date('d-M,Y', strtotime($tenant->start_date))}}</label></td>
                                        <td><label for="" class="label label-danger">{{date('d-M,Y', strtotime($tenant->end_date))}}</label></td>
                                        <td>
                                            @switch($tenant->status)
                                                @case(1)
                                                Renting
                                                @break
                                                @case(2)
                                                Expired
                                                @break
                                                @case(3)
                                                Evicted
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{route('view-tenant', $tenant->slug)}}"  class="btn btn-mini btn-info"><i class="icofont icofont-eye-alt"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th >S/No.</th>
                                    <th >Tenant</th>
                                    <th >Property</th>
                                    <th >Frequency</th>
                                    <th >Start Date</th>
                                    <th >End Date</th>
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

    <div class="modal fade" id="approve-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{route('process-lease-application')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title">Approve Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure you want to approve <strong id="applicant"></strong>'s lease application?</h6>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <input type="hidden" id="applicantId" name="applicant">
                            <input type="hidden" id="propertyId" name="property">
                            <input type="hidden" name="action" value="1">
                            <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                            <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i>Yes, please</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection

@section('extra-scripts')
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.approve', function(event){
                event.preventDefault();
                $('#applicant').text($(this).data('applicant'));
                $('#applicantId').val($(this).data('appid'));
                $('#propertyId').val($(this).data('property'));
            });
        });
    </script>
@endsection
