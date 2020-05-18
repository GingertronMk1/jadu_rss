@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="col-12 px-0">
        Latest posts for {{ $feed->name }}
    </h1>
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-header">
                {!! $post['title'] !!}
            </div>
            <div class="card-body">
                {!! $post['description'] !!}
            </div>
        </div>
    @endforeach
</div>
@endsection
