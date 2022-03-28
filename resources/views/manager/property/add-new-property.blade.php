@extends('layouts.master-layout')
@section('title')
    Add New Property
@endsection

@section('current-page')
    Add New Property
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.property.partials._menu')
@endsection
@section('extra-styles')
 <link rel="stylesheet" href="/assets/css/select2.css">
@endsection
@section('main-content')
    <form action="{{route('store-new-property')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">

        <div class="col-lg-8 col-md-8 col-sm-8">
           <div class="card">
                <div class="card-header">
                    <h5>Add New Property</h5>
                    <p>Add a new property to the system using the form below.</p>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 ">
                            <div class="row">
                                <div class="col-md-10 col-sm-10 col-lg-10 offset-md-1 offset-lg-1 offset-sm-1">
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
                                    @if(Auth::user()->getUserProperties->count() == Auth::user()->getUserCompany->no_of_units || strtotime(Auth::user()->end_date) > strtotime(now()))
                                        <div class="alert alert-warning background-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="ti-close text-white"></i>
                                            </button>
                                            <strong>Whoops!</strong> You've reached the maximum ({{Auth::user()->getUserCompany->no_of_units}}) number of units you manage. You may  <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add more units">
                                                <a href="button" class="btn btn-secondary btn-mini waves-effect waves-light"><i class="icofont icofont-info-square"></i>Add more units</a>
                                            </div>  continue posting new properties.

                                        </div>
                                    @endif
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Property Title <sup class="text-danger">*</sup></label>
                                            <input type="text" placeholder="Property Name" name="property_name" id="property_name" class="form-control" value="{{old('property_name')}}">
                                            @error('property_name')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Property Type<sup class="text-danger">*</sup></label>
                                            <select name="property_type" id="property_type" class="form-control js-example-basic-single" value="{{old('property_type')}}">
                                                <option disabled selected>--Select property type--</option>
                                                <option value="1">Apartment</option>
                                                <option value="2">House</option>
                                                <option value="3">Land</option>
                                                <option value="4">Townhouse</option>
                                                <option value="5">Garden Cottage</option>
                                                <option value="6">Farm</option>
                                            </select>
                                            @error('property_type')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Unit No.</label>
                                            <input type="text" placeholder="Unit No." name="unit_no" id="unit_no" class="form-control" value="{{old('unit_no')}}">
                                            @error('unit_no')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Location<sup class="text-danger">*</sup></label>
                                            <select name="location" id="location" class="form-control js-example-basic-single" value="{{old('location')}}">
                                                <option disabled selected>--Select location--</option>
                                                @foreach($locations as $location)
                                                    <option value="{{$location->id}}">{{$location->location_name ?? ''}}</option>
                                                @endforeach
                                            </select>
                                            @error('location')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Area<sup class="text-danger">*</sup></label>
                                            <div id="areaWrapper"></div>
                                            @error('area')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="">Address (Optional)</label>
                                            <textarea name="address" style="resize:none;" placeholder="Address"
                                                      class="form-control">{{old('address')}}</textarea>
                                            @error('address')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Description<sup class="text-danger">*</sup></label>
                                            <textarea name="description" id="description" placeholder="Type description here..." style="resize: none;" class="form-control content">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="sub-title">Features</div>
                                        <div class="border-checkbox-section">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">1</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="bedrooms" value="{{old('bedrooms',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Bedrooms</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="number" name="bedrooms_comment" value="{{old('bedrooms_comment')}}" placeholder="No. of Bedrooms" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">2</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="bathrooms" id="bathrooms" value="{{old('bathrooms',1)}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Bathrooms</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <input type="number" name="bathrooms_comment" value="{{old('bathrooms_comment')}}" placeholder="No. of Bathrooms" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">3</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="study_room" value="{{old('study_room',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Study room</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="number" name="study_room_comment" value="{{old('study_room_comment')}}" placeholder="No. of Study Room" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">4</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="dinning_room" id="dinning_room" value="{{old('dinning_room',1)}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Dinnings</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <input type="number" name="dinning_room_comment" value="{{old('dinning_room_comment')}}" placeholder="No. of Dinnings" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">5</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="carports" value="{{old('carports',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Carports</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="number" name="carports_comment" value="{{old('carports_comment')}}" placeholder="No. of Carports" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">6</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="kitchens" id="kitchens" value="{{old('kitchens',1)}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Kitchens</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <input type="number" name="kitchens_comment" value="{{old('kitchens_comment')}}" placeholder="No. of Kitchens" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">7</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" id="garages" name="garages" value="{{old('garages',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Garages</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="number" name="garages_comment" value="{{old('garages_comment')}}" placeholder="No. of Garages" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">8</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="flooring" id="flooring" value="{{old('flooring',1)}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Flooring</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <select name="flooring_type" id="flooring_type" class="form-control">
                                                        <option disabled selected>--Select flooring--</option>
                                                        <option value="1">Tiles</option>
                                                        <option value="2">Cement</option>
                                                    </select>
                                                    @error('flooring_type')
                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">9</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" id="laundry" name="laundry" value="{{old('laundry',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Laundry</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="text" name="laundry_comment" value="{{old('laundry_comment')}}" placeholder="Comment" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">10</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="balcony" id="balcony" value="{{old('balcony',1)}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Balcony</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <input type="text" name="balcony_comment" id="balcony_comment" placeholder="Comment" class="form-control">

                                                    @error('balcony_comment')
                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">11</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" id="pool" name="pool" value="{{old('pool',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Pool</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="text" value="{{old('pool_comment')}}" placeholder="Comment" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">12</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="garden" id="garden" value="{{old('garden',1)}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Garden</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <input type="text" name="garden_comment" id="garden_comment" placeholder="Comment" class="form-control">

                                                    @error('garden_comment')
                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">13</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" id="views" name="views" value="{{old('views',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Views</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="text" value="{{old('views_comment')}}" placeholder="Comment" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">14</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="security" id="security" value="{{old('security',1)}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Security</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <input type="text" name="security_comment" id="security_comment" placeholder="Comment" class="form-control">

                                                    @error('security_comment')
                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">15</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" id="store_room" name="store_room" value="{{old('store_room',1)}}">
                                                            <span class="cr">
                                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                            </span>
                                                            <span>Store room</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <input type="text" value="{{old('store_room_comment')}}" placeholder="Comment" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    <label for="" class="badge badge-info">16</label>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" name="lounges" id="lounges" value="{{old('lounges')}}">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span>Lounges</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-lg-3 bathroom">
                                                    <input type="text" name="lounges_comment" id="lounges_comment" placeholder="Comment" class="form-control">

                                                    @error('lounges_comment')
                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                        <div class="btn-group">
                                            <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                            @if(Auth::user()->getUserProperties->count() < Auth::user()->getUserCompany->no_of_units || strtotime(now()) < strtotime(Auth::user()->end_date))
                                            <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Add Property</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h5>Add New Property</h5>
                    <p>Add a new property to the system using the form below.</p>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="sub-title">Listing</div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="sub-title">Property Gallery</div>
                                    <div class="form-group">
                                        <label for="">Upload images<sup class="text-danger">*</sup></label>
                                        <input type="file" name="interior_images[]" id="interior_images" multiple class="form-control-file">
                                        @error('interior_images')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for=""> Price<sup class="text-danger">*</sup></label>
                                        <input type="number" placeholder="Rental Price" step=""0.01 name="rental_price" class="form-control" id="rental_price" value="{{old('rental_price')}}">
                                        @error('rental_price')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Listing Type<sup class="text-danger">*</sup></label>
                                        <select name="listing_type" id="listing_type" class="form-control js-example-basic-single">
                                            <option disabled selected>--Select listing type--</option>
                                            <option value="1">For rent</option>
                                            <option value="2">For sale</option>
                                        </select>
                                        @error('listing_type')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="">Frequency<sup class="text-danger">*</sup></label>
                                        <select name="frequency" id="frequency" class="form-control js-example-basic-single">
                                            <option disabled selected>--Select frequency--</option>
                                            @foreach($frequencies as $frequency)
                                                <option value="{{$frequency->id}}">{{$frequency->frequency ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('frequency')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </form>

@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script type="text/javascript" src="/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/bower_components/tinymce.js"></script>
    <script>
        $(document).ready(function(){
            $('.js-example-basic-single').select2();


            $(document).on('change', '#location', function(e){
                e.preventDefault();
                axios.post('/location/area', {location:$(this).val()})
                .then(response=>{
                    $('#areaWrapper').html(response.data);
                    $('.js-example-basic-single').select2();
                })
                .catch(error=>{

                });
            });

            $("#interior_images").on("change", function() {
                if ($("#interior_images")[0].files.length > 7) {
                    alert("You can select only 7 images max");
                } else {
                   // $("#imageUploadForm").submit();
                }
            });
        });
    </script>

@endsection
