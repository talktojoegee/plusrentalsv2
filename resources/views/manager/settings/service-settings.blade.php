@extends('layouts.master-layout')
@section('title')
    Service Settings
@endsection

@section('current-page')

@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('leases')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Leases</a>
        <a href="{{route('add-new-lease')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Add New Lease</a>
        <a href="{{route('lease-applications')}}" class="btn btn-warning btn-mini"><i class="icofont icofont-tasks"></i>Lease Applications</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('main-content')

    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Add New Service</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif

                    <form action="{{route('service-settings')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Service Name</label>
                                    <input type="text" name="service_name" value="{{old('service_name')}}" placeholder="Service Name" class="form-control">
                                    @error('service_name')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Charge Type</label>
                                    <select name="charge_type" id="charge_type" class="form-control">
                                        <option selected disabled>--Select Charge Type--</option>
                                        <option value="1">Fixed Value</option>
                                        <option value="2">Percentage</option>
                                    </select>
                                    @error('charge_type')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Charge Value</label>
                                    <input type="number" step="0.01" value="{{old('charge_value')}}" placeholder="Charge Value" name="charge_value" class="form-control">
                                    @error('charge_value')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{url()->previous()}}" class="btn btn-secondary btn-mini">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-mini">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <p>List of various services registered on {{config('app.name')}}</p>
                            <div class="table-responsive">
                                <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc">S/No.</th>
                                        <th class="sorting_asc">Service Name</th>
                                        <th class="sorting" >Charge Type</th>
                                        <th class="sorting"  >Charge Value</th>
                                        <th class="sorting"  >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td>{{$service->service_name ?? ''}}</td>
                                            <td>
                                                @if($service->charge_type == 1)
                                                    <label for="" class="label label-info">Fixed Value</label>
                                                @else
                                                    <label for="" class="label label-warning">Percentage</label>
                                                @endif
                                            </td>
                                            <td class="float-right">
                                                {{number_format($service->charge_value ?? 0,2)}} {{$service->charge_type == 2 ? '%' : ''}}
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editServiceModal_{{$service->id}}" class="btn btn-primary btn-mini">View</a>
                                                <div class="modal fade" id="editServiceModal_{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title" id="exampleModalLabel">Edit {{$service->service_name ?? ''}}</h6>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('update-service')}}" method="post">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="">Service Name</label>
                                                                                <input type="text" name="edit_service_name" value="{{$service->service_name ?? ''}}" id="edit_service_name" class="form-control">
                                                                                @error('edit_service_name')
                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="">Charge Type</label>
                                                                                <select name="edit_charge_type" id="edit_charge_type" class="form-control">
                                                                                    <option selected disabled>--Select Charge Type--</option>
                                                                                    <option value="1" {{$service->charge_type == 1 ? 'selected' : ''}}>Fixed Value</option>
                                                                                    <option value="2" {{$service->charge_type == 2 ? 'selected' : ''}}>Percentage</option>
                                                                                </select>
                                                                                @error('edit_charge_type')
                                                                                <i class="text-danger">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="">Charge Value</label>
                                                                                <input type="number" step="0.01" value="{{$service->charge_value ?? ''}}" placeholder="Charge Value" name="edit_charge_value" class="form-control">
                                                                                @error('edit_charge_value')
                                                                                <i class="text-danger">{{$message}}</i>
                                                                                @enderror
                                                                            </div>
                                                                            <input type="hidden" name="service" value="{{$service->id}}">
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-12 d-flex justify-content-center">
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-default btn-mini" data-dismiss="modal">Close</button>
                                                                                <button class="btn btn-primary btn-mini">Save Changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th >S/No.</th>
                                        <th >Service Name</th>
                                        <th >Charge Type</th>
                                        <th >Charge Value</th>
                                        <th >Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
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
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
