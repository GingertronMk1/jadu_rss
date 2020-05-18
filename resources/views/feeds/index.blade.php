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
            <div class="card-header">
                {{ $feed->name }}
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
