@extends('layouts.master-layout')
@section('title')
    Add New Post
@endsection

@section('current-page')
   Add New Post
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="{{route('manage-posts')}}"><i class="icofont icofont-tags"></i>Manage Articles</a>
        <a class="btn btn-primary btn-mini" href="{{route('add-new-post')}}"><i class="icofont icofont-tasks"></i>Add New Article</a>
    </div>
@endsection
@section('extra-styles')

@endsection
@section('main-content')
        <form action="{{route('add-new-post')}}" method="post" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="col-lg-8 col-md-8 col-sm-12">
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
                    <div class="card">
                        <div class="card-block">
                            <div class="sub-title">Add New Post</div>
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Post Title</label>
                                                <input type="text" name="post_title" placeholder="Post Title" value="{{old('post_title')}}" class="form-control">
                                                @error('post_title')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Featured Image</label>
                                                <input type="file" class="form-control-file" name="featured_image">
                                                @error('featured_image')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Content</label>
                                                <textarea name="post_content" id="content" class="content form-control" placeholder="Type post content here...">{{old('content')}}</textarea>
                                                @error('content')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a href="{{url()->previous()}}" class="btn btn-secondary btn-mini">Cancel</a>
                                                <button type="submit" class="btn btn-mini btn-primary">Publish Article</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="sub-title">Category</div>
                            <div class="input-group">
                                <input type="text" id="category_name" class="form-control" placeholder="Add New Category">
                                <span id="addNewCategoryBtn" class="input-group-addon" id="basic-addon5"><i class="ti-plus mr-2"></i></span>
                            </div>
                            <hr>
                            <div id="categoryWrapper">
                                @foreach($categories as $cat)
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="{{$cat->id}}" name="post_category[]">
                                        <span class="cr">
                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                    </span>
                                        <span>{{$cat->category_name ?? ''}}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


@endsection

@section('extra-scripts')

    <script type="text/javascript" src="/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/bower_components/tinymce.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#addNewCategoryBtn', function(e){
                e.preventDefault();
                if($('#category_name').val() != ''){
                    axios.post('/post/add-new-category',{category_name:$('#category_name').val()})
                        .then(response=>{
                            $('#categoryWrapper').html(response.data);
                            $('#category_name').val('');
                        });
                }

            });
        });
    </script>
@endsection
