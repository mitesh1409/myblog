<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
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
    return view('posts');
});

Route::get('/post/{slug}', function ($slug) {
    $filePath = resource_path("posts/$slug.html");

    if (!file_exists($filePath)) {
        abort(Response::HTTP_NOT_FOUND);
    }

    $post = Cache::rememberForever("post.$slug", fn() => file_get_contents($filePath));

    return view('post', [
        'post' => $post
    ]);
})->where('slug', '[A-z_\-]+');
