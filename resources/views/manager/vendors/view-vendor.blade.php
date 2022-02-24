@extends('layouts.master-layout')
@section('title')
    Vendor Details
@endsection

@section('current-page')
    Vendor Details
@endsection
@section('current-page-brief')
   Details of this vendor
@endsection

@section('event-area')
    @include('manager.vendors.partials._menu')
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-block">
                    <div class="sub-title">Edit Vendor Details</div>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form autocomplete="off" action="{{route('update-vendor')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Vendor Type </label>
                                    <select name="vendor_type" id="vendor_type" class="form-control">
                                        <option disabled selected>--Select type</option>
                                        <option value="1">Individual Owner</option>
                                        <option value="2">Company/Trust</option>
                                    </select>
                                    @error('vendor_type')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row individual">
                            <div class="col-md-4 col-sm-4 col-lg-4 ">
                                <div class="form-group">
                                    <label for="">Category </label>
                                    <select name="category" id="" class="form-control js-example-basic-single">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->profession_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">First Name <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name',$vendor->first_name)}}">
                                    @error('first_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Surname <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{old('surname',$vendor->surname)}}">
                                    @error('surname')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Email Address <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{old('email',$vendor->email)}}">
                                    @error('email')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Mobile No.<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Mobile No." name="mobile_no" value="{{old('mobile_no',$vendor->mobile_no)}}">
                                    @error('mobile_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for=""> Address <sup class="text-danger">*</sup></label>
                                    <textarea style="resize: none;" name="address" id="address" placeholder="Type address here..." class="form-control">{{old('address',$vendor->address)}}</textarea>
                                    @error('address')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row company">
                            <div class="col-md-4 col-sm-4 col-lg-4 ">
                                <div class="form-group">
                                    <label for="">Category </label>
                                    <select name="category" id="" class="form-control js-example-basic-single">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->profession_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" placeholder="Company Name" name="company_name" value="{{old('company_name',$vendor->company_name)}}" class="form-control">
                                    @error('company_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Official Phone No.</label>
                                    <input type="text" placeholder="Official Phone No." name="official_phone_no" value="{{old('official_phone_no',$vendor->mobile_no)}}" class="form-control">
                                    @error('official_phone_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Official Email</label>
                                    <input type="text" placeholder="Official Email" name="official_email" value="{{old('official_email',$vendor->email)}}" class="form-control">
                                    @error('official_email')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Office Address</label>
                                    <textarea name="office_address" id="office_address" placeholder="Office Address" style="resize: none;" class="form-control">{{old('address',$vendor->address)}}</textarea>
                                    @error('office_address')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <input type="hidden" value="{{$vendor->id}}" name="vendor">
                                    <a href="{{url()->previous()}}" class="btn btn-mini btn-danger"><i class="ti-close"></i> Cancel</a>
                                    <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check"></i> Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-block">
                    <div class="sub-title">Vendor Details <label for="" class="label label-info">{{$vendor->vendor_type == 1 ? 'Individual Owner' : 'Company/Trust'}}</label></div>
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                            @if($vendor->vendor_type == 1)
                                <tr>
                                    <th scope="row">Full Name</th>
                                    <td>{{$vendor->title ?? ''}} {{$vendor->first_name ?? ''}} {{$vendor->surname ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email Address</th>
                                    <td>{{$vendor->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile No.</th>
                                    <td>{{$vendor->mobile_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{$vendor->address ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Category</th>
                                    <td>{{$vendor->getVendorCategory->profession_name ?? ''}}</td>
                                </tr>
                            @endif
                            @if($vendor->vendor_type == 2)
                                <tr>
                                    <th scope="row">Company Name</th>
                                    <td>{{$vendor->company_name ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Email</th>
                                    <td>{{$vendor->email ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Phone No.</th>
                                    <td>{{$vendor->mobile_no ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Address</th>
                                    <td>{{$vendor->address ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Category</th>
                                    <td>{{$vendor->getVendorCategory->profession_name ?? ''}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-block">
                    <div class="row m-b-30">
                        <div class="col-lg-12 col-xl-12">
                            <div class="sub-title">Transactions</div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Billes</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Payments</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content card-block">
                                <div class="tab-pane active" id="home3" role="tabpanel">
                                    <p>bills</p>
                                </div>
                                <div class="tab-pane" id="profile3" role="tabpanel">
                                    <p>payments</p>
                                </div>
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
    <script>
        $(document).ready(function(){
            $('.js-example-basic-single').select2();
            $('.individual').hide();
            $('.company').hide();
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
