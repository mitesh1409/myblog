<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('posts');
});

Route::get('/posts/{slug}', function ($slug) {
    $filePath = __DIR__ . "/../resources/posts/$slug.html";

    if (! file_exists($filePath)) {
        abort(Response::HTTP_NOT_FOUND);
    }

    $post = file_get_contents($filePath);

    return view('post', [
        'post' => $post
    ]);
});
