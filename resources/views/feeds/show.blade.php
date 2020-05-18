@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="col-12 px-0">
        Latest posts for {{ $feed->name }}
    </h1>
    @foreach($feed_data as $fd_item)
        <div class="card mb-3">
            <div class="card-header">
                {!! $fd_item['title'] !!}
            </div>
            <div class="card-body">
                {!! $fd_item['description'] !!}
            </div>
        </div>
    @endforeach
</div>
@endsection
