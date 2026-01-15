<?php

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/docs',[App\Http\Controllers\DocumentController::class,'get_docs'])->name('docs');
Route::get('/blog-list',function(){
    $blogs=Blog::all();
    return response()->json($blogs);
});