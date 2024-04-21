<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view("user.home");
    return redirect("/login");
});


Route::group(["prefix" => "/" , "as" => "users." , "middleware" => ["auth" , "isuser"]] , function()
{
    Route::get("/index" , [UserController:: class , "index"])->name("index");
    Route::get("/create" , [UserController:: class , "create"])->name("create");
    Route::get("/update/{id}" , [UserController:: class , "update"])->name("update");
    Route::post("storeAlbum" , [UserController::class , "storeAlbum"])->name("storeAlbum");
    Route::put("edit/{id}" , [UserController::class , "edit"])->name("edit");
});

Route::group(["prefix" => "albums" , "as" => "albums." , "middleware" => ["auth" , "isuser"]] , function()
{
    Route::get("/{id}" , [AlbumController:: class , "index"])->name("index");
    Route::get("/newImage/{id}" , [AlbumController::class, "newImage"])->name("newImage");
    Route::post("/storeNewImage/{id}" , [AlbumController::class, "storeNewImage"])->name("storeNewImage");
    Route::get("/delete/{id}" , [AlbumController::class, "delete"])->name("delete");
    Route::get("/moveImages/{id}" , [AlbumController::class, "moveImages"])->name("moveImages");
    Route::post("/moveImagesPost/{id}" , [AlbumController::class, "moveImagesPost"])->name("moveImagesPost");
});



Auth::routes();



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
