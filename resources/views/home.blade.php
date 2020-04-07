@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @foreach(auth()->user()->notifications as $notification)
                {{print_r($notification)}}
                @endforeach
        </div>
    </div>
@endsection
