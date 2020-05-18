@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12 mb-3 px-0">
        <a href="{{ url('/feeds/create') }}"class="btn btn-primary">
            Add a feed
        </a>
    </div>
    @foreach($feeds as $feed)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                {{ $feed->name }}
                @if($feed->user_id == Auth::user()->id)
                <a href="{{ route('feeds.edit', compact('feed')) }}">
                    Edit
                </a>
                @endif
            </div>
            <div class="card-body">
                @if($feed->description)
                    {{ $feed->description }}
                    <br>
                @endif
                {{ $feed->url }}
            </div>
        </div>
    @endforeach
</div>
@endsection
