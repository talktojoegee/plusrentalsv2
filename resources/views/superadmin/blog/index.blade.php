@extends('layouts.master-layout')
@section('title')
    Manage Articles
@endsection

@section('current-page')
    Manage Articles
@endsection
@section('current-page-brief')
    Manage all articles
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('manage-posts')}}"><i class="icofont icofont-tags"></i>Manage Articles</a>
        <a class="btn btn-primary btn-mini" href="{{route('add-new-post')}}"><i class="icofont icofont-tasks"></i>Add New Article</a>
    </div>
@endsection
@section('extra-styles')
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
                    <div class="tab-content card-block">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <p>List of all post/articles</p>
                                <div class="table-responsive">

                                    <table id="focus-key" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="focus-key_info" style="position: relative;">
                                        <thead>
                                        <tr role="row" class="text-uppercase">
                                            <th class="sorting"  >S/No.</th>
                                            <th class="sorting" >Post Title</th>
                                            <th class="sorting"  >Author</th>
                                            <th class="sorting_asc" >Date</th>
                                            <th class="sorting"  >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>{{$serial++}}</td>
                                                <td>{{strlen($post->post_title) > 50 ?  substr($post->post_title,0,50).'...' : $post->post_title }}</td>
                                                <td>{{$post->getPostAuthor->first_name ?? ''}} {{$post->getPostAuthor->surname ?? ''}}</td>
                                                <td>{{date('d M, Y', strtotime($post->created_at))}}</td>
                                                <td>
                                                    <a href="{{route('edit-post', $post->slug)}}" class="btn btn-mini btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr class="text-uppercase">
                                            <th>S/No.</th>
                                            <th>Post Title</th>
                                            <th>Author</th>
                                            <th>Date</th>
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
    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\extensions\key-table\js\key-table-custom.js"></script>
@endsection
