@extends('layouts.master-layout')
@section('title')
    Payment Detail
@endsection

@section('current-page')
    Payment Detail
@endsection
@section('current-page-brief')
    Details of payment #{{$payment->payment_no ?? ''}}
@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('manage-payments')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Payments</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
@endsection
@section('main-content')
    <div class="row" >
        <div class="col-lg-12 col-xl-12">
            <div class="invoice-box" id="receiptWrapper">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="6">
                            <table>
                                <tr>
                                    <td class="title">
                                        <img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" />
                                    </td>

                                    <td class="text-left">
                                        Payment #: {{$payment->payment_no ?? ''}}<br />
                                        Bill #: {{$payment->getBill->bill_no ?? ''}}<br />
                                        Payment Date: {{!is_null($payment->payment_date) ? date('d M, Y', strtotime($payment->payment_date)) : '-' }}<br />
                                        Date Issued: {{!is_null($payment->created_at) ? date('d M, Y', strtotime($payment->created_at)) : '-' }}<br />

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="information">
                        <td colspan="6">
                            <table>
                                <tr>
                                    <td>
                                        Connexxion Group<br />
                                        12345 Sunny Road<br />
                                        2A Iller Crescent Maitama, Abuja.
                                    </td>

                                    <td class="text-left">
                                        {{$payment->getVendor->vendor_type == 1 ? $payment->getVendor->first_name .' '.$payment->getVendor->surname : $payment->getVendor->company_name }} <br />
                                        {{$payment->getVendor->mobile_no ?? ''}}<br />
                                        {{$payment->getVendor->email ?? ''}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="heading">
                        <td>Payment Method</td>
                        <td colspan="5">
                            @switch($payment->payment_method)
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
                                Internet Transfer
                                @break
                            @endswitch
                        </td>
                    </tr>
                    <tr class="heading">
                        <td>#</td>
                        <td>Service</td>
                        <td>Quantity</td>
                        <td>Amount</td>
                        <td>Total</td>
                        <td></td>
                    </tr>
                    @php
                        $serial = 1;
                    @endphp
                    @foreach($payment->getBill->getBillItems as $item)
                        <tr class="item">
                            <td>{{$serial++}}</td>
                            <td class="text-left">{{$item->service_description ?? '' }}</td>
                            <td>{{$item->quantity ?? '' }}</td>
                            <td class="">{{number_format($item->unit_cost,2) ?? '' }}</td>
                            <td class="">{{number_format($item->amount,2) ?? '' }}</td>
                        </tr>
                    @endforeach
                    <tr class="total">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Sub total: {{'₦'.number_format($payment->sub_total,2)}}</td>
                    </tr>
                    <tr class="total">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total: {{'₦'.number_format($payment->total,2)}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 d-flex justify-content-center">
            <div class="card mt-3">
                <div class="card-block">
                    <div class="btn-group">
                        <a href="{{url()->previous()}}" class="btn btn-mini btn-warning"><i class="icofont icofont-square-left mr-2"></i> Back</a>
                        @if($payment->posted == 1)
                            <button class="btn btn-mini btn-primary" onclick="generatePDF()"><i class="ti-printer mr-2"></i> Print</button>
                            <button class="btn btn-secondary btn-mini"><i class="icofont icofont-ui-email mr-2"></i> Email</button>
                        @endif
                        @if($payment->posted == 0 && $payment->trashed == 0)
                            <a href="{{route('decline-payment', $payment->trans_ref)}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Decline Payment</a>
                            <a href="{{route('approve-payment', $payment->trans_ref)}}" class="btn btn-success btn-mini"><i class="ti-check mr-2"></i> Approve Payment</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
    <script>
        function generatePDF(){
            var element = document.getElementById('receiptWrapper');
            html2pdf(element,{
                margin:       10,
                filename:     "Payment_No_{{$payment->payment_no}}"+".pdf",
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            });
        }
    </script>
@endsection
