@extends('layouts.parent')

@section('content')

@include("includes.message")

<div class="container p-4">
    <div class="row">
        @foreach ($allAlbums as $album)
            <div class="col-xl-4">
                <div class="m-3 p-3 text-center" style="border: 2px solid black; border-radius: 7px;">
                    <h2 class="text-primary">
                        <a class="albumLink" href="{{ route('albums.index' , $album->id) }}">{{ $album->name }}</a>
                    </h2>
                    <img src="{{ url('/images/albums/album.jpg') }}" class="img-fluid w-100" style="height: 300px">

                    <div class="d-flex my-3" style="justify-content: space-between">

                        <a href="{{ route('users.update' , $album->id) }}">
                            <button class="btn btn-primary">Update</button>
                        </a>

                        <a href="{{ route('albums.newImage' , $album->id) }}">
                            <button class="btn btn-warning">Add Image</button>
                        </a>

                        @if(DB::select("select count(*) as x from album_image where album_id =".$album->id)[0]->x >= 1 && ( DB::select("select count(*) as y from albums where user_id = ".Auth::user()->id)[0]->y ) > 1)

                        <button class="btn btn-success nonEmptyButton">Delete</button>


                        @else
                            <a href="{{ route('albums.delete' , $album->id) }}"><button class="btn btn-danger emptyButton">Delete</button></a>
                        @endif

                    </div>

                    <div class="p-2">
                        @if( DB::select("select count(*) as x from album_image where album_id =".$album->id)[0]->x > 0)
                            This album has {{ DB::select("select count(*) as x from album_image where album_id =".$album->id)[0]->x }} images
                        @else
                            Empty Album
                        @endif
                    </div>

                    @if(DB::select("select count(*) as x from album_image where album_id =".$album->id)[0]->x > 0 && ( DB::select("select count(*) as y from albums where user_id = ".Auth::user()->id)[0]->y ) > 1)

                        <div class="dropDownDiv p-2" style="justify-content: space-between; border: 2px solid black; border-radius: 7px;">
                            <a href="{{ route('albums.moveImages' , $album->id) }}">
                                <button class="btn btn-primary w-100">move to another album</button>
                            </a>
                            <div class="my-2"></div>
                            <a href="{{ route('albums.delete' , $album->id) }}">
                                <a href="{{ route('albums.delete' , $album->id) }}">
                                    <button class="btn btn-danger w-100">delete the album with its images</button>
                                </a>
                            </a>
                        </div>

                    @endif

                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection




