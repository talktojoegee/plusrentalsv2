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
