@extends('layouts.master-layout')
@section('title')
    Manage Team
@endsection

@section('current-page')

@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('leases')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Team</a>
        <a href="{{route('add-new-user')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Add New User</a>
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
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <h5 class="sub-title">Manage Team</h5>
                            <p>Manage your team members from here.</p>
                            <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc">S/No.</th>
                                    <th class="sorting_asc">First Name</th>
                                    <th class="sorting" >Surname</th>
                                    <th class="sorting"  >Mobile No.</th>
                                    <th class="sorting"  >Email</th>
                                    <th class="sorting"  >Status</th>
                                    <th class="sorting"  >Date</th>
                                    <th class="sorting"  >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$user->first_name ?? ''}}</td>
                                        <td>{{$user->surname ?? ''}}</td>
                                        <td>{{$user->mobile_no ?? ''}}</td>
                                        <td>{{$user->email ?? ''}}</td>
                                        <td>{!! $user->account_status == 1? "<label class='label label-success'> Active </label>" : "<label class='label label-danger'> Inactive </label>" !!}</td>
                                        <td>{{ !is_null($user->created_at) ? date('d M, Y', strtotime($user->created_at)) : '-'}}</td>
                                        <td>
                                            <a href="{{route('view-profile', $user->url)}}" class="btn btn-mini btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th >S/No.</th>
                                    <th >First Name</th>
                                    <th >Surname</th>
                                    <th >Mobile No.</th>
                                    <th >Email</th>
                                    <th >Status</th>
                                    <th >Date</th>
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

@endsection

@section('extra-scripts')
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
