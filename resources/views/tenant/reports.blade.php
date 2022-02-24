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
                        <h2>Reports</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="{{route('profile')}}">Home</a></li>
                                <li>Reports</li>
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
            <div class="col-md-9 ">
                <div class="utf-inner-list-headline-item">
                    <h3>Reports</h3>
                </div>
                <div class="style-2">
                    <!-- Tabs Navigation -->
                    <ul class="tabs-nav">
                        <li class="active"><a href="#tab1a"><i class=" icon-material-outline-assignment"></i> Invoice</a></li>
                        <li><a href="#tab2a"><i class="icon-material-outline-local-offer"></i> Receipt</a></li>
                    </ul>
                    <div class="tabs-container">
                        <div class="tab-content" id="tab1a" style="display: inline-block;">
                            <div class="table-responsive mt-5">

                                <table id="example" class="table-bordered table table-hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Due Date</th>
                                        <th>Invoice No.</th>
                                        <th>Amount</th>
                                        <th>Amount Paid</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $s = 1;
                                    @endphp
                                    @foreach(Auth::user()->getTenantInvoices as $invoice)
                                        <tr>
                                            <td>{{$s++}}</td>
                                            <td>{{!is_null($invoice->due_date) ? date('d M, Y', strtotime($invoice->due_date)) : '-'}}</td>
                                            <td>{{$invoice->invoice_no ?? ''}}</td>
                                            <td class="text-right">{{'₦'.number_format($invoice->total,2)}}</td>
                                            <td class="text-right text-success">{{'₦'.number_format($invoice->paid_amount,2)}}</td>
                                            <td class="text-right text-warning">{{'₦'.number_format(($invoice->total) - ($invoice->paid_amount),2)}}</td>
                                            <td>
                                                @switch($invoice->status)
                                                    @case(0)
                                                    <label for="" class="text-warning">Pending</label>
                                                    @break
                                                    @case(1)
                                                    <label for="" class="text-success">Fully-paid</label>
                                                    @break
                                                    @case(2)
                                                    <label for="" class="text-info">Partly-paid</label>
                                                    @break
                                                    @case(3)
                                                    <label for="" class="text-danger">Declined</label>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="account-title">
                                                    <a href="{{route('my-invoice-details', $invoice->slug)}}" class="tooltip">
                                                        <i class="icon-feather-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Due Date</th>
                                        <th>Invoice No.</th>
                                        <th>Amount</th>
                                        <th>Amount Paid</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-content" id="tab2a" style="display: none;">
                            <div class="table-responsive">
                                <table id="started" class="table table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Receipt No.</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Trans. Ref.</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach(Auth::user()->getTenantReceipts as $receipt)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td>{{!is_null($receipt->payment_date) ? date('d M, Y', strtotime($receipt->payment_date)) : '-'}}</td>
                                            <td>{{$receipt->receipt_no ?? ''}}</td>
                                            <td class="text-right">{{'₦'.number_format($receipt->total,2)}}</td>
                                            <td>
                                                @switch($receipt->payment_method)
                                                    @case(1)
                                                    Cash
                                                    @break
                                                    @case(2)
                                                    Cheque
                                                    @break
                                                    @case(3)
                                                    Bank Transfer
                                                    @break
                                                    @case(4)
                                                    Online
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>{{ strtoupper($receipt->trans_ref) ?? ''}}</td>
                                            <td>
                                                <div class="account-title">
                                                    <a href="{{route('my-receipt-details', $receipt->trans_ref)}}" class="tooltip">
                                                        <i class="icon-feather-eye"></i>

                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Receipt No.</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Trans. Ref.</th>
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

@endsection

@section('extra-scripts')
    <script src="/js/custom/datatable.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
            $('#started').DataTable();
        });
    </script>
@endsection
