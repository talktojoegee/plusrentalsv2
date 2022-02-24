@extends('layouts.master-layout')
@section('title')
    Add New Vendor
@endsection

@section('current-page')
    Add New Vendor
@endsection
@section('current-page-brief')
    Add a new vendor to your account using the form below
@endsection

@section('event-area')
    @include('manager.vendors.partials._menu')
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Add New Rental Owner</h5>
                    <p>Register new rental owner or landlord to the system by filling the form below with the necessary information.
                        You can later assign this owner to a property within the system.</p>
                </div>
                <div class="card-block">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form autocomplete="off" action="{{route('add-new-vendor')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Type </label>
                                    <select name="vendor_type" id="vendor_type" class="form-control">
                                        <option disabled selected>--Select type</option>
                                        <option value="1">Individual Owner</option>
                                        <option value="2">Company/Trust</option>
                                    </select>
                                    @error('ownership_type')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row individual">

                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">First Name <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name')}}">
                                    @error('first_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Surname <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{old('surname')}}">
                                    @error('surname')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4 ">
                                <div class="form-group">
                                    <label for="">Category </label>
                                    <select name="category" id="category" class="form-control js-example-basic-single">
                                        <option disabled selected>--Select category--</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->profession_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Email Address <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{old('email')}}">
                                    @error('email')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Mobile No.<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Mobile No." name="mobile_no" value="{{old('mobile_no')}}">
                                    @error('mobile_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for=""> Address <sup class="text-danger">*</sup></label>
                                    <textarea style="resize: none;" name="address" id="address" placeholder="Type address here..." class="form-control">{{old('address')}}</textarea>
                                    @error('address')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row individual">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Use default vendor account<abbr title="Property default account will be used for this property.">?</abbr></label>
                                    <select name="default_account" id="default_account" class="form-control js-example-basic-single">
                                        <option disabled selected>-- Select account --</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                    @error('default_account')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4" style="display: none;" id="accountWrapper">
                                <div class="form-group">
                                    <label for="">GL Account</label>
                                    <select name="vendor_account" id="property_account" class="form-control js-example-basic-single">
                                        <option disabled selected>--Select property account--</option>
                                        @foreach($accounts as $account)
                                            <option value="{{$account->glcode ?? ''}}">{{$account->glcode ?? ''}} - {{$account->account_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_account')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row company">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" placeholder="Company Name" name="company_name" value="{{old('company_name')}}" class="form-control">
                                    @error('company_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Official Phone No.</label>
                                    <input type="text" placeholder="Official Phone No." name="official_phone_no" value="{{old('official_phone_no')}}" class="form-control">
                                    @error('official_phone_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Official Email</label>
                                    <input type="text" placeholder="Official Email" name="official_email" value="{{old('official_email')}}" class="form-control">
                                    @error('official_email')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row company">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Office Address</label>
                                    <textarea name="office_address" id="office_address" placeholder="Office Address" style="resize: none;" class="form-control"></textarea>
                                    @error('office_address')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4 ">
                                <div class="form-group">
                                    <label for="">Category </label>
                                    <select name="category"  class="form-control js-example-basic-single">
                                        <option disabled selected>--Select category--</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->profession_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Use default vendor account<abbr title="Vendor default account.">?</abbr></label>
                                    <select name="default_account" id="default_account_2" class="form-control js-example-basic-single">
                                        <option disabled selected>-- Select account --</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                    @error('default_account')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4" style="display: none;" id="accountWrapper_2">
                                <div class="form-group">
                                    <label for="">GL Account</label>
                                    <select name="vendor_account" id="" class="form-control js-example-basic-single">
                                        <option disabled selected>--Select property account--</option>
                                        @foreach($accounts as $account)
                                            <option value="{{$account->glcode ?? ''}}">{{$account->glcode ?? ''}} - {{$account->account_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_account')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{url()->previous()}}" class="btn btn-mini btn-danger"><i class="ti-close"></i> Cancel</a>
                                    <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script>
        $(document).ready(function(){
            $('.js-example-basic-single').select2();
            $('.individual').hide();
            $('.company').hide();
            $(document).on('change', '#default_account', function(e){
                e.preventDefault();
                if($(this).val() == 2){
                    $('#accountWrapper').show();
                    $('.js-example-basic-single').select2();
                }else{
                    $('#accountWrapper').hide();
                    $('.js-example-basic-single').select2();
                }
            });
            $(document).on('change', '#default_account_2', function(e){
                e.preventDefault();
                if($(this).val() == 2){
                    $('#accountWrapper_2').show();
                    $('.js-example-basic-single').select2();
                }else{
                    $('#accountWrapper_2').hide();
                    $('.js-example-basic-single').select2();
                }
            });
            $(document).on('change', '#vendor_type', function(e){
                e.preventDefault();

                if($(this).val() == 1){
                    $('.individual').show();
                    $('.company').hide();
                }else{
                    $('.company').show();
                    $('.individual').hide();
                }
            });
        });
    </script>
@endsection
