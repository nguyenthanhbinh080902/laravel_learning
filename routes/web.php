<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VideoController;


Route::get('/', [IndexController::class, 'home']);
Route::get('/dich-vu', [IndexController::class, 'dichvu'])->name('dichvu');
Route::get('/dich-vu/{slug}', [IndexController::class, 'dichvucon'])->name('dichvucon');
Route::get('/danh-muc-game/{slug}', [IndexController::class, 'danhmuc'])->name('danhmuc');
Route::get('/danh-muc-con/{slug}', [IndexController::class, 'danhmuccon'])->name('danhmuccon');
Route::get('/trang-blog', [IndexController::class, 'blogs'])->name('blogs');
Route::get('/blog-danhmuc/{slug}', [IndexController::class, 'blogs_detail'])->name('blogs_detail');
Route::get('/video-highlight', [IndexController::class, 'video_highlight'])->name('video-highlight');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
//category
Route::resource('category', CategoryController::class);
Route::resource('slider', SliderController::class);
Route::resource('blog', BlogController::class);
Route::resource('video', VideoController::class);