@extends('layouts.tenant-layout')

@section('title')
    Pay Rent
@endsection

@section('meta-title')
    Pay Rent
@endsection

@section('meta-keywords')
    Pay Rent
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/setting.css">
    <link rel="stylesheet" href="/css/custom/select2.min.css">
@endsection
@section('current-page')
    Pay Rent
@endsection
@section('breadcrumb')
    @include('partials.tenant._breadcrumb')
@endsection
@section('main-content')
    @include('tenant.partials._dash-header2')
    @if(session()->has('renew-success'))
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="alert alert-success">
                        {!! session()->get('renew-success') !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(strtotime(Auth::user()->end_date)  > strtotime(now()) && !is_null(Auth::user()->property_id) )
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="alert alert-success">
                    <strong>Good news!</strong> Your rent is still active. It will expire on {{!is_null(Auth::user()->end_date) ? date('d M, Y', strtotime(Auth::user()->end_date)) : '-' }} (<i><strong>{{\Carbon\Carbon::now()->diffInDays(Auth::user()->end_date)}} days</strong></i> from now). Your next lease period will be extended by {{\Carbon\Carbon::now()->diffInDays(Auth::user()->end_date)}} days.
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(strtotime(Auth::user()->end_date)  < strtotime(now()) && !is_null(Auth::user()->property_id) )
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="alert alert-warning">
                    <strong>Ooops!</strong> Your rent is due for payment. It expired on {{!is_null(Auth::user()->end_date) ? date('d M, Y', strtotime(Auth::user()->end_date)) : '-' }} (<i><strong>{{\Carbon\Carbon::now()->diffInDays(Auth::user()->end_date)}} days</strong></i> ago). Your next lease period will be shortened by {{\Carbon\Carbon::now()->diffInDays(Auth::user()->end_date)}} days.
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(session()->has('danger') )
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="alert alert-danger">
                    {!! session()->get('danger') !!}
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session()->has('error') )
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="alert alert-warning">
                    {!! session()->get('error') !!}
                </div>
            </div>
        </div>
    </div>
    @endif
     <div class="setting-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Pay Rent</h3>
                                <p>Kindly preview your current lease plan before proceeding to pay rent.</p>
                            </div>
                            <form class="setting-form" action="{{route('make-payment')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Property Name<sup class="text-danger">*</sup></label>
                                            <input type="text" readonly name="property_name" value="{{$property->property_name ?? ''}}" class="form-control" placeholder="Property Name">
                                            @error('property_name')
                                                <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Lease Plan<sup class="text-danger">*</sup></label>
                                            <input type="text" readonly class="form-control" placeholder="Lease Plan" name="lease_plan" value="{{$property->getLeaseFrequency->frequency ?? ''}}">
                                            @error('lease_plan')
                                                <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Lease Amount<sup class="text-danger">*</sup></label>
                                            <input type="text" readonly name="lease_amount" value="{{'₦'.number_format($property->rental_price,2)}}" class="form-control" placeholder="Lease Amount">
                                            @error('lease_amount')
                                                <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Late Fee<sup class="text-danger">*</sup></label>
                                            <input type="text" readonly class="form-control" placeholder="Late Fee" name="late_fee" value="{{'₦'.number_format($property->late_fee,2)}}">
                                            @error('late_fee')
                                                <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>

                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Security Deposit<sup class="text-danger">*</sup></label>
                                            <input type="text"  readonly class="form-control" placeholder="Security Deposit" name="security_deposit" value="{{'₦'.number_format($property->security_deposit,2)}}">
                                            @error('security_deposit')
                                                <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">End Date<sup class="text-danger">*</sup></label>
                                            <input type="text" readonly class="form-control" placeholder="End Date" name="end_date" value="{{!is_null(Auth::user()->end_date) ? date('d M, Y', strtotime(Auth::user()->end_date)) : '-'}}">
                                            @error('end_date')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="account-title">
                                            <h3>Forecast</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Start Date<sup class="text-danger">*</sup></label>
                                            <input type="text" readonly class="form-control" placeholder="Start Date" name="start_date" value="{{ date('d M, Y', strtotime(now())) }}">
                                            @error('start_date')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Next End Date <sup class="text-danger">*</sup></label>
                                            @php
                                                $daysLeft = strtotime(Auth::user()->end_date)  >
                                                strtotime(now())  ? \Carbon\Carbon::now()->diffInDays(Auth::user()->end_date) : 0;
                                                $daysPass = strtotime(Auth::user()->end_date)  <
                                                strtotime(now())  ? \Carbon\Carbon::now()->diffInDays(Auth::user()->end_date) : 0;
                                                $total = strtotime(Auth::user()->end_date)  <
                                                strtotime(now())
                                                ? ($property->rental_price + $property->late_fee + $property->security_deposit)
                                                : ($property->rental_price + $property->security_deposit);
                                            @endphp
                                            <input type="text" readonly class="form-control" placeholder="Next End Date " name="next_end_date" value="{{
                                                strtotime(Auth::user()->end_date)  >
                                                strtotime(now())
                                                ? date('d M, Y', strtotime(\Carbon\Carbon::parse(Auth::user()->end_date)->addDays( $daysLeft + $property->getLeaseFrequency->duration )   ))
                                                : date('d M, Y', strtotime(\Carbon\Carbon::now()->addDays( $property->getLeaseFrequency->duration - $daysPass) ))
                                                }}">
                                            @error('next_end_date')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror

                                            <input type="hidden" name="email" value="{{Auth::user()->email ?? ''}}">
                                            <input type="hidden" name="amount" value="{{ ($total * 100) ?? 0}}">
                                            <input type="hidden" name="currency" value="NGN">
                                            <input type="hidden" name="metadata[]" value="{{ json_encode($array = ['tenant' => Auth::user()->id, 'property'=>Auth::user()->property_id, 'method'=>'online']) }}" >
                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                        </div>
                                    </div>
                                    @if(!is_null(Auth::user()->property_id))
                                        <div class="col-lg-12">
                                            <button class="btn btn-inline" type="submit">
                                                <i class="fas fa-wallet"></i>
                                                <span>Pay  {{'₦'.number_format($total, 2)}} Rent</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('extra-scripts')
<script src="/js/custom/select2.min.js"></script>
<script src="/js/custom/axios.min.js"></script>
<script>
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
        $(document).on('change', '#location', function(e){
            e.preventDefault();
            axios.post('/get-location', {location:$(this).val()})
            .then(response=>{
                $('#area-wrapper').html(response.data)
                   // $(".js-example-basic-single").select2();
            });
        });
    });
</script>

@endsection
