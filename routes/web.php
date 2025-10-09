<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Slider\Sliders;
use App\Livewire\About\Abouts;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\AboutUs;
use App\Livewire\Frontend\ContactUs;
use App\Livewire\Frontend\BlogList;
use App\Livewire\Frontend\Publications;
use App\Livewire\Blog\BackendBlog;
use App\Livewire\Publication\BackendPublications;
use App\Livewire\Project\BackendProject;
use App\Livewire\Service\BackendService;

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();
Route::prefix('/admin')->group(function () {
    Route::get('sliders',Sliders::class)->name('sliders');
    Route::get('about-us',Abouts::class)->name('about');
    Route::get('blog-posts',BackendBlog::class)->name('blogs');
    Route::get('publications',BackendPublications::class)->name('publications');
    Route::get('projects',BackendProject::class)->name('projects');
    Route::get('services',BackendService::class)->name('services');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about-us', AboutUs::class,)->name('about-us');
Route::get('/',Home::class)->name('home');
Route::get('/contact-us',ContactUs::class)->name('contact-us');
Route::get('/news-and-update',BlogList::class)->name('news-and-update');
Route::get('/publications',Publications::class)->name('publications');