@extends('layouts.tenant-layout')

@section('title')
    Reports
@endsection

@section('meta-title')
    Reports
@endsection

@section('meta-keywords')
    Reports
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/profile.css">
    <link rel="stylesheet" href="/css/custom/datatable.min.css">
@endsection
@section('current-page')
    Reports
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
                            <h3>Reports</h3>
                            <a href="{{url()->previous()}}">Back</a>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Invoice</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#receipt" role="tab" aria-controls="profile" aria-selected="false">Receipt</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive mt-5">

                                    <table id="example" class="display" style="width:100%">
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
                                                            <i class="fas fa-eye"></i>
                                                            <span class="tooltext top">Details</span>
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
                            <div class="tab-pane fade" id="receipt" role="tabpanel" aria-labelledby="receipt-tab">
                                <div class="table-responsive mt-5">

                                    <table id="started" class="display" style="width:100%">
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
                                                            <i class="fas fa-eye"></i>
                                                            <span class="tooltext top">Details</span>
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
    </section>
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
