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
use App\Livewire\Contact\BackendContacts;
use App\Livewire\Frontend\BlogDetails;
use App\Livewire\Frontend\ProjectDetails;
use App\Livewire\Frontend\Projects;
use App\Livewire\Frontend\PublicationDetails;
use App\Livewire\Frontend\ServiceDetails;
use App\Livewire\Frontend\Services;
use App\Livewire\Frontend\TeamDetails;
use App\Livewire\Frontend\Vacancies;
use App\Livewire\Frontend\VacancyDetails;
use App\Livewire\Frontend\SearchResults;
use App\Livewire\Frontend\BusinessInquiry as FrontendBusinessInquiry;
use App\Livewire\Publication\BackendPublications;
use App\Livewire\Project\BackendProject;
use App\Livewire\Service\BackendService;
use App\Livewire\Admin\BusinessInquiries as AdminBusinessInquiries;
use App\Livewire\Team\BackendTeam;
use App\Livewire\Testimony\TestimonyBackend;
use App\Livewire\Vacancy\VacancyBackend;
use App\Livewire\AdminChat;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\MaintenanceMode as AdminMaintenanceMode;
use App\Livewire\FocusArea\BackendFocusArea;
use App\Livewire\CoreValue\BackendCoreValue;
use App\Models\Blog;
use App\Models\ChatMessage;

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', Login::class)->name('login');
    //Route::get('/admin/register', Register::class)->name('register');
});
Route::middleware(['auth'])->prefix('/admin')->group(function () {
    Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('sliders',Sliders::class)->name('sliders');
    Route::get('about-us',Abouts::class)->name('admin.about');
    Route::get('blog-posts',BackendBlog::class)->name('admin.blogs');
    Route::get('publications',BackendPublications::class)->name('admin.publications');
    Route::get('projects',BackendProject::class)->name('admin.projects');
    Route::get('services',BackendService::class)->name('admin.services');
    Route::get('vacancies',VacancyBackend::class)->name('admin.vacancies');
    Route::get('team',BackendTeam::class)->name('admin.team');
    Route::get('testimony',TestimonyBackend::class)->name('admin.testimony');
    Route::get('client',ClientBackend::class)->name('admin.client');
    Route::get('contacts',BackendContacts::class)->name('admin.contacts');
    Route::get('business-inquiries', AdminBusinessInquiries::class)->name('admin.business-inquiries');
    Route::get('maintenance', AdminMaintenanceMode::class)->name('admin.maintenance');
    Route::get('focus-areas', BackendFocusArea::class)->name('admin.focus-areas');
    Route::get('core-values', BackendCoreValue::class)->name('admin.core-values');
    Route::get('chat/realtime', function () {
        $latestUserMessage = ChatMessage::where('sender_type', 'user')
            ->latest('id')
            ->first();

        $unreadChats = ChatMessage::where('sender_type', 'user')
            ->where('is_read', false)
            ->distinct('session_id')
            ->count('session_id');

        $unreadMessages = ChatMessage::where('sender_type', 'user')
            ->where('is_read', false)
            ->count();

        return response()->json([
            'unread_chats' => $unreadChats,
            'unread_messages' => $unreadMessages,
            'latest_user_message_id' => $latestUserMessage?->id,
            'latest_user_name' => $latestUserMessage?->name ?: 'Guest User',
            'latest_user_message' => $latestUserMessage?->message ?: '',
            'latest_user_session_id' => $latestUserMessage?->session_id,
        ]);
    })->name('admin.chat.realtime');

    Route::get('chat',AdminChat::class)->name('admin.chat');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('maintenance')->group(function () {
    Route::get('/about-us', AboutUs::class,)->name('about-us');
    Route::get('/',Home::class)->name('home');
    Route::get('/contact-us',ContactUs::class)->name('contact-us');
    Route::get('/news-and-updates',BlogList::class)->name('news-and-update');
    Route::get('/publications',Publications::class)->name('publications');
    Route::get('/team-details/{slug}',TeamDetails::class)->name('team-details');
    Route::get('/news-and-updates/details/{slug}',BlogDetails::class)->name('news-and-updates.details');
    Route::get('publication/details/{slug}',PublicationDetails::class)->name('publication.details');
    Route::get('/services',Services::class)->name('services');
    Route::get('service/details/{slug}',ServiceDetails::class)->name('service.details');
    Route::get('/projects',Projects::class)->name('projects');
    Route::get('/project-details/{slug}',ProjectDetails::class)->name('project');
    Route::get('vacancies',Vacancies::class)->name('vacancies');
    Route::get('vacancy/details/{slug}',VacancyDetails::class)->name('vacancy.details');
    Route::get('/search', SearchResults::class)->name('search.results');
    Route::get('/business-inquiry', FrontendBusinessInquiry::class)->name('business-inquiry');
});
