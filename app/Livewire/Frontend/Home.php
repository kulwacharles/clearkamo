<?php

namespace App\Livewire\Frontend;
use App\Models\About;
use App\Models\FocusArea;
use App\Models\Slider;
use App\Models\WhoWeAre;
use App\Models\Team;
use App\Models\Testimony;
use App\Models\Blog;
use App\Models\Client;
use App\Models\CoreValue;
use App\Models\GalleryPhoto;
use App\Models\Project;
use App\Models\Publication;
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
        public $whoWeAreVideoEmbedUrl = null;
        public $focusAreas;
        public $projectsCount = 0;
        public $partnersCount = 0;
        public $coreValues;
        public $galleryProjects;
        public $ceoMessage = null;
        public $projects;
        public $publications;
        public $whoWeAre;
        

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
        // Load projects for the picture grid (support both 'published' and 'active' status)
        $this->projects = Project::whereIn('status', ['published', 'active'])->orderBy('title')->take(6)->get();
        // Load publications for home section
        $this->publications = Publication::where('status', 'published')->orderBy('id', 'desc')->take(6)->get();
        $about = About::first();
        $this->testimonies=Testimony::where('status','published')->get();
        $this->blogs=Blog::where('status','published')->whereNotNull('slug')->where('slug','!=','')->orderBy('id','desc')->latest()->take(5)->get();
        $this->teams=Team::where('status',"published")->get();
        $this->focusAreas=FocusArea::where('status','published')->orderBy('sort_order')->orderBy('id')->get();
        $this->ceoMessage = CeoMessage::where('is_active', true)->with('team')->first();
        $this->whoWeAre = WhoWeAre::query()->first();
        if ($this->whoWeAre) {
            $this->whoWeAreVideoEmbedUrl = $this->toYouTubeEmbedUrl($this->whoWeAre->youtube_url);
        }

        if ($about) {
            $this->id = $about->id;
            $this->title = $about->title;
            $this->description = $about->description;
            $this->years_of_experience = $about->ex_years;
            $this->about1 = $about->image;
            $this->about2 = $about->image2;
            $this->keywords = $about->keywords;
            $this->seodescription=Str::limit($this->description, 350, '...');
            $this->image = $about->logo ? url('/storage/'.$about->logo) : null;
            // Push initial description into CKEditor
            //$this->dispatch('load-ckeditor-data', $this->description);
        } elseif ($this->whoWeAre) {
            $this->title = $this->whoWeAre->title ?: 'ClearKamo';
            $this->description = strip_tags((string) $this->whoWeAre->description);
            $this->seodescription = Str::limit($this->description, 350, '...');
            $this->image = $this->whoWeAre->image_path ? url('/storage/'.$this->whoWeAre->image_path) : null;
        }
        
    }
    public function render()
    {
        return view('livewire.frontend.home', [
            'whoWeAre' => $this->whoWeAre,
            'services' => $this->services,
            'clients' => $this->clients,
            'slides' => $this->slides,
            'testimonies' => $this->testimonies,
            'blogs' => $this->blogs,
            'teams' => $this->teams,
            'whoWeAreVideoEmbedUrl' => $this->whoWeAreVideoEmbedUrl,
            'focusAreas' => $this->focusAreas,
            'projectsCount' => $this->projectsCount,
            'partnersCount' => $this->partnersCount,
            'coreValues' => $this->coreValues,
            'galleryProjects' => $this->galleryProjects,
            'ceoMessage'      => $this->ceoMessage,
            'projects'        => $this->projects,
            'publications'    => $this->publications,
        ])->layout("components.layouts.frontend", ["title"=>$this->title,"description"=>Str::limit(html_entity_decode(strip_tags((string) $this->description)), 350, '...'),"keywords"=>$this->keywords,"image"=>$this->image]);
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
