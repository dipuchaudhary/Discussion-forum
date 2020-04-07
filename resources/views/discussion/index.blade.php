@extends('layouts.app')

@section('content')
    @foreach($discussions as $discussion)
    <div class="card my-2">
            @include('partials.discussion-header')
        <div class="card-body">
            <strong>
                {!! $discussion->title !!}
            </strong>

        </div>
    </div>
    @endforeach
@endsection

@section('css')

    @endsection
