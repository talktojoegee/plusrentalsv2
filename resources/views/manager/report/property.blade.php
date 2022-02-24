@extends('layouts.master-layout')
@section('title')
    Property Report
@endsection

@section('current-page')
    Property Report
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
    <link rel="stylesheet" href="/assets/css/select2.css">
    <style>

    </style>
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
                                <form action="{{route('generate-property-report')}}" class="" method="GET">
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
                                        <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                <span class="">Location</span>
                            </span>
                                        <select name="location" id="" class="form-control js-example-basic-single">
                                            <option selected disabled>--Select location--</option>
                                            <option value="0">All</option>
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->location_name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">Submit</span>
                                        </button>
                                    </div>
                                    @error('start_date') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                    @error('end_date') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                    @error('location') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                </form>
                                @if($status == 1 && $section == 'general')
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                <h5 class="sub-title" >Period</h5>
                                                <p>From: <label for="" class="label label-success">{{date('d M, Y', strtotime($start))}}</label>
                                                    To: <label for="" class="label label-danger">{{date('d M, Y', strtotime($end))}}</label>
                                                    Location: <label for="" class="label label-info">{{$loc->location_name ?? 'All' }}</label>
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
                                                            @case(0)
                                                            Vacant
                                                            @break
                                                            @case(1)
                                                            Occupied
                                                            @break
                                                            @case(2)
                                                            Sold
                                                            @break
                                                            @case(3)
                                                            Undecided
                                                            @break
                                                        @endswitch
                                                    </label>
                                                    Location: <label for="" class="label label-info">{{$loc->location_name ?? 'All' }}</label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="profile3" role="tabpanel">
                                <form action="{{route('generate-property-report-by-status')}}" class="" method="GET">
                                    @csrf
                                    <div class="input-group input-group-button">
                                        <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">Location</span>
                                        </span>
                                        <select name="location" id="" class="form-control ">
                                            <option selected disabled>--Select location--</option>
                                            <option value="0">All</option>
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->location_name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">Status</span>
                                        </span>
                                        <select name="status" id="" class="form-control ">
                                            <option selected disabled>--Select status--</option>
                                            <option value="0">Vacant</option>
                                            <option value="1">Occupied</option>
                                            <option value="2">Sold</option>
                                            <option value="3">Undecided</option>
                                        </select>
                                        <button type="submit" class="input-group-addon btn btn-primary" id="basic-addon9">
                                            <span class="">Submit</span>
                                        </button>
                                    </div>
                                    @error('start_date') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                    @error('end_date') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
                                    @error('location') <i class="text-danger mt-2">{{$message}}</i>@enderror <br>
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
                                                        <label for="" class="label label-success">Occupied/Leased</label>
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
    @endif
@endsection

@section('extra-scripts')
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
    <script src="/assets/js/select2.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        </script>
@endsection
