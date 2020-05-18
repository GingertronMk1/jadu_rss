@extends('layouts.app')

@section('content')
<div class="container form-group">
    <form method="POST" action="{{ route('feeds.update', compact('feed'))}}" class="card">
        @method('PUT')
        @csrf
        <div class="card-header">
            Edit {{ $feed->name }}
        </div>
        <div class="card-body">
        <div class="form-group">
            <label for="name">
                Name
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input class="form-control" name="name" value="{{ $feed->name }}">
        </div>
        <div class="form-group">
            <label for="url">
                URL
                @error('url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input class="form-control" name="url" value="{{ $feed->url }}">
        </div>
        <div class="form-group">
            <label for="name">Description (optional)</label>
            <textarea class="form-control" name="description" placeholder="A description of the feed's contents">
            {{ $feed->description }}
            </textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Update feed" class="btn btn-primary">
            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
        <div>
        </div>
    </form>
</div>
@endsection
