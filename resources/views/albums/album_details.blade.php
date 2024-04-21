@extends('layouts.parent')

@section('content')

@include("includes.message")

<div class="p-4"></div>

<h2 class="text-primary text-center">{{ $albumDetails->name }}</h2>

<div class="container py-4">
    <div class="row">
        @foreach ($albumImages as $albumImage)
            <div class="col-xl-4">
                <div class="p-3" style="border: 2px solid black; border-radius: 7px">
                    <img src="{{ url("/images/albums/".$albumImage->image) }}" class="img-fluid w-100" style="height: 300px">

                    <h2 class="text-primary m-3">{{ $albumImage->name }}</h2>

                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
