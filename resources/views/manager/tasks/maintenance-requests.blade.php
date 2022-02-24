@extends('layouts.master-layout')
@section('title')
    Manage Maintenance Requests
@endsection

@section('current-page')
    Manage Maintenance Requests
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.tasks.partials._event-menu')
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <p>List of all maintenance requests.</p>
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
                                    <th class="sorting" >Ticket No.</th>
                                    <th class="sorting" >Tenant</th>
                                    <th class="sorting_asc">Title</th>
                                    <th class="sorting"  >Category</th>
                                    <th class="sorting"  >Priority</th>
                                    <th class="sorting"  >Status</th>
                                    <th class="sorting"  >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($requests as $request)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$request->ticket_no ?? ''}}</td>
                                        <td>{{$request->getTenant->getApplicant->first_name ?? ''}} {{$request->getTenant->getApplicant->surname ?? ''}}</td>
                                        <td>{{$request->title ?? ''}}</td>
                                        <td>{{$request->getTaskCategory->task_category_name ?? ''}}</td>
                                        <td>
                                            @switch($request->priority)
                                                @case(1)
                                                Normal
                                                @break
                                                @case(2)
                                                Standard
                                                @break
                                                @case(3)
                                                High
                                                @break
                                                @case(4)
                                                Emergency
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($request->converted)
                                                @case(0)
                                                Not converted yet
                                                @break
                                                @case(1)
                                                Converted to task
                                                @break
                                                @case(2)
                                                Discarded/Declined
                                                @break
                                            @endswitch
                                        </td>
                                        <td>action</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th >S/No.</th>
                                    <th >Ticket No.</th>
                                    <th >Tenant</th>
                                    <th >Title</th>
                                    <th >Category</th>
                                    <th >Priority</th>
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
