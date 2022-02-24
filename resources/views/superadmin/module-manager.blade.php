@extends('layouts.master-layout')
@section('title')
    Module Manager
@endsection

@section('current-page')
    Module Manager
@endsection
@section('current-page-brief')
    Module Manager
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('properties')}}"><i class="icofont icofont-tags"></i>Manage Properties</a>
        <a class="btn btn-primary btn-mini" href="{{route('add-new-property')}}"><i class="icofont icofont-tasks"></i>Add New Property</a>
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
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @if (session()->has('error'))
                        <div class="alert alert-warning background-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                        @if (session()->has('success'))
                            <div class="abackground-success background-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                    <div class="tab-content card-block">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="sub-title">Assign Permission</div>
                                        <form action="{{route('module-manager')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Module Name</label>
                                                <select name="module" id="" class="form-control js-example-basic-single">
                                                    <option disabled selected>--Select module name--</option>
                                                    @foreach($modules as $module)
                                                        <option value="{{$module->id}}">{{$module->module_name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('module') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Permission</label>
                                                <select name="permission[]" id="" class="form-control js-example-basic-multiple" multiple>
                                                    <option disabled selected>--Select permission--</option>
                                                    @foreach($permissions as $permission)
                                                        <option value="{{$permission->id}}">{{$permission->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('permission') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                            <hr>
                                            <div class="form-group d-flex justify-content-center">
                                                <button class="btn btn-primary btn-mini" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8">
                                <p>Module manager </p>
                                <div class="table-responsive">

                                    <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                        <thead>
                                        <tr role="row" class="text-uppercase">
                                            <th class="sorting"  >S/No.</th>
                                            <th class="sorting" >Module Name</th>
                                            <th class="sorting"  >Permission</th>
                                            <th class="sorting"  >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($modulepermissions as $modulepermission)
                                            <tr>
                                                <td>{{$serial++}}</td>
                                                <td>{{$modulepermission->getModule->module_name ?? ''}}</td>
                                                <td>{{$modulepermission->getPermission->name ?? ''}}</td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#default-Modal_{{$modulepermission->id}}" class="btn btn-primary btn-mini"><i class="ti-eye mr-2"></i></button>
                                                    <div class="modal fade" id="default-Modal_{{$modulepermission->id}}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit {{$modulepermission->getModule->module_name ?? ''}}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{route('update-module-permission')}}" method="post">
                                                                        @csrf
                                                                        <div class="form-group col-md-10">
                                                                            <label for="">Module Name</label>
                                                                            <select name="module" id="" class="form-control">
                                                                                @foreach($modules as $modu)
                                                                                    <option value="{{$modu->id}}" {{$modu->id == $modulepermission->module_id ? 'selected' : ''}}>{{$modu->module_name ?? '' }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('module') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                                        </div>
                                                                        <div class="form-group col-md-10">
                                                                            <label for="">Permission</label>
                                                                            <select name="permission" id="" class="form-control " >
                                                                                <option disabled selected>--Select permission--</option>
                                                                                @foreach($permissions as $perm)
                                                                                    <option value="{{$perm->id}}" {{$perm->id == $modulepermission->permission_id ? 'selected' : ''}}>{{$perm->name ?? '' }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('permission') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                                        </div>
                                                                        <hr>
                                                                        <div class="form-group d-flex justify-content-center">
                                                                            <input type="hidden" name="modperm" value="{{$modulepermission->id}}">
                                                                            <button class="btn btn-primary btn-mini" type="submit">Save changes</button>
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
                                        <tr class="text-uppercase">
                                            <th>S/No.</th>
                                            <th>Module Name</th>
                                            <th>Permission</th>
                                            <th>Action</th>
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
    </div>

@endsection

@section('extra-scripts')
    <script src="/assets/js/select2.js"></script>
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
