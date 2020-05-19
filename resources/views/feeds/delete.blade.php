@extends('layouts.app')

@section('content')
<div class="container form-group">
    <form method="POST" action="{{ route('feeds.destroy', compact('feed'))}}" class="card">
        @method('DELETE')
        @csrf
        <div class="card-header">
            Delete {{ $feed->name }}?
        </div>
        <div class="card-body">
                <input type="submit" class="btn btn-danger" value="Yes">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">No</a>
        </div>
    </form>
</div>
@endsection
