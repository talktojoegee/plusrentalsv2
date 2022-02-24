@extends('layouts.master-layout')
@section('title')
    Rental Owner Detail
@endsection

@section('current-page')
    Rental Owner Detail
@endsection
@section('current-page-brief')
Fill the form below to submit a new tenant application on the behalf of someone. The application will go through a series of approval before finally approved.
@endsection

@section('event-area')
    @include('manager.rental-owner.partials._event-menu')
@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-block">
                    <div class="sub-title">Edit Rental Owner</div>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form autocomplete="off" action="{{route('update-rental-owner')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Ownership Type </label>
                                    <select name="ownership_type" id="ownership_type" class="form-control">
                                        <option disabled selected>--Select ownership type</option>
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
                            <div class="col-md-4 col-sm-4 col-lg-4 ">
                                <div class="form-group">
                                    <label for="">Title </label>
                                    <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title',$rental->title)}}">
                                    @error('title')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">First Name <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name',$rental->first_name)}}">
                                    @error('first_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Surname <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{old('surname',$rental->surname)}}">
                                    @error('surname')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Email Address <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{old('email',$rental->email)}}">
                                    @error('email')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Mobile No.<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Mobile No." name="mobile_no" value="{{old('mobile_no',$rental->mobile_no)}}">
                                    @error('mobile_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for=""> Address <sup class="text-danger">*</sup></label>
                                    <textarea style="resize: none;" name="address" id="address" placeholder="Type address here..." class="form-control">{{old('address',$rental->address)}}</textarea>
                                    @error('address')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row individual">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Marital Status</label>
                                    <select name="marital_status" id="marital_status" class="form-control">
                                        <option selected disabled>--Select marital status--</option>
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Divorced</option>
                                        <option value="4">Separated</option>
                                        <option value="5">Widow</option>
                                        <option value="6">Widower</option>
                                        <option value="7">Complicated</option>
                                        <option value="8">Rather not say</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label for="">Gender</label>
                                <div class="form-radio">
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="gender"  value="1" {{$rental->gender == 1 ? 'checked' : ''}}>
                                            <i class="helper"></i>Male
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="gender" value="2" {{$rental->gender == 2 ? 'checked' : ''}}>
                                            <i class="helper"></i>Female
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row company">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" placeholder="Company Name" name="company_name" value="{{old('company_name',$rental->company_name)}}" class="form-control">
                                    @error('company_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Official Phone No.</label>
                                    <input type="text" placeholder="Official Phone No." name="official_phone_no" value="{{old('official_phone_no',$rental->mobile_no)}}" class="form-control">
                                    @error('official_phone_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Official Email</label>
                                    <input type="text" placeholder="Official Email" name="official_email" value="{{old('official_email',$rental->email)}}" class="form-control">
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
                                    <textarea name="office_address" id="office_address" placeholder="Office Address" style="resize: none;" class="form-control">{{old('address',$rental->address)}}</textarea>
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
                                    <input type="hidden" value="{{$rental->id}}" name="owner">
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
                    <div class="sub-title">Rental Owner Detail <label for="" class="label label-info">{{$rental->ownership_type == 1 ? 'Individual Owner' : 'Company/Trust'}}</label></div>
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                            @if($rental->ownership_type == 1)
                                <tr>
                                    <th scope="row">Full Name</th>
                                    <td>{{$rental->title ?? ''}} {{$rental->first_name ?? ''}} {{$rental->surname ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email Address</th>
                                    <td>{{$rental->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile No.</th>
                                    <td>{{$rental->mobile_no ?? ''}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Marital Status</th>
                                    <td>{{$rental->marital_status ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Gender</th>
                                    <td>{{$rental->gender == 1 ?  'Male' : 'Female'}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{$rental->address ?? ''}}</td>
                                </tr>
                            @endif
                            @if($rental->ownership_type == 2)
                                <tr>
                                    <th scope="row">Company Name</th>
                                    <td>{{$rental->company_name ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Email</th>
                                    <td>{{$rental->email ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Phone No.</th>
                                    <td>{{$rental->mobile_no ?? ''}} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Official Address</th>
                                    <td>{{$rental->address ?? ''}} </td>
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
                                    <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Invoices</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Receipts</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Tenants</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#settings3" role="tab">Vendors</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content card-block">
                                <div class="tab-pane active" id="home3" role="tabpanel">
                                    <p>Invoices</p>
                                </div>
                                <div class="tab-pane" id="profile3" role="tabpanel">
                                    <p>Receipts</p>
                                    </div>
                                <div class="tab-pane" id="messages3" role="tabpanel">
                                    tenants
                                     </div>
                                <div class="tab-pane" id="settings3" role="tabpanel">
                                    <p>vendors</p>
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
    <script>
        $(document).ready(function(){
            $('.individual').hide();
            $('.company').hide();
            $(document).on('change', '#ownership_type', function(e){
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
