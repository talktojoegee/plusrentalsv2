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
    <link rel="stylesheet" href="/css/custom/datatable.min.css">
    <link rel="stylesheet" href="/css/custom/compare.css">
    <link rel="stylesheet" href="/css/custom/profile.css">
@endsection
@section('current-page')
    My Leases
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
<section class="compare-part">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="compare-list">
                    <table class="table-list" id="myLeases">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Property Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $serial = 1;
                        @endphp
                        @foreach($my_leases as $lease)
                            <tr>
                                <td class="table-number">
                                    <h5>{{$serial++}}</h5>
                                </td>
                                <td class="table-product">
                                    {{!is_null($lease->created_at) ? date('d M, Y', strtotime($lease->created_at)) : '-'}}
                                </td>
                                <td class="table-desc text-left ml-1 pl-1">
                                    <span>
                                        <a href="{{route('listing-property-detail', $lease->getProperty->slug)}}">{{$lease->getProperty->property_name ?? ''}}</a>
                                    </span>
                                </td>
                                <td class="table-price ">
                                    {{!is_null($lease->start_date) ? date('d M, Y', strtotime($lease->start_date)) : '-' }}
                                </td>
                                <td class="table-type">
                                    {{!is_null($lease->end_date) ? date('d M, Y', strtotime($lease->end_date)) : '-' }}
                                </td>
                                <td class="table-action">
                                    <a href="javascript:void(0);" class="tooltip" data-target="#leaseModal_{{$lease->id}}" data-toggle="modal">
                                        <i class="fas fa-eye"></i>
                                        <span class="tooltext top">Details</span>
                                    </a>
                                    <a href="javascript:void(0);" class="tooltip receipt-class" data-receiptcover="cover_{{$lease->id}}" data-id="{{$lease->id}}"  data-target="#printLeaseModal_{{$lease->id}}" data-toggle="modal">
                                        <i class="fa fa-barcode"></i>
                                        <span class="tooltext top">Receipt</span>
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
                                                                    <a href="setting.html" class="exclude">Detail</a>
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
                                                                        <h5>Late Fee</h5>
                                                                        <p>{{'₦'.number_format($lease->getProperty->late_fee,2)}}</p>
                                                                    </li>
                                                                    <li>
                                                                        <h5>Security Deposit</h5>
                                                                        <p>{{'₦'.number_format($lease->getProperty->security_deposit,2)}}</p>
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
                                    <div class="modal fade" id="printLeaseModal_{{$lease->id}}" tabindex="-1" role="dialog" aria-labelledby="printLeaseModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLabel_{{$lease->id}}">Print</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row" id="cover_{{$lease->id}}">

                                                        <div class="col-lg-12">
                                                            <div class="account-card">
                                                                <div class="account-title">
                                                                    <h3>Receipt</h3>
                                                                </div>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">First</th>
                                                                        <th scope="col">Last</th>
                                                                        <th scope="col">Handle</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <th scope="row">1</th>
                                                                        <td>Mark</td>
                                                                        <td>Otto</td>
                                                                        <td>@mdo</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">2</th>
                                                                        <td>Jacob</td>
                                                                        <td>Thornton</td>
                                                                        <td>@fat</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">3</th>
                                                                        <td>Larry</td>
                                                                        <td>the Bird</td>
                                                                        <td>@twitter</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" id="printReceiptBtn_{{$lease->id}}" ><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="compare-btn center-50">
                    <a href="{{route('pay-rent')}}" class="btn btn-inline">
                        <i class="fas fa-wallet"></i>
                        <span>Pay Rent</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra-scripts')
    <script src="/js/custom/datatable.min.js"></script>
    <script src="/js/custom/printThis.js"></script>
    <script>
        $(document).ready( function () {
            var container = null;
            var id = null;
            $('#myLeases').DataTable();
            $(document).on('click', '.receipt-class', function(e){
                e.preventDefault();
                container = $(this).data('receiptcover');
                id = $(this).data('id');
            });
            $(document).on("click", "#printReceiptBtn_"+id, function(event){
                event.preventDefault();
                $(container).printThis({
                    header:"<p></p>",
                    footer:"<p></p>",
                });
            });
        } );
    </script>
@endsection
