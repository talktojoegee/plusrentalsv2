@extends('layouts.master-layout')
@section('title')
    Accounting Settings
@endsection

@section('current-page')
    Accounting Settings
@endsection
@section('current-page-brief')
    This section allows you to assign accounts to different transactions on the <strong>{{config('app.name')}}.</strong> Doing that helps the system
     automate some of your processes.
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('lease-applications')}}"><i class="icofont icofont-tags"></i>Manage Accounts</a>
        <a class="btn btn-primary btn-mini" href="{{route('new-chart-of-account')}}"><i class="icofont icofont-tasks"></i>Add New Account</a>

    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-block">
                    <div class="col-lg-12 col-xl-12">
                        <div class="sub-title">Account Settings</div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs  tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#accounts" role="tab">Accounts & Transaction Defaults</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#payment-integration" role="tab">Payment Integration Setup</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs card-block">
                            <div class="tab-pane active" id="accounts" role="tabpanel">
                                <h5 class="sub-title text-primary">Accounts & Transaction Defaults</h5>
                                @if (session()->has('success'))
                                    <div class="alert alert-success background-success">
                                        {!! session()->get('success') !!}
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-warning backgalert-warning">
                                        {!! session()->get('error') !!}
                                    </div>
                                @endif
                                @if (count($accounts) <= 0)
                                    <div class="alert alert-warning backgalert-warning">
                                        You currently have no charts of account. Quickly setup your chart of account before you proceed.
                                    </div>
                                @endif
                                <form action="{{route('store-account-settings')}}" method="POST">
                                    @csrf
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Transaction</th>
                                                    <th>General Ledger Account</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if($exist == 1)
                                                        @foreach($defaults as $default)
                                                            <tr>
                                                                <td>{{ucfirst(current(explode("_", $default->transaction)))}} Default GL Account
                                                                    <input type="hidden" name="transaction[]" value="{{$default->transaction}}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select name="account[]"  class="form-control js-example-basic-single col-md-5 col-sm-5 col-lg-5">
                                                                            <option disabled selected>Select account</option>
                                                                            @foreach ($accounts as $account)
                                                                                <option {{$default->glcode == $account->glcode ? 'selected' : ''}} value="{{$account->glcode}}">{{$account->account_name ?? ''}} - ({{$account->glcode}})</option>
                                                                            @endforeach
                                                                        </select> <br>
                                                                        <br>
                                                                        @error('tenant_account')
                                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                                        @enderror
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        @endforeach
                                                    @elseif($exist == 0)
                                                        @foreach($transactions as $transaction)
                                                            <tr>
                                                                <td>{{ucfirst(current(explode("_", $transaction)))}} Default Account
                                                                    <input type="hidden" name="transaction[]" value="{{$transaction}}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <select name="account[]"  class="form-control js-example-basic-single col-md-5 col-sm-5 col-lg-5">
                                                                            <option disabled selected>Select account</option>
                                                                            @foreach ($accounts as $account)
                                                                                <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - ({{$account->glcode}})</option>
                                                                            @endforeach
                                                                        </select> <br>
                                                                        <small class="text-muted"><label for="" class="label label-info">Previous selection: </label>
                                                                            <i>No account assigned yet</i>
                                                                        </small>
                                                                        <br>
                                                                        @error('property_account')
                                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                                        @enderror
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="btn-group d-flex justify-content-center">
                                                <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i> Cancel</a>
                                                <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i>Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="payment-integration">
                                <h5 class="sub-title">Payment Gateway Integration</h5>
                                <p><strong class="text-danger">Note:</strong> You required to visit <a href="" target="_blank">Paystack.com</a> to create an account if
                                you don't have one. Navigate to settings. Then API & Webhook. Copy your <strong>LIVE</strong> keys and paste them in the fields
                                provided below respectively.</p>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <form action="{{route('payment-integration-setup')}}" autocomplete="off" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Live Public Key</label>
                                                <input type="text" value="{{old('public_key', Auth::user()->getCompanyPaymentIntegration->ps_public_key ?? '') }}" name="public_key" placeholder="Live Public Key" class="form-control">
                                                @error('public_key')
                                                <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Live Secret Key</label>
                                                <input type="text" value="{{old('secret_key', Auth::user()->getCompanyPaymentIntegration->ps_secret_key ?? '')}}" name="secret_key" placeholder="Live Secret Key" class="form-control">
                                                @error('secret_key')
                                                <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Callback URL</label>
                                                <input type="text" value="127.0.0.1:80000" readonly name="secret_key" placeholder="Live Secret Key" class="form-control">
                                               <p> <i class="text-danger">Note:</i> Use the URL provided in the box above as your Callback URL in your paystack payment integration setup on your account.</p>
                                            </div>
                                            <div class="form-group d-flex justify-content-center">
                                                <button type="submit" class="btn-primary btn btn-mini"><i class="ti-check mr-2"></i> Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
