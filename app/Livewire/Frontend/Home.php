<?php

namespace App\Livewire\Frontend;
use App\Models\About;
use App\Models\FocusArea;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimony;
use App\Models\Blog;
use App\Models\Client;
use App\Models\CoreValue;
use App\Models\GalleryPhoto;
use App\Models\Project;
use App\Models\Service;
use App\Models\CeoMessage;
use Livewire\Component;
use Illuminate\Support\Str;

class Home extends Component
{
        public $title, $description,$seodescription, $years_of_experience, $image, $image2,$testimonies,$blogs,$services,$clients;
        public $id, $imagePath, $image2Path, $about1, $about2;
        public $slides=null;
        public $teams,$keywords;
        public $aboutVideoEmbedUrl = null;
        public $focusAreas;
        public $projectsCount = 0;
        public $partnersCount = 0;
        public $coreValues;
        public $galleryProjects;
        public $ceoMessage = null;
        

        public function mount()
    {
        $this->services=Service::where("status","published")->get();
        $this->clients=Client::whereIn("status", ["published", "active"])->latest()->get();
        $this->slides=Slider::where("status","published")->get();
        $this->projectsCount = Project::where('status', 'published')->count();
        $this->partnersCount = Client::whereIn('status', ['published', 'active'])->count();
        $this->coreValues = CoreValue::where('status', 'published')->orderBy('sort_order')->orderBy('id')->get();
        // Load projects that have published gallery photos
        $this->galleryProjects = Project::where('status', 'published')
            ->whereHas('galleryPhotos', fn ($q) => $q->where('status', 'published'))
            ->with(['galleryPhotos' => fn ($q) => $q->where('status', 'published')])
            ->orderBy('title')
            ->get();
        $about = About::first();
        $this->testimonies=Testimony::where('status','published')->get();
        $this->blogs=Blog::where('status','published')->whereNotNull('slug')->where('slug','!=','')->orderBy('id','desc')->latest()->take(5)->get();
        $this->teams=Team::where('status',"published")->get();
        $this->focusAreas=FocusArea::where('status','published')->orderBy('sort_order')->orderBy('id')->get();
        $this->ceoMessage = CeoMessage::where('is_active', true)->with('team')->first();
        if ($about) {
            $this->id = $about->id;
            $this->title = $about->title;
            $this->description = $about->description;
            $this->years_of_experience = $about->ex_years;
            $this->about1 = $about->image;
            $this->about2 = $about->image2;
            $this->keywords = $about->keywords;
            $this->seodescription=Str::limit($this->description, 350, '...');
            $this->aboutVideoEmbedUrl = $this->toYouTubeEmbedUrl($about->youtube_url);
            // Push initial description into CKEditor
            //$this->dispatch('load-ckeditor-data', $this->description);
        }
        
    }
    public function render()
    {
        $about = About::first();
        return view('livewire.frontend.home', [
            'about' => $about,
            'services' => $this->services,
            'clients' => $this->clients,
            'slides' => $this->slides,
            'testimonies' => $this->testimonies,
            'blogs' => $this->blogs,
            'teams' => $this->teams,
            'aboutVideoEmbedUrl' => $this->aboutVideoEmbedUrl,
            'focusAreas' => $this->focusAreas,
            'projectsCount' => $this->projectsCount,
            'partnersCount' => $this->partnersCount,
            'coreValues' => $this->coreValues,
            'galleryProjects' => $this->galleryProjects,
            'ceoMessage'      => $this->ceoMessage,
        ])->layout("components.layouts.frontend", ["title"=>$this->title,"description"=>Str::limit(html_entity_decode(strip_tags($this->description)), 350, '...'),"keywords"=>$this->keywords,"image"=>$this->image]);
    }

    private function toYouTubeEmbedUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $url = trim($url);
        if ($url === '') {
            return null;
        }

        $videoId = null;

        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $url)) {
            $videoId = $url;
        } else {
            $parts = parse_url($url);
            $host = strtolower($parts['host'] ?? '');
            $path = trim($parts['path'] ?? '', '/');

            if (str_contains($host, 'youtu.be')) {
                $videoId = $path;
            } elseif (str_contains($host, 'youtube.com') || str_contains($host, 'youtube-nocookie.com')) {
                parse_str($parts['query'] ?? '', $query);

                if (!empty($query['v'])) {
                    $videoId = $query['v'];
                } elseif (str_starts_with($path, 'embed/')) {
                    $videoId = substr($path, 6);
                } elseif (str_starts_with($path, 'shorts/')) {
                    $videoId = substr($path, 7);
                } elseif (str_starts_with($path, 'live/')) {
                    $videoId = substr($path, 5);
                }
            }
        }

        if (!is_string($videoId)) {
            return null;
        }

        $videoId = trim($videoId);
        if (!preg_match('/^[A-Za-z0-9_-]{11}$/', $videoId)) {
            return null;
        }

        return "https://www.youtube.com/embed/{$videoId}?autoplay=1&mute=1&playsinline=1&rel=0&modestbranding=1&hd=1";
    }
}
