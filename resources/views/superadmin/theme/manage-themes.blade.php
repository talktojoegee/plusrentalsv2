@extends('layouts.master-layout')
@section('title')
    Manage Themes
@endsection

@section('current-page')
    Manage Themes
@endsection
@section('current-page-brief')
    Manage Themes
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-primary btn-mini" href="javascript:void(0);" data-toggle="modal" data-target="#backgroundThemeModal"><i class="ti-paint-bucket"></i>Add New Theme</a>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/toastify.css">

@endsection
@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <!-- Image grid card start -->
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Background Themes</h5>
                    <div class="btn-group d-flex justify-content-end mb-2">
                        <button class="btn-warning btn btn-mini"><i class="ti-reload mr-2" onclick="location.reload();"></i>Reload</button>
                        <button class="btn-primary btn btn-mini" data-target="#backgroundThemeModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Upload New Theme</button>
                    </div>
                    <div class="row gallery-page" id="themeWrapper">
                        @foreach ($themes as $theme)
                            <div class="col-lg-4 col-sm-6">
                                <label style="cursor: pointer;">
                                    <input type="radio" @if($theme->id == Auth::user()->getUserTheme->active_theme) checked="checked" @endif name="backgroundTheme" value="{{$theme->id}}" data-background="{{$theme->theme}}" data-scheme="{{$theme->color_scheme}}">
                                    <span class="haha-img"></span>
                                    {{$theme->theme_name ?? ''}}
                                </label>
                                <div class="thumbnail">
                                    <div class="thumb" style="cursor: pointer;">
                                        <img src="/assets/drive/themes/{{$theme->theme ?? ''}}" alt="{{$theme->theme_name ?? ''}}" class="img-fluid img-thumbnail theme-wrapper" data-themeid="{{$theme->id}}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="backgroundThemeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-uppercase">New Background Theme</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="themeUploadForm" data-parsley-validate>
                        <div class="form-group">
                            <label for="">Theme Name</label>
                            <input type="text" placeholder="Theme Name" required name="theme_name" id="theme_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Attachment</label>
                            <input type="file" id="attachment" name="attachment" required class="form-control">
                        </div>
                        <div class="checkbox-fade fade-in-primary">
                            <label>
                                <input type="checkbox"  name="dark" id="dark">
                                <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                            </span>
                                <span>Dark Color Scheme</span>
                            </label>
                        </div>
                        <p><strong class="text-danger">Note:</strong> The default color scheme is light.</p>
                        <hr>
                        <div class="btn-group d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                            <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="uploadTheme"><i class="mr-2 ti-check"></i>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra-scripts')

@endsection
