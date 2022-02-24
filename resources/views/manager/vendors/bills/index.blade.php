@extends('layouts.master-layout')
@section('title')
    All Bills
@endsection

@section('current-page')
    All Bills
@endsection
@section('current-page-brief')

@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-sm-4">
            <div class="card bg-c-pink text-white widget-visitor-card">
                <div class="card-block-small text-center">
                    <h2>{{'₦'.number_format($bills->where('posted',2)->sum('total'))}}</h2>
                    <h6>Declined</h6>
                    <i class="icofont icofont-ban"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-c-blue text-white widget-visitor-card">
                <div class="card-block-small text-center">
                    <h2>{{'₦'.number_format($bills->where('posted',1)->sum('paid_amount'))}}</h2>
                    <h6>Paid</h6>
                    <i class="icofont icofont-ui-check"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-c-yellow text-white widget-visitor-card">
                <div class="card-block-small text-center">
                    <h2>{{'₦'.number_format(($bills->where('posted',1)->sum('total')) - ($bills->where('posted',1)->sum('paid_amount')))}}</h2>
                    <h6>Pending</h6>
                    <i class="icofont icofont-spinner-alt-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('manager.vendors.bills.partials._menu')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <p>List of all bills</p>
                            @if (session()->has('success'))
                                <div class="alert alert-success background-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('success') !!}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-warning background-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {!! session()->get('error') !!}
                                </div>
                            @endif
                            <div class="table-responsive">

                                <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">S/No.</th>
                                        <th class="sorting_asc">Date</th>
                                        <th class="sorting">Bill No.</th>
                                        <th class="sorting">Vendor</th>
                                        <th class="sorting">Total</th>
                                        <th class="sorting">Amount Paid</th>
                                        <th class="sorting">Balance</th>
                                        <th class="sorting">Status</th>
                                        <th class="sorting">Trans. Ref</th>
                                        <th class="sorting">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach($bills as $bill)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td>{{!is_null($bill->created_at) ? date('d M,Y', strtotime($bill->created_at)) : '-'}}</td>
                                            <td>{{$bill->bill_no ?? ''}}</td>
                                            <td>
                                                {{$bill->getVendor->vendor_type == 1 ? $bill->getVendor->first_name.' '.$bill->getVendor->surname : $bill->getVendor->company_name }}
                                            </td>
                                            <td class="text-right">{{number_format($bill->total,2)}}</td>
                                            <td class="text-right text-success">{{number_format($bill->paid_amount,2)}}</td>
                                            <td class="text-right text-warning">{{number_format($bill->total - $bill->paid_amount,2)}}</td>
                                            <td>
                                                @switch($bill->status)
                                                    @case(0)
                                                    <label for="" class="label label-warning">Pending</label>
                                                    @break
                                                    @case(1)
                                                    <label for="" class="label label-success">Fully-paid</label>
                                                    @break
                                                    @case(2)
                                                    <label for="" class="label label-info">Partly-paid</label>
                                                    @break
                                                    @case(3)
                                                    <label for="" class="label label-danger">Declined</label>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>{{$bill->ref_no ?? ''}}</td>
                                            <td>
                                                <div class="dropdown-secondary dropdown">
                                                    <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect" href="{{route('view-bill', $bill->slug)}}"><i class="ti-printer"></i> View Bill</a>
                                                        @if($bill->posted == 1 && $bill->paid_amount < $bill->total)
                                                            <a class="dropdown-item waves-light waves-effect" href="{{route('make-payment', $bill->slug)}}"><i class="ti-receipt"></i> Make Payment</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th >S/No.</th>
                                        <th >Date</th>
                                        <th >Bill No.</th>
                                        <th >Vendor</th>
                                        <th >Total</th>
                                        <th >Amount Paid</th>
                                        <th >Balance</th>
                                        <th>Status</th>
                                        <th >Trans. Ref.</th>
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
