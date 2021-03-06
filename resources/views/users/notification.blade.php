@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Notification</div>

        <div class="card-body">
            <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item">
                    @if($notification->type == 'App\Notifications\NewReplyAdded')
                        <div class="d-flex justify-content-between">
                            <div>
                                <img width="40px" height="40px" style="border-radius: 50%" src="{{Gravatar::src($notification->data['discussion']['author']['email'])}}" alt="">
                                <span class="ml-2">A new reply added to your discussion <strong>{{$notification->data['discussion']['title']}}</strong></span>
                            </div>
                            <div>
                                <a href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" class="btn btn-primary btn-sm">View Discussion</a>
                            </div>
                        </div>
                        @endif
                        @if($notification->type == 'App\Notifications\MarkBestReply')
                            <div class="d-flex justify-content-between">
                                <div>
                                    <img width="40px" height="40px" style="border-radius: 50%" src="{{Gravatar::src($notification->data['discussion']['user_id'])}}" alt="">
                                    <span class="ml-2">Your reply to the <strong>{{$notification->data['discussion']['title']}}</strong> marked as a best reply</span>
                                </div>
                                <div>
                                    <a href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" class="btn btn-primary btn-sm">View Discussion</a>
                                </div>
                            </div>
                        @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
