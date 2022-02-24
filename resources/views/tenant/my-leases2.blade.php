@extends('layouts.tenant-layout')

@section('title')
    My Leases
@endsection

@section('meta-title')
    My Leases
@endsection

@section('meta-keywords')
    My Leases
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/profile.css">
    <link rel="stylesheet" href="/css/custom/datatable.min.css">
@endsection
@section('current-page')
    My Leases
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
    @include('tenant.partials._dash-header2')
    <section class="profile-part">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h3> My Leases</h3>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction Date</th>
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
                                        <a href="{{route('listing-property-detail', $lease->getProperty->slug)}}">{{$lease->getProperty->property_name ?? ''}}</a>
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
                                            <a href="javascript:void(0);" class="tooltip mr-3 text-danger" data-target="#leaseModal_{{$lease->id}}" data-toggle="modal">
                                                <i class="fas fa-eye"></i>
                                                <span class="tooltext top">Details</span>
                                            </a>
                                            <div class="modal fade" id="leaseModal_{{$lease->id}}" tabindex="-1" role="dialog" aria-labelledby="leaseModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="exampleModalLabel_{{$lease->id}}">Lease Details</h6>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="account-card">
                                                                        <div class="account-title">
                                                                            <h3>Lease</h3>
                                                                        </div>
                                                                        <ul class="account-card-list">
                                                                            <li>
                                                                                <h5>Date:</h5>
                                                                                <p>{{date('d M, Y', strtotime($lease->created_at))}}</p>
                                                                            </li>
                                                                            <li>
                                                                                <h5>Start Date:</h5>
                                                                                <p class="text-success">{{date('d M, Y', strtotime($lease->start_date))}}</p>
                                                                            </li>
                                                                            <li>
                                                                                <h5>End Date:</h5>
                                                                                <p class="text-danger">{{date('d M, Y', strtotime($lease->end_date))}}</p>
                                                                            </li>
                                                                            <li>
                                                                                <h5>Trans. Ref.:</h5>
                                                                                <p class="">{{ strtoupper(substr($lease->active_subscription_key,4,23)) }}</p>
                                                                            </li>
                                                                            <li>
                                                                                <h5>Renewed By:</h5>
                                                                                <p class="">{{ Auth::user()->getApplicant->title ?? ' '.' '.Auth::user()->getApplicant->first_name .' '.Auth::user()->getApplicant->surname }}</p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="account-card">
                                                                        <div class="account-title">
                                                                            <h3>Property</h3>
                                                                        </div>
                                                                        <ul class="account-card-list">
                                                                            <li>
                                                                                <h5>Name:</h5>
                                                                                <p>{{$lease->getProperty->property_name ?? ''}}</p>
                                                                            </li>
                                                                            <li>
                                                                                <h5>Frequency</h5>
                                                                                <p>{{$lease->getProperty->getLeaseFrequency->frequency ?? ''}}</p>
                                                                            </li>
                                                                            <li>
                                                                                <h5>Amount</h5>
                                                                                <p>{{'₦'.number_format($lease->getProperty->rental_price,2)}}</p>
                                                                            </li>
                                                                            <li>
                                                                                <h5>Listing Type</h5>
                                                                                <p>{{$lease->getProperty->listing_type == 1 ? "For rent " : " For sale"}}</p>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                                            </div>
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
                                    <th>#</th>
                                    <th>Transaction Date</th>
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
    </section>
@endsection

@section('extra-scripts')
    <script src="/js/custom/datatable.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        });
    </script>
@endsection
