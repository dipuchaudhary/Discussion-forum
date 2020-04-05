@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end my-2">
        <a href=" {{ route('discussions.create') }}" class=" btn btn-success">Add Discussion</a>
    </div>
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">

        </div>
    </div>
@endsection
