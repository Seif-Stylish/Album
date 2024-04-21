@extends('layouts.parent')

@section('content')

<div class="p-4"></div>

<h2 class="text-primary text-center">{{ $album->name }}</h2>

<div class="p-3"></div>




<form method="post" action="{{ route('albums.storeNewImage' , $album->id) }}" enctype="multipart/form-data" class="container p-4 createAlbumForm">
    @csrf

    <h2 class="text-primary text-center">Add New Image</h2>
    <div class="p-4">

        <input type="file" name="image" class="form-control">

        @error('image')
            <div class="alert alert-danger p-3">{{ $message }}</div>
        @enderror

        <div class="p-3"></div>

        <input type="text" name="name" class="form-control" placeholder="name" value="{{ old('name') }}">

        @error('name')
            <div class="alert alert-danger p-3">{{ $message }}</div>
        @enderror

        <div class="pt-5">
            <button class="btn btn-primary">Add Image</button>
        </div>

    </div>
</form>






@endsection
