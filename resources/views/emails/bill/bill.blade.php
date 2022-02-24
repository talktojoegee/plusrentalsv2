<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{{$bill->getCompany->company_name.' - Invoice'}}</title>

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
                            <img src="/assets/drive/{{$bill->getCompany->logo ?? 'connexxion.png'}} " style="width: 100%; max-width: 300px" />
                        </td>

                        <td>
                            Bill #: {{$bill->bill_no ?? ''}}<br />
                            Date Issued: {{!is_null($bill->issue_date) ? date('d M, Y', strtotime($bill->issue_date)) : '-' }}<br />
                            Due Date: {{!is_null($bill->due_date) ? date('d M, Y', strtotime($bill->due_date)) : '-' }}<br />

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
                            {{$bill->getCompany->company_name ?? ''}}<br />
                            {{$bill->getCompany->address_1 ?? ''}}<br />
                            {{$bill->getCompany->mobile_no ?? ''}}, {{$bill->getCompany->email ?? ''}}
                        </td>

                        <td>
                            @if($bill->vendor_type == 1)
                                {{$vendor->first_name ?? ''}} {{$vendor->surname ?? ''}}
                            @else
                                {{$vendor->company_name ?? ''}}
                            @endif<br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>
            <td colspan="5">
                @switch($bill->payment_method)
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
        @foreach($bill->getBillItems as $item)
            <tr class="item">
                <td>{{$serial++}}</td>
                <td>{{$item->service_description ?? '' }}</td>
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
            <td>Sub total: {{'₦'.number_format($bill->sub_total,2)}}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total: {{'₦'.number_format($bill->total,2)}}</td>
        </tr>
    </table>
</div>
</body>
</html>
