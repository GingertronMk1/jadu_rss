@extends('layouts.app')

@section('content')
<div class="container form-group">
    <form method="POST" action="{{ url('/feeds')}}" class="card">
        @csrf
        <div class="card-header">
            Add new feed
        </div>
        <div class="card-body">
        <div class="form-group">
            <label for="name">
                Name
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input class="form-control" name="name" placeholder="The name of the feed">
        </div>
        <div class="form-group">
            <label for="url">
                URL
                @error('url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
            <input class="form-control" name="url" placeholder="The url of the feed">
        </div>
        <div class="form-group">
            <label for="name">Description (optional)</label>
            <textarea class="form-control" name="description" placeholder="A description of the feed's contents">
            </textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Add feed" class="btn btn-primary">
            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
        <div>
        </div>
    </form>
</div>
@endsection
