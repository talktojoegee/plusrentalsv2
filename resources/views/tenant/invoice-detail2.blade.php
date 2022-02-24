@extends('layouts.tenant-layout')

@section('title')
    Invoice Details
@endsection

@section('meta-title')
    Invoice Details
@endsection

@section('meta-keywords')
    Invoice Details
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/profile.css">
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
@section('current-page')
    Invoice Details
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
    @include('tenant.partials._dash-header2')
    <section class="profile-part">
        <div class="container">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                            <input type="hidden" name="invoice" value="{{$invoice->id}}">
                        <div class="invoice-box" id="receiptWrapper">
                            <table cellpadding="0" cellspacing="0">
                                <tr class="top">
                                    <td colspan="6">
                                        <table>
                                            <tr>
                                                <td class="title">
                                                    <img src="#" style="width: 100%; max-width: 300px" />
                                                </td>

                                                <td>
                                                    Invoice #: {{$invoice->invoice_no ?? ''}}<br />
                                                    Issue Date: {{!is_null($invoice->issue_date) ? date('d M, Y', strtotime($invoice->issue_date)) : '-' }}<br />
                                                    Due Date: {{!is_null($invoice->due_date) ? date('d M, Y', strtotime($invoice->due_date)) : '-' }}<br />

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

                                                <td>
                                                    {{$invoice->getTenant->getApplicant->first_name ?? ''}} {{$invoice->getTenant->getApplicant->surname ?? ''}}<br />
                                                    {{$invoice->getTenant->getApplicant->mobile_no ?? ''}}<br />
                                                    {{$invoice->getTenant->getApplicant->email ?? ''}}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="heading">
                                    <td colspan="6" style="text-align: center;">
                                        Invoice
                                    </td>
                                </tr>
                                <tr class="heading">
                                    <td colspan="2">Payment Method</td>
                                    <td colspan="4">
                                        @switch($invoice->payment_method)
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
                                <tr class="item">
                                    <td colspan="6">{{$invoice->getProperty->property_name }}</td>
                                </tr>
                                <tr class="heading">
                                    <td style="width:15px;">#</td>
                                    <td style="width:180px; text-align:left;">Service</td>
                                    <td style="width: 10px;">Quantity</td>
                                    <td style="text-align: right;">Amount</td>
                                    <td style="width:90px; text-align:right;">Total</td>
                                    <td></td>
                                </tr>
                                @php $serial = 1; @endphp
                                @foreach($invoice->getInvoiceItems as $item)
                                    <tr class="item">
                                        <td>{{$serial++}}</td>
                                        <td style="text-align: left;">{{$item->getService->service_name ?? '' }}</td>
                                        <td>{{$item->quantity ?? '' }}</td>
                                        <td class="" style="text-align: right;">{{number_format($item->unit_cost,2) ?? '' }}</td>
                                        <td class="" style="text-align: right;">{{number_format($item->amount,2) ?? '' }}</td>
                                    </tr>
                                @endforeach
                                <tr class="total">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>VAT :</strong> {{'₦'.number_format($invoice->vat,2)}}</td>
                                </tr>
                                <tr class="total">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Sub total:</strong> {{'₦'.number_format($invoice->sub_total,2)}}</td>
                                </tr>
                                <tr class="total">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td><strong>Total:</strong> {{'₦'.number_format($invoice->total,2)}}</td>
                                </tr>
                                <tr class="total">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Balance:</strong> {{'₦'.number_format(($invoice->total) - ($invoice->paid_amount) ,2)}}</td>
                                </tr>
                                <tr class="">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                        @if(($invoice->total) - ($invoice->paid_amount) <= 0)
                                            <p class="text-center text-danger">Payment completed</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div class="card mt-3">
                            <div class="card-block">
                                <div class="account-title">
                                    <div class="btn-group">
                                        <button type="button"  onclick="generatePDF()" id="printReceiptBtn" class="tooltip mr-2">
                                            <i class="fas fa-print"></i>
                                            <span class="tooltext top">Print</span>
                                        </button>
                                        <button type="button" class="tooltip mr-2">
                                            <i class="fas fa-envelope"></i>
                                            <span class="tooltext top">Email</span>
                                        </button>
                                        @if(($invoice->paid_amount) < ($invoice->total) )
                                            <button type="button" class="tooltip mr-2">
                                                <i class="ti-wallet"></i>
                                                <span class="tooltext top">Make Payment</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('extra-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
    <script>
        function generatePDF(){
            var element = document.getElementById('receiptWrapper');
            html2pdf(element,{
                margin:       10,
                filename:     "Invoice_No_{{$invoice->invoice_no}}"+".pdf",
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            });
        }
    </script>
@endsection
