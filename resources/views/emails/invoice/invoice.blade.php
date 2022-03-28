<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{{$invoice->getCompany->company_name.' - Invoice'}}</title>

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
</head>

<body>
<div class="invoice-box" id="receiptWrapper">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="6">
                <table>
                    <tr>
                        <td class="title">
                            <img src="/assets/drive/{{$invoice->getCompany->logo ?? 'connexxion.png'}} " style="width: 100%; max-width: 300px" />
                        </td>

                        <td>
                            Invoice #: {{$invoice->invoice_no ?? ''}}<br />
                            Date Issued: {{!is_null($invoice->issue_date) ? date('d M, Y', strtotime($invoice->issue_date)) : '-' }}<br />
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
                            {{$invoice->getCompany->company_name ?? ''}}<br />
                            {{$invoice->getCompany->address_1 ?? ''}}<br />
                            {{$invoice->getCompany->mobile_no ?? ''}}, {{$invoice->getCompany->email ?? ''}}
                        </td>

                        <td>
                            @if($invoice->invoice_type == 2 || $invoice->invoice_type == 3)
                                {{$invoice->getTenant->getApplicant->title ?? ''}} {{$invoice->getTenant->getApplicant->first_name ?? '-'}} {{$invoice->getTenant->getApplicant->surname ?? '-'}}
                            @else
                                {{$invoice->getApplicant->title ?? ''}} {{$invoice->getApplicant->first_name ?? ''}} {{$invoice->getApplicant->surname ?? '-'}}
                            @endif<br />
                            @if($invoice->invoice_type == 2 || $invoice->invoice_type == 3)
                                {{$invoice->getTenant->getApplicant->mobile_no ?? ''}}
                            @else
                                {{$invoice->getApplicant->mobile_no ?? ''}}
                            @endif
                            <br />
                            @if($invoice->invoice_type == 2 || $invoice->invoice_type == 3)
                                {{$invoice->getTenant->getApplicant->email ?? ''}}
                            @else
                                {{$invoice->getApplicant->email ?? ''}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>
            <td colspan="5">
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
        @foreach($invoice->getInvoiceItems as $item)
            <tr class="item">
                <td>{{$serial++}}</td>
                <td>{{$item->getService->service_name ?? '' }}</td>
                <td>{{$item->quantity ?? '' }}</td>
                <td class="">{{number_format($item->unit_cost,2) ?? '' }}</td>
                <td class="">{{number_format($item->amount,2) ?? '' }}</td>
            </tr>
        @endforeach
        <tr class="">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Sub total: {{'₦'.number_format($invoice->sub_total,2)}}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total: {{'₦'.number_format($invoice->total,2)}}</td>
        </tr>
    </table>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center contain">
            <a href="{{route('online-payment', $invoice->slug)}}" style="text-decoration: none; padding: 5px; border-radius: 10px; border: 1px solid #fff; color: #fff; background: #FC6E51; width: 200px; height: 84px;"  class="btn btn-primary btn-sm">Make Payment</a>
        </div>
    </div>
</div>
</body>
</html>
