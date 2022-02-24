@extends('layouts.master-layout')
@section('title')
    Task Details
@endsection

@section('current-page')
    Task Details
@endsection
@section('current-page-brief')
    Task Details
@endsection

@section('event-area')
    <div class="btn-group">
        <a href="{{route('manage-tasks')}}" class="btn btn-secondary btn-mini"><i class="icofont icofont-tags"></i>Manage Tasks</a>
        <a href="{{route('add-new-task')}}" class="btn btn-primary btn-mini"><i class="icofont icofont-tasks"></i>Add New Task</a>
        <button class="btn btn-danger btn-mini"><i class="icofont icofont-megaphone"></i>Reports</button>
    </div>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/custom/toastify.css">
@endsection
@section('main-content')
    <div class="row">
        <!-- Task-detail-right start -->
        <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">
            <div class="card">
                <div class="card-footer">
                    <div class="f-left">
                        Manage task status
                    </div>
                    <div class="f-right">

                        <div class="dropdown-secondary dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle waves-light" type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text"><i class="icofont icofont-ui-note m-r-10"></i> Task Details</h5>
                </div>
                <div class="card-block task-details">
                    <table class="table table-border table-xs">
                        <tbody>
                        <tr>
                            <td><i class="icofont icofont-contrast"></i> Tenant:</td>
                            <td class="text-right"><span class="f-right"><a href="#"> {{$task->getTenant->getApplicant->first_name ?? ''}} {{$tenant->getTenant->getApplicant->surname ?? ''}}</a></span></td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-id-card"></i> Created:</td>
                            <td class="text-right">{{!is_null($task->created_at) ? date('d M, Y', strtotime($task->created_at)) : '-'}}</td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-spinner-alt-5"></i> Status:</td>
                            <td class="text-right">
                                @switch($task->status)
                                    @case(0)
                                    Pending
                                    @break
                                    @case(1)
                                    Started
                                    @break
                                    @case(2)
                                    Completed
                                    @break
                                    @case(3)
                                    Cancelled
                                    @break
                                @endswitch

                            </td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-id-card"></i> Start Date:</td>
                            <td class="text-right text-success">{{!is_null($task->start_date) ? date('d M, Y', strtotime($task->start_date)) : '-'}}</td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-id-card"></i> End Date:</td>
                            <td class="text-right text-danger">{{!is_null($task->end_date) ? date('d M, Y', strtotime($task->end_date)) : '-'}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text"><i class="icofont icofont-attachment"></i> Attachments</h5>
                </div>
                <div class="card-block task-attachment">
                    <ul class="media-list">
                        @foreach($task->getTaskAttachments as $attach)
                            @if(file_exists(public_path('/assets/drive/'.$attach->directory)))
                            <li class="media d-flex m-b-10">
                                <div class="m-r-20 v-middle">
                                    <i class="icofont icofont-file-word f-28 text-muted"></i>
                                </div>
                                <div class="media-body">
                                    <a href="javascript:void(0);" class="m-b-5 d-block">{{ strlen($task->title) > 45 ? substr($task->title,0,45).'...' : $task->title }}</a>
                                    <div class="text-muted">
                                        <span>
                                                @if (\File::size(public_path('/assets/drive/'.$attach->directory)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/driveuisition/'.$attach->directory))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/drive/'.$attach->directory)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/drive/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/drive/'.$attach->directory)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/drive/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/drive/'.$attach->directory)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/drive/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/drive/'.$attach->directory)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/drive/'.$attach->directory))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/drive/'.$attach->directory))/1024,2)}}bytes</small>
                                                @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="f-right v-middle text-muted">
                                        <a href="/assets/drive/{{$attach->directory}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text"><i class="icofont icofont-users-alt-4"></i> Assigned To</h5>
                </div>
                <div class="card-block user-box assign-user">
                    @foreach($task->getTaskAssignments as $assigned_to)
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="#">
                                    <img class="img-radius" src="/images/avatar/{{$assigned_to->getAssignedTo->avatar ?? 'avatar.png'}}" alt="{{$assigned_to->getAssignedTo->first_name ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6>{{$assigned_to->getAssignedTo->first_name ?? '' }} {{$assigned_to->getAssignedTo->surname ?? ''}}</h6>
                                <p>
                                    @switch($assigned_to->status)
                                        @case(0)
                                        <span class="text-muted">Unassigned</span>
                                        @break
                                        @case(1)
                                        <span class="text-warning">Pending</span>
                                        @break
                                        @case(2)
                                         <span class="text-secondary">Accepted</span>
                                        @break
                                        @case(3)
                                        <span class="text-primary">Started</span> Started
                                        @break
                                        @case(4)
                                         <span class="text-success">Completed</span>
                                        @break
                                    @endswitch
                                </p>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-end">
                                        <button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i> Submit Task</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div>
                                <a href="#!" class="text-muted"> <i class="icon-options-vertical"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Task-detail-right start -->

        <!-- Task-detail-left start -->
        <div class="col-xl-8 col-lg-12 pull-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{$task->title ?? '' }}</h5>
                </div>
                <div class="card-block">
                    <div class="">
                        <div class="m-b-20">
                            <h6 class="sub-title m-b-15">Overview</h6>
                            {!! $task->description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card comment-block">
                <div class="card-header">
                    <h5 class="card-header-text"><i class="icofont icofont-comment m-r-5"></i> Conversations</h5>
                </div>
                <div class="card-block">
                    <ul class="media-list" id="conversationWrapper" style="height: 400px; overflow-y : scroll;">
                        @foreach($task->getTaskConversations as $convo)
                            <li class="media">
                                <div class="media-left">
                                    <a href="javascript:void(0);">
                                        <img class="media-object img-radius comment-img" src="/images/avatar/{{$convo->getUser->avatar ?? 'avatar.png'}}" alt="{{$convo->getUser->first_name ?? ''}}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading txt-primary">{{$convo->getUser->first_name ?? ''}} {{$convo->getUser->surname ?? ''}}<span class="f-12 text-muted m-l-5">{{!is_null($convo->created_at) ? date('d M, Y h:ia', strtotime($convo->created_at)) : '-'}}</span></h6>
                                    {!! $convo->conversation ?? '' !!}
                                    <hr>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="md-float-material d-flex">
                        <div class="col-md-12 btn-add-task">
                            <div class="form-group">
                                <textarea name="comment" class="form-control" id="comment" style="resize: none;" placeholder="Leave comment"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <input type="hidden" name="task" id="task" value="{{$task->id}}">
                                <button id="leaveCommentBtn" class="btn btn-mini btn-primary">Leave comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/js/custom/toastify.min.js"></script>
    <script src="/js/custom/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#leaveCommentBtn', function(e){
                e.preventDefault();
                var comment = $('#comment').val();
                if(comment == ''){
                    Toastify({
                        text: "Enter comment in the box before submitting.",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        backgroundColor: "linear-gradient(to right, #FF0001, #FF0000)",
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        onClick: function(){} // Callback after click
                    }).showToast();
                }else{
                    axios.post('/manage-task/view/comment',{task:$('#task').val(), comment:$('#comment').val()})
                    .then(response=>{
                        $('#conversationWrapper').html(response.data);
                        $('#comment').val('');
                        Toastify({
                            text: "Great! Conversation submitted.",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            backgroundColor: "linear-gradient(to right, #006400, #006400)",
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            onClick: function(){} // Callback after click
                        }).showToast();
                    })
                    .catch(error=>{
                        Toastify({
                            text: "Ooops! Something went wrong. Try again.",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            backgroundColor: "linear-gradient(to right, #FF0001, #FF0000)",
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            onClick: function(){} // Callback after click
                        }).showToast();
                    });
                }
            });
        });
    </script>
@endsection
