@extends('layouts.master-layout')
@section('title')
    Raise New Bill
@endsection

@section('current-page')
    Raise New Bill
@endsection
@section('current-page-brief')

@endsection

@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            @include('manager.vendors.bills.partials._menu')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Raise New Bill</h5>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                @if(session()->has('success'))
                                    <div class="alert alert-success background-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled text-white"></i>
                                        </button>
                                        {!! session()->get('success') !!}
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-warning background-warning">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled text-white"></i>
                                        </button>
                                        {!! session()->get('error') !!}
                                    </div>
                                @endif
                                <form action="{{route('generate-new-bill')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Bill Type</label>
                                                <select name="bill_type" id="bill_type" class="form-control js-example-basic-single" value="{{old('bill_type')}}">
                                                    <option disabled selected>-- Select bill type --</option>
                                                    <option value="1">Property related</option>
                                                    <option value="2">Others</option>
                                                </select>
                                                @error('bill_type')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Vendor</label>
                                                <select name="vendor" id="vendor" class="form-control js-example-basic-single" value="{{old('bill_type')}}">
                                                    <option disabled selected>-- Select vendor --</option>
                                                    @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->id}}">{{$vendor->vendor_type == 1 ? $vendor->first_name.' '.$vendor->surname : $vendor->company_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('vendor')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 property-wrapper">
                                            <div class="form-group">
                                                <label for="">Property</label>
                                                <select name="property" id="property" class="form-control js-example-basic-single" value="{{old('property')}}">
                                                    <option disabled selected>-- Select property --</option>
                                                    @foreach($properties as $property)
                                                        <option value="{{$property->id}}">{{$property->property_name ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('property')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-8">
                                            <div class="form-group">
                                                <label>Bill Period</label>
                                                <div class="input-group input-group-button">
                                                <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                                    <span class="">Issue Date</span>
                                                </span>
                                                    <input type="date" class="form-control" name="issue_date" placeholder="Issue Date">
                                                    <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                                    <span class="">Due Date</span>
                                                </span>
                                                    <input type="date" class="form-control" name="due_date" placeholder="Due Date">
                                                </div>
                                                @error('due_date') <small class="form-text text-danger">{{$message}}</small> @enderror
                                                <br>
                                                @error('issue_date') <small class="form-text text-danger">{{$message}}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table  invoice-detail-table">
                                                        <thead>
                                                        <tr class="thead-default">
                                                            <th>Product/Service</th>
                                                            <th>Quantity</th>
                                                            <th>Amount</th>
                                                            <th>Total</th>
                                                            <th class="text-danger">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="products">
                                                        <tr class="item">
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" placeholder="Product/Service" name="service[]">
                                                                    @error('service')
                                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                                    @enderror
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="number" placeholder="Quantity" name="quantity[]" class="form-control">
                                                                @error('quantity')
                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <input type="number" placeholder="Amount" step="0.01" class="form-control" name="amount[]">
                                                                @error('amount')
                                                                <i class="text-danger mt-2">{{$message}}</i>
                                                                @enderror
                                                            </td>
                                                            <td><input type="text" class="form-control aggregate" name="total[]" readonly style="width: 120px;"></td>
                                                            <td>
                                                                <i class="ti-trash text-danger remove-line" style="cursor: pointer;"></i>
                                                            </td>

                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <button class="btn btn-mini btn-warning add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <table class="table table-responsive invoice-table invoice-total">
                                                <tbody>
                                                <tr>
                                                    <th>Sub Total :</th>
                                                    <td> <span  class="sub-total">0.00</span> </td>
                                                </tr>
                                                <tr>
                                                    <th>Taxes (%) :</th>
                                                    <td>
                                                        <input type="text" placeholder="Tax Rate" step="0.01" class="form-control" id="tax_rate" name="tax_rate">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tax amount</th>
                                                    <td>
                                                        <input type="text" readonly placeholder="Tax Amount" class="form-control" id="tax_amount" name="tax_amount">
                                                    </td>
                                                </tr>
                                                <tr class="text-info">
                                                    <td>
                                                        <hr>
                                                        <h5 class="text-primary">Total :</h5>
                                                    </td>
                                                    <td>
                                                        <hr>
                                                        <h5 class="text-primary"> <span></span> <span class="total">0.00</span></h5>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tenant-wrapper').hide();
            $('#applicant-wrapper').hide();
            $('.property-wrapper').hide();
            $('.js-example-basic-single').select2();
            $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());
            $(document).on('change', '#bill_type', function(e){
                e.preventDefault();
                console.log($(this).val());
                switch($(this).val()){
                    case '1':
                        $('.property-wrapper').show();
                        $('.js-example-basic-single').select2();
                        break;
                    case '2':
                        $('.property-wrapper').hide();
                        $('.js-example-basic-single').select2();
                        break;
                }
            });
            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                var new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".select-product").select2({
                    placeholder: "Select service"
                });
                $(".select-product").last().next().next().remove();
            });
            //Remove line
            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                calculateTotals();
            });

        });

        function setTotal(){
            var sum = 0;
            $(".payment").each(function(){
                sum += +$(this).val().replace(/,/g, '');
                $(".total").text(sum.toLocaleString());
            });
        }
        //calculate totals
        function calculateTotals(){
            const subTotals = $('.item').map((idx, val)=> calculateSubTotal(val)).get();
            const total = subTotals.reduce((a, v)=> a + Number(v), 0);
            grand_total = total;
            $('.sub-total').text(grand_total.toLocaleString());
            $('#subTotal').val(total);
            $('#totalAmount').val(grand_total);
            $('.total').text(total.toLocaleString());
            $('.balance').text(total.toLocaleString());
        }

        //calculate subtotals
        function calculateSubTotal(row){
            const $row = $(row);
            const inputs = $row.find('input');
            const subtotal = inputs[0].value * inputs[1].value;
            $row.find('td:nth-last-child(2) input[type=text]').val(subtotal);
            return subtotal;
        }

        $('.aggregate').on('change', function(e){
            e.preventDefault();
            setTotal();
        });
    </script>
@endsection
