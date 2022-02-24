@extends('layouts.master-layout')
@section('title')
    Compose Email
@endsection

@section('current-page')
    Compose Email
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.communication.partials._menu')
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\css\component.css">
    <link rel="stylesheet" href="/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="/bower_components/bootstrap-tagsinput/css/bootstrap-tagsinput.css">

@endsection
@section('main-content')
    <div class="row" >
        <div class="col-lg-8  col-xl-8 col-md-8">

            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Compose Email</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-warning background-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('compose-email')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="">Schedule this email?</label>
                                    <select name="scheduled"  id="scheduled" class="form-control js-example-basic-single" >
                                        <option selected value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('scheduled')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3" id="schedule_timestamp_wrapper">
                                <div class="form-group">
                                    <label for="">Delivery Date & Time</label>
                                    <input type="datetime-local" name="schedule_timestamp" class="form-control">
                                    @error('schedule_timestamp')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-lg-10" id="tenant_wrapper">
                                <div class="form-group">
                                    <label for="">Select Tenant</label>
                                    <select name="tenants[]"  id="tenants" class="form-control js-example-basic-multiple" multiple>
                                        <option selected disabled>--Select tenant--</option>
                                        @foreach($tenants as $tenant)
                                            <option value="{{$tenant->id}}">{{$tenant->getApplicant->first_name ?? ''}} {{$tenant->getApplicant->surname ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    @error('tenant')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10" id="custom_wrapper">
                                <div class="form-group">
                                    <label for="">To:</label>
                                    <textarea placeholder="Enter a list of emails separated by comma" name="address_to" id="address_to" style="resize: none;" class="form-control">{{old('address_to')}}</textarea>
                                    @error('address_to')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" placeholder="Subject" value="{{old('subject')}}" name="subject" class="form-control">
                                    @error('subject')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Message</label>
                                    <textarea name="email_body" id="email_body" placeholder="Type message here..." class="form-control content">{{old('body')}}</textarea>
                                    @error('email_body')
                                    <i class="text-danger mr-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Cancel</a>
                                    <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4  col-xl-4 col-md-4">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Keywords</h5>
                    <p>Use the keywords in curly braces...</p>
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                            <tr>
                                <th scope="row">{firstName}</th>
                                <td>Someone's first name</td>
                            </tr>
                            <tr>
                                <th scope="row">{surname}</th>
                                <td>Someone's surname</td>
                            </tr>
                            <tr>
                                <th scope="row">{emailAddress}</th>
                                <td>Someone's email address</td>
                            </tr>
                            <tr>
                                <th scope="row">{mobileNo}</th>
                                <td>Someone's mobile number.</td>
                            </tr>
                            <tr>
                                <th scope="row">{startDate}</th>
                                <td>Rent/lease or event start date.</td>
                            </tr>
                            <tr>
                                <th scope="row">{endDate}</th>
                                <td>Rent/lease or event end date.</td>
                            </tr>
                            <tr>
                                <th scope="row">{address}</th>
                                <td>Someone's residential/office address.</td>
                            </tr>
                            <tr>
                                <th scope="row">{amount}</th>
                                <td>It could be rent or any financial amount.</td>
                            </tr>
                            <tr>
                                <th scope="row">{paymentMethod}</th>
                                <td>Payment method (e.g cash, bank transfer, etc).</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra-scripts')
    <script type="text/javascript" src="/js/custom/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/js/custom/tinymce.js"></script>
    <script src="/assets/js/select2.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-single').select2();
            $('.schedule').hide();
            $('#custom_wrapper').hide();
            $('#schedule_timestamp_wrapper').hide();

            $(document).on('change', '#email_type', function(){
                if($(this).val() == 1){
                    $('#tenant_wrapper').show();
                    $('#custom_wrapper').hide();
                }else{
                    $('#tenant_wrapper').hide();
                    $('#custom_wrapper').show();
                }
            });

            $(document).on('change', '#scheduled', function(){
                if($(this).val() == 1){
                    $('#schedule_timestamp_wrapper').show();
                }else{
                    $('#schedule_timestamp_wrapper').hide();
                }
            });
        });
    </script>
@endsection
