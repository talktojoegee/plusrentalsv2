@extends('layouts.main-layout')
@section('title')
    Profile
@endsection
@section('meta-keywords')
    Real estate, smart homes, property listing, properties, rent payment, tenant portal,
@endsection
@section('meta-description')
    is a property manage...
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

@section('main-content')
    <div class="parallax titlebar" data-background="/images2/listings-parallax.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505" style="background-image: url(&quot;/images2/listings-parallax.jpg&quot;); background-attachment: fixed; background-size: 1519px 958.869px; background-position: 50% -532.7px;"><div class="parallax-overlay" style="background-color: rgb(48, 48, 48); opacity: 0.8;"></div>
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Profile</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('profile')}}">Home</a></li>
                                <li>My Profile</li>
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
            <div class="col-md-9 widget utf-sidebar-widget-item">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {!! session()->get('success') !!}
                    </div>
                @endif
                    <div class="utf-inner-list-headline-item">
                        <h3>My Lease Log</h3>
                    </div>
                    <div class="" style="">
                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Property</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($my_leases as $lease)
                                    <tr>
                                        <td>
                                            {{$serial++}}
                                        </td>
                                        <td >
                                            {{!is_null($lease->created_at) ? date('d M, Y', strtotime($lease->created_at)) : '-'}}
                                        </td>
                                        <td >
                                    <span>
                                        <a href="{{route('listing-property-detail', $lease->getProperty->slug)}}">{{strlen($lease->getProperty->property_name) > 25 ? substr($lease->getProperty->property_name,0,25).'...' : $lease->getProperty->property_name}}</a>
                                    </span>
                                        </td>
                                        <td class="text-success">
                                            {{!is_null($lease->start_date) ? date('d M, Y', strtotime($lease->start_date)) : '-' }}
                                        </td>
                                        <td class="text-danger">
                                            {{!is_null($lease->end_date) ? date('d M, Y', strtotime($lease->end_date)) : '-' }}
                                        </td>
                                        <td>
                                            {!! strtotime($lease->end_date) > strtotime(now()) ? "<span class='text-success'>Running</span>" : "<span class='text-danger'>Expired</span>" !!}
                                        </td>
                                        <td >
                                            <a class="tooltip mr-3 text-danger popup-with-zoom-anim" href="#leaseModal_{{$lease->id}}" >
                                                <i class="sl sl-icon-eye"></i>
                                            </a>
                                            <div id="leaseModal_{{$lease->id}}" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

                                            </div>

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Property</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
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
        });
    </script>
@endsection
