@extends('layouts.master-layout')
@section('title')
    Properties
@endsection

@section('current-page')
    Properties
@endsection
@section('current-page-brief')
    A collection of all properties.
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
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-blue">
                <div class="card-block">
                    <i class="icofont icofont-briefcase-alt-2 bg-simple-c-blue card1-icon"></i>
                    <h4>{{number_format($properties->where('status',0)->count())}}</h4>
                    <p>Vacant/Available</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-pink">
                <div class="card-block">
                    <i class="icofont icofont-shield-alt bg-simple-c-pink card1-icon"></i>
                    <h4>{{number_format($properties->where('status',1)->count())}}</h4>
                    <p>Occupied/Leased</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-green">
                <div class="card-block">
                    <i class="icofont icofont-money-bag bg-simple-c-green card1-icon"></i>
                    <h4>{{number_format($properties->where('status',2)->count())}}</h4>
                    <p>Sold</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-yellow">
                <div class="card-block">
                    <i class="icofont icofont-sand-clock bg-simple-c-yellow card1-icon"></i>
                    <h4>{{number_format($properties->where('status',3)->count())}}</h4>
                    <p>Undecided</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
    </div>
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
                    <div class="tab-content card-block">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <p>List of properties owned or managed by  <strong>{{Auth::user()->getUserCompany->company_name ?? '' }}</strong> </p>
                                <div class="table-responsive">

                                    <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                        <thead>
                                        <tr role="row" class="text-uppercase">
                                            <th class="sorting"  >S/No.</th>
                                            <th class="sorting" >Date</th>
                                            <th class="sorting"  >Listing Type</th>
                                            <th class="sorting"  >Property Type</th>
                                            <th class="sorting"  >Property Name</th>
                                            <th class="sorting"  >Status</th>
                                            <th class="sorting"  >Location</th>
                                            <th class="sorting_asc" >Amount</th>
                                            <th class="sorting"  >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($properties as $property)
                                            <tr>
                                                <td>{{$serial++}}</td>
                                                <td>{{date('d M, Y', strtotime($property->created_at))}}</td>
                                                <td>{!! $property->listing_type == 1 ? "<span class='text-primary'>For rent</span>" : "<span class='text-danger'>For sale</span>" !!}</td>
                                                <td>
                                                    @switch($property->property_type)
                                                        @case(1)
                                                        Apartment
                                                        @break
                                                        @case(2)
                                                        House
                                                        @break
                                                        @case(3)
                                                        Land
                                                        @break
                                                        @case(4)
                                                        Townhouse
                                                        @break
                                                        @case(5)
                                                        Garden Cottage
                                                        @break
                                                        @case(6)
                                                        Farm
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td><a href="{{route('view-property', $property->slug)}}" class="text-primary">{{strlen($property->property_name) > 24 ? substr($property->property_name,0,24).'...' : $property->property_name }}</a></td>
                                                <td>
                                                    @switch($property->status)
                                                        @case(0)
                                                        <label for="" class="label label-info">Vacant/Available</label>
                                                        @break
                                                        @case(1)
                                                        <label for="" class="label label-success">Leased/Taken</label>
                                                        @break
                                                        @case(2)
                                                        <label for="" class="label label-danger">Sold</label>
                                                        @break
                                                        @case(3)
                                                        <label for="" class="label label-warning text-white">Undecided</label>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>{{$property->getLocation->location_name ?? ''}}</td>
                                                <td class="text-right">{{'₦'.number_format($property->rental_price ?? 0 , 2) }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-mini" href="{{route('view-property', $property->slug)}}"><i class="icofont icofont-eye-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr class="text-uppercase">
                                            <th>S/No.</th>
                                            <th>Date</th>
                                            <th>Listing Type</th>
                                            <th>Property Type</th>
                                            <th>Property Name</th>
                                            <th>Status</th>
                                            <th>Location</th>
                                            <th>Amount</th>
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

@endsection

@section('extra-scripts')
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
