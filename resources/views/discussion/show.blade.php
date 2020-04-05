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
            </div>
    </div>
@endsection
