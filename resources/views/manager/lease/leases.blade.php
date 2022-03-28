@extends('layouts.master-layout')
@section('title')
    Leases
@endsection

@section('current-page')

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
                            <p>Here's a list of all your tenant who are currently renting or rented your property in the past.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">

                            <div class="table-responsive">
                                <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">S/No.</th>
                                        <th class="sorting_asc">Tenant</th>
                                        <th class="sorting" >Property</th>
                                        <th class="sorting"  > Amount</th>
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
                                    @foreach($leases as $applicant)
                                        <tr role="row" class="odd">
                                            <td>{{$serial++}}</td>
                                            <td>{{$applicant->getApplicant->first_name ?? ''}} {{$applicant->getApplicant->surname ?? ''}}</td>
                                            <td>{{ strlen($applicant->getProperty->property_name) > 35 ? substr($applicant->getProperty->property_name,0,35).'...' : $applicant->getProperty->property_name  }}</td>
                                            <td class="text-right">{{number_format($applicant->rent_amount,2)}}</td>
                                            <td class="text-success">{{date('d M,Y', strtotime($applicant->start_date))}}</td>
                                            <td class="text-danger">{{date('d M,Y', strtotime($applicant->end_date))}}</td>
                                            <td>
                                                @switch($applicant->status)
                                                    @case(0)
                                                    Prospect
                                                    @break
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
                                                <a href="{{route('view-lease', $applicant->slug)}}"  class="btn btn-mini btn-info"><i class="icofont icofont-eye-alt"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th >S/No.</th>
                                        <th >Tenant</th>
                                        <th >Property</th>
                                        <th > Amount</th>
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
