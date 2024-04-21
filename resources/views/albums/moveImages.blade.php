@extends('layouts.parent')

@section('content')

<div class="p-3"></div>

<h2 class="text-primary text-center">Move Images</h2>

<div class="p-3"></div>

<div class="container p-4 moveImagesForm">
    <form method="post" action="{{ route('albums.moveImagesPost' , $id) }}" class="p-3">
        @csrf
        <select name="album_id" class="form-control">
            @foreach ($myAlbums as $myAlbum)
                <option value="{{ $myAlbum->id }}" {{ old('album_id') == $myAlbum->id ? "selected" : "" }}>
                    {{ $myAlbum->name }}
                </option>
            @endforeach
        </select>

        @error('album_id')
            <div class="alert alert-danger p-3">{{ $message }}</div>
        @enderror

        <div class="p-4"></div>

        <button class="btn btn-primary">Move</button>

    </form>
</div>


@endsection




