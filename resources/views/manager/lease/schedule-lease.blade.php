@extends('layouts.master-layout')
@section('title')
    Schedule Lease
@endsection

@section('current-page')
    Schedule Lease
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.lease.partials._menu')
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
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success background-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('success') !!}
                                </div>
                            @endif
                            <p>List of all Schedule Lease</p>
                            <div class="table-responsive">
                                <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">S/No.</th>
                                        <th class="sorting_asc">Tenant</th>
                                        <th class="sorting">Property</th>
                                        <th class="sorting">Scheduled By</th>
                                        <th class="sorting">Trans. Ref.</th>
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
                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td>{{$schedule->getTenant->getApplicant->first_name ?? ''}} {{$schedule->getTenant->getApplicant->surname ?? ''}}</td>
                                            <td><a href="">{{strlen($schedule->getProperty->property_name) > 35 ? substr($schedule->getProperty->property_name,0,35).'...' :  ''}}</a></td>
                                            <td>{{$schedule->getScheduledBy->first_name ?? ''}} {{$schedule->getScheduledBy->surname ?? ''}}</td>
                                            <td>{{$schedule->trans_ref ?? ''}}</td>
                                            <td class="text-success">{{!is_null($schedule->start_date) ? date('d M, Y', strtotime($schedule->start_date)) : '-' }}</td>
                                            <td class="text-danger">{{!is_null($schedule->end_date) ? date('d M, Y', strtotime($schedule->end_date)) : '-' }}</td>
                                            <td>
                                                @if($schedule->status == 0)
                                                    <label for="" class="label label-warning">Pending</label>
                                                @else
                                                    <label for="" class="label label-success">Started</label>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#scheduleModal_{{$schedule->id}}" class="btn btn-mini btn-primary"><i class="ti-eye mr-2"></i>View</a>
                                                <div class="modal fade" id="scheduleModal_{{$schedule->id}}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Update Lease Schedule</h6>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('update-lease-schedule')}}" method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="end_date" value="{{$schedule->getProperty->getLeaseFrequency->id ?? 1 }}">
                                                                        <input type="hidden" name="schedule" value="{{$schedule->id}}">
                                                                        <label for="">Start Date</label>
                                                                        <input type="date" placeholder="Start Date" class="form-control col-md-8" name="start_date">
                                                                        @error('start_date')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Frequency</label>
                                                                        <input class="form-control col-8" type="text" name="frequency" value="{{$schedule->getProperty->getLeaseFrequency->frequency ?? ''}}" disabled>

                                                                        @error('end_date')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror

                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group d-flex justify-content-center">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-secondary btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                                                                            @if($schedule->status == 0)
                                                                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i> Save changes</button>
                                                                            @endif
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
                                        <th >S/No.</th>
                                        <th >Tenant</th>
                                        <th >Property</th>
                                        <th >Scheduled By</th>
                                        <th >Trans. Ref.</th>
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
    </div>

@endsection

@section('extra-scripts')
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
