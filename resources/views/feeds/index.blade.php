@extends('layouts.app')

@section('content')
<div class="container">
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
