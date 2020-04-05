@extends('layouts.app')

@section('content')
    <div class="card">
        @foreach($discussions as $discussion)
            @include('partials.discussion-header')
        <div class="card-body">
            <strong>
                {!! $discussion->title !!}
            </strong>

        </div>
            @endforeach
    </div>
@endsection
