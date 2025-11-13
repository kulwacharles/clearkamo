<?php
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Livewire\Slider\Sliders;
use App\Livewire\About\Abouts;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\AboutUs;
use App\Livewire\Frontend\ContactUs;
use App\Livewire\Frontend\BlogList;
use App\Livewire\Frontend\Publications;
use App\Livewire\Blog\BackendBlog;
use App\Livewire\Client\ClientBackend;
use App\Livewire\Frontend\BlogDetails;
use App\Livewire\Frontend\ProjectDetails;
use App\Livewire\Frontend\Projects;
use App\Livewire\Frontend\PublicationDetails;
use App\Livewire\Frontend\ServiceDetails;
use App\Livewire\Frontend\Services;
use App\Livewire\Frontend\TeamDetails;
use App\Livewire\Frontend\Vacancies;
use App\Livewire\Frontend\VacancyDetails;
use App\Livewire\Publication\BackendPublications;
use App\Livewire\Project\BackendProject;
use App\Livewire\Service\BackendService;
use App\Livewire\Team\BackendTeam;
use App\Livewire\Testimony\TestimonyBackend;
use App\Livewire\Vacancy\VacancyBackend;


// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', Login::class)->name('login');
    Route::get('/admin/register', Register::class)->name('register');
});
Route::middleware(['auth'])->prefix('/admin')->group(function () {
    Route::get('sliders',Sliders::class)->name('sliders');
    Route::get('about-us',Abouts::class)->name('admin.about');
    Route::get('blog-posts',BackendBlog::class)->name('blogs');
    Route::get('publications',BackendPublications::class)->name('publications');
    Route::get('projects',BackendProject::class)->name('projects');
    Route::get('services',BackendService::class)->name('services');
    Route::get('vacancies',VacancyBackend::class)->name('admin.vacancies');
    Route::get('team',BackendTeam::class)->name('admin.team');
    Route::get('testimony',TestimonyBackend::class)->name('admin.testimony');
    Route::get('client',ClientBackend::class)->name('admin.client');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about-us', AboutUs::class,)->name('about-us');
Route::get('/',Home::class)->name('home');
Route::get('/contact-us',ContactUs::class)->name('contact-us');
Route::get('/news-and-updates',BlogList::class)->name('news-and-update');
Route::get('/publications',Publications::class)->name('publications');
Route::get('/team-details/{id}',TeamDetails::class)->name('team-details');
Route::get('/news-and-updates/details/{id}',BlogDetails::class)->name('news-and-updates.details');
Route::get('publication/details/{id}',PublicationDetails::class)->name('publication.details');
Route::get('/services',Services::class)->name('services');
Route::get('service/details/{id}',ServiceDetails::class)->name('service.details');
Route::get('/projects',Projects::class)->name('projects');
Route::get('/project-details/{id}',ProjectDetails::class)->name('project');
Route::get('vacancies',Vacancies::class)->name('vacancies');
Route::get('vacancy/details/{id}',VacancyDetails::class)->name('vacancy.details');