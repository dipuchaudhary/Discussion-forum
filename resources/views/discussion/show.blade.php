@extends('layouts.app')
@section('content')
    <div class="card">
        @include('partials.discussion-header')
        <div class="card-body">
            <strong>
                {!! $discussion->title !!}
            </strong>

            <hr>
            {!! $discussion->content !!}
            @if($discussion->getBestReply)
            <div class="card bg-success my-2" style="color: #fff">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img width="30px" height="30px" style="border-radius: 50%" src="{{Gravatar::src($discussion->getBestReply->owner->email)}}" alt="">
                            <span class="ml-2 font-weight-bold ">{{$discussion->getBestReply->owner->name}}</span>
                        </div>
                        <div>
                            <strong>Best Reply</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $discussion->getBestReply->content !!}
                    </div>
                </div>
            </div>
                @endif
        </div>
    </div>

    @foreach($discussion->replies()->paginate(3) as $reply)
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img style="border-radius: 50%;" width="40px" height="40px" src="{{Gravatar::src($reply->owner->email)}}" alt="">
                        <span class="ml-2 font-weight-bold">{{$reply->owner->name}}</span>
                    </div>
                    <div>
                        @if(auth()->user()->id == $discussion->user_id)
                        <form action="{{route('discussions.best-reply',['discussion'=> $discussion->slug,'reply'=> $reply->id ])}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Mark as best Reply</button>
                        </form>
                           @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $reply->content !!}
            </div>
        </div>
    @endforeach
    {{$discussion->replies()->paginate(3)->links()}}

    <div class="card my-4">
        <div class="card-header">
            Add a reply
        </div>
        <div class="card-body">
            @auth
                <form action="{{ route('replies.store',$discussion->slug) }}" method="post">
                    @csrf
                    <label for="reply">Content</label>
                    <input id="reply" type="hidden" name="reply">
                    <trix-editor input="reply"></trix-editor>

                    <button type="submit" class="btn btn-success btn-sm my-2">Reply</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-info btn-sm">Sign in to reply</a>
            @endauth
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection
