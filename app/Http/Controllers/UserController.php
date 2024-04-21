<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlbumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $allAlbums = DB::select("select * from albums where user_id = ".Auth::user()->id);

        //dd($allAlbums);

        return view("user.home" , compact("allAlbums"));
    }

    public function create()
    {
        return view("user.create");
    }

    public function storeAlbum(CreateAlbumRequest $request)
    {
        $data = $request->except("_token");
        $data["user_id"] = Auth::user()->id;

        $isCreated = DB::table("albums")->insert($data);

        return redirect()->route("users.index")->with("success" , "album created successfully");
    }

    public function update($id)
    {
        $allUserAlbums = DB::select("select * from albums where user_id = ".Auth::user()->id);

        $flag = 0;

        for($i = 0; $i < count($allUserAlbums); $i++)
        {
            if($allUserAlbums[$i]->id == $id)
            {
                $flag = 1;
                break;
            }
        }

        if($flag == 0)
        {
            return redirect()->route("users.index");
        }

        $album = DB::select("select * from albums where id = ".$id);

        $album = $album[0];

        return view("user.update" , compact("album"));
    }

    public function edit($id , Request $request)
    {
        $data = $request->except("_token" , "_method");

        $rules =[
            "name" => ["required" , "string" , "unique:albums,name,$id,id" , "min:2" , "max:50"]
        ];

        $request->validate($rules);

        DB::table("albums")->where('id' , $id)->update($data);
        return redirect()->route("users.index")->with("success" , "album updated successfully");
    }
}
