<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumImageRequest;
use App\Http\Requests\MoveImagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index($id)
    {
        $albumDetails = DB::select("select * from albums where id = ".$id);

        $albumDetails = $albumDetails[0];

        $albumImages = DB::select("select * from album_image where album_id = ".$id);

        return view("albums.album_details" , compact("albumDetails" , "albumImages"));
    }

    public function newImage($id)
    {
        $album = DB::select("select * from albums where id = ".$id);

        $album = $album[0];

        return view("albums.newImage" , compact("album"));
    }

    public function storeNewImage($id , AlbumImageRequest $request)
    {
        $data = $request->all();
        $photoName = uniqid() . ".".$request->image->extension();

        $request->image->move(public_path("/images/albums") , $photoName);

        $data = $request->except("_token" , "image");

        // "image" => ["required" , "max:1000" , "mimes:png,jpg,jpeg"]

        $data["image"] = $photoName;
        $data["album_id"] = (int)$id;

        DB::table("album_image")->insert($data);

        return redirect()->route("albums.index" , $id)->with("success" , "image added successfully");
    }

    public function delete($id)
    {
        $album = DB::select("select * from albums where id = ".$id);
        $album = $album[0];

        if($album->user_id != Auth::user()->id)
        {
            return redirect()->route("users.index");
        }

        $isDeleted = DB::delete("delete from albums where id = ".$id);

        return redirect()->route("users.index")->with("success" , "album deleted successfully");
    }

    public function moveImages($id)
    {
        $album = DB::select("select * from albums where id = ".$id);

        $album = $album[0];

        if($album->user_id != Auth::user()->id)
        {
            return redirect()->route("users.index");
        }

        $myAlbums = DB::select("select * from albums where user_id = ".Auth::user()->id." and id <>".$id);

        if(count($myAlbums) <= 0)
        {
            return redirect()->route("users.index")->with("error" , "do not try to access an invalid album");
        }

        else if(count($myAlbums) == 1)
        {
            $isUpdated = DB::update("update album_image set album_id = ".$myAlbums[0]->id." where album_id = ".$id);

            return redirect()->route("users.index")->with("success" , "images moved successfully");
        }

        return view("albums.moveImages" , compact("myAlbums" , "id"));
    }

    public function moveImagesPost($id , MoveImagesRequest $request)
    {
        $new_album = DB::select("select * from albums where id = $id");

        $new_album = $new_album[0];

        if($new_album->user_id != Auth::user()->id)
        {
            return redirect()->route("users.index")->with("error" , "do not try to access an invalid album");
        }

        $is_my_album = DB::select("select * from albums where id = ".$request->album_id);

        $is_my_album = $is_my_album[0];

        if($is_my_album->user_id != Auth::user()->id)
        {
            return redirect()->route("users.index")->with("error" , "do not try to access an invalid album");
        }

        $isUpdated = DB::update("update album_image set album_id = ".$request->album_id." where album_id = ".$id);

        return redirect()->route("users.index")->with("success" , "images moved successfully");
    }
}
