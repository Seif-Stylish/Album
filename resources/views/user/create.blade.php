@extends('layouts.parent')

@section('content')

<div class="p-4"></div>

<form method="post" action="{{ route('users.storeAlbum') }}" class="container p-4 createAlbumForm">
    @csrf
    <h2 class="text-primary text-center">Create Album</h2>
    <div class="p-4">

        <input type="text" class="form-control" placeholder="name" name="name">

        @error('name')
            <div class="alert alert-danger mt-3 p-2">{{ $message }}</div>
        @enderror

        <div class="pt-5">
            <button class="btn btn-primary">Create</button>
        </div>

    </div>
</form>




@endsection




