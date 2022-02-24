@extends('layouts.master-layout')
@section('title')
    Rental Owners
@endsection

@section('current-page')
    Rental Owners
@endsection
@section('current-page-brief')
    This is an array of rental owners or landlords registered on the system.
@endsection

@section('event-area')
    @include('manager.rental-owner.partials._event-menu')
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
                         <div class="col-lg-12 col-xl-12">
                             <!-- Nav tabs -->
                             <ul class="nav nav-tabs md-tabs " role="tablist">
                                 <li class="nav-item">
                                     <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><i class="icofont icofont-business-man-alt-1 mr-2"></i> Individual Owners</a>
                                     <div class="slide"></div>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><i class="icofont icofont-briefcase-alt-2 mr-2 "></i>Company/Trust</a>
                                     <div class="slide"></div>
                                 </li>
                             </ul>
                             <!-- Tab panes -->
                             <div class="tab-content card-block">
                                 <div class="tab-pane active" id="home7" role="tabpanel">
                                     <div class="col-md-12 col-lg-12 col-sm-12">
                                         <p>List of individual rental owners</p>
                                         <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                             <thead>
                                             <tr role="row" class="text-uppercase">
                                                 <th class="sorting" tabindex="0" aria-label="S/No: activate to sort column ascending" >S/No.</th>
                                                 <th class="sorting" tabindex="0"  aria-label="Rental Owner: activate to sort column ascending" >Rental Owner</th>
                                                 <th class="sorting" tabindex="0" aria-label="Email: activate to sort column ascending" >Email</th>
                                                 <th class="sorting" tabindex="0"  aria-label="Mobile No.: activate to sort column ascending" >Mobile No.</th>
                                                 <th class="sorting_asc" tabindex="0"  aria-sort="ascending" aria-label="Date: activ">Date</th>
                                                 <th class="sorting" tabindex="0"  aria-label="Action: activate to sort column ascending" >Action</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @php
                                                 $serial = 1;
                                             @endphp
                                                 @foreach($rentals as $rental)
                                                     @if($rental->ownership_type == 1)
                                                         <tr>
                                                         <td>{{$serial++}}</td>
                                                         <td>{{$rental->first_name ?? ''}} {{$rental->surname ?? ''}}</td>
                                                         <td><a href="mailto:{{$rental->email ?? ''}}">{{$rental->email ?? ''}}</a></td>
                                                         <td><a href="tel:{{$rental->mobile_no ?? ''}}">{{$rental->mobile_no ?? ''}}</a></td>

                                                         <td>{{!is_null($rental->created_at) ? date('d M, Y', strtotime($rental->created_at)) : '-'}}</td>
                                                         <td>
                                                             <a class="btn btn-info btn-mini" href="{{route('rental-owner-details', $rental->slug)}}"><i class="icofont icofont-eye-alt"></i></a>
                                                         </td>
                                                     </tr>
                                                     @endif
                                                 @endforeach
                                             </tbody>
                                             <tfoot>
                                             <tr class="text-uppercase">
                                                 <th>S/No.</th>
                                                 <th>Rental Owner</th>
                                                 <th>Email</th>
                                                 <th>Mobile No.</th>
                                                 <th>Date</th>
                                                 <th>Action</th>
                                             </tr>
                                             </tfoot>
                                         </table>
                                     </div>
                                 </div>
                                 <div class="tab-pane" id="profile7" role="tabpanel">
                                     <div class="col-md-12 col-lg-12 col-sm-12">
                                         <p>List of individual rental owners</p>
                                         <table id="focus-key1" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                             <thead>
                                             <tr role="row" class="text-uppercase">
                                                 <th class="sorting" tabindex="0" aria-label="S/No: activate to sort column ascending" >S/No.</th>
                                                 <th class="sorting" tabindex="0"  aria-label="Rental Owner: activate to sort column ascending" >Rental Owner</th>
                                                 <th class="sorting" tabindex="0" aria-label="Email: activate to sort column ascending" >Email</th>
                                                 <th class="sorting" tabindex="0"  aria-label="Mobile No.: activate to sort column ascending" >Mobile No.</th>
                                                 <th class="sorting_asc" tabindex="0"  aria-sort="ascending" aria-label="Date: activ">Date</th>
                                                 <th class="sorting" tabindex="0"  aria-label="Action: activate to sort column ascending" >Action</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                             @php
                                                 $serial = 1;
                                             @endphp
                                             @foreach($rentals as $rental)
                                                 @if($rental->ownership_type == 2)
                                                     <tr>
                                                         <td>{{$serial++}}</td>
                                                         <td>{{$rental->company_name ?? ''}}</td>
                                                         <td><a href="mailto:{{$rental->email ?? ''}}">{{$rental->email ?? ''}}</a></td>
                                                         <td><a href="tel:{{$rental->mobile_no ?? ''}}">{{$rental->mobile_no ?? ''}}</a></td>

                                                         <td>{{!is_null($rental->created_at) ? date('d M, Y', strtotime($rental->created_at)) : '-'}}</td>
                                                         <td>
                                                             <a class="btn btn-info btn-mini" href="{{route('rental-owner-details', $rental->slug)}}"><i class="icofont icofont-eye-alt"></i></a>
                                                         </td>
                                                     </tr>
                                                 @endif
                                             @endforeach
                                             </tbody>
                                             <tfoot>
                                             <tr class="text-uppercase">
                                                 <th>S/No.</th>
                                                 <th>Rental Owner</th>
                                                 <th>Email</th>
                                                 <th>Mobile No.</th>
                                                 <th>Date</th>
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
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
