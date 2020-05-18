@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12 mb-3 px-0">
        <a href="{{ route('feeds.create') }}"class="btn btn-primary">
            Add a feed
        </a>
    </div>
    @foreach($feeds as $feed)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                {{ $feed->name }}
                @if($feed->user_id == Auth::user()->id)
                <span class="d-flex flex-row">
                    <a href="{{ route('feeds.edit', compact('feed')) }}" class="btn btn-primary mr-1">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('feeds.destroy', compact('feed'))}}">
                        @method("DELETE")
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </span>
                @endif
            </div>
            <div class="card-body">
                @if($feed->description)
                    {{ $feed->description }}
                    <br>
                @endif
                <a href="{{ route('feeds.show', compact('feed')) }}">{{ $feed->url }}</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
