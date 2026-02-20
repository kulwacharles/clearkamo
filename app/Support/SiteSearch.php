<?php

namespace App\Support;

use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Publication;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimony;
use App\Models\Vacancy;
use App\Models\WhoWeAre;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SiteSearch
{
    /**
     * @return array<int, array{type:string,title:string,snippet:string,url:string,updated_at:string}>
     */
    public static function search(string $term, int $limit = 50): array
    {
        $q = trim($term);

        if ($q === '' || Str::length($q) < 2) {
            return [];
        }

        $items = collect();

        $publishedOrActive = ['published', 'active'];
        $like = DB::getDriverName() === 'pgsql' ? 'ilike' : 'like';

        $blogs = Blog::query()
            ->whereIn('status', $publishedOrActive)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            })
            ->limit(12)
            ->get();

        foreach ($blogs as $blog) {
            $items->push(self::item('News & Updates', $blog->title, (string) $blog->description, url('/news-and-updates/details/' . $blog->slug), optional($blog->updated_at)?->toDateString()));
        }

        $publications = Publication::query()
            ->whereIn('status', $publishedOrActive)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            })
            ->limit(12)
            ->get();

        foreach ($publications as $publication) {
            $items->push(self::item('Publication', $publication->title, (string) $publication->description, url('/publication/details/' . $publication->slug), optional($publication->updated_at)?->toDateString()));
        }

        $services = Service::query()
            ->whereIn('status', $publishedOrActive)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            })
            ->limit(12)
            ->get();

        foreach ($services as $service) {
            $items->push(self::item('Service', $service->title, (string) $service->description, url('/service/details/' . $service->slug), optional($service->updated_at)?->toDateString()));
        }

        $projectTitleColumn = self::projectTitleColumn();

        $projects = Project::query()
            ->whereIn('status', $publishedOrActive)
            ->where(function ($query) use ($q, $projectTitleColumn) {
                $query->where($projectTitleColumn, 'like', "%{$q}%");

                if (Schema::hasColumn('projects', 'description')) {
                    $query->orWhere('description', 'like', "%{$q}%");
                }

                if (Schema::hasColumn('projects', 'category')) {
                    $query->orWhere('category', 'like', "%{$q}%");
                }
            })
            ->limit(12)
            ->get();

        foreach ($projects as $project) {
            $items->push(self::item(
                'Project',
                (string) data_get($project, $projectTitleColumn, ''),
                (string) data_get($project, 'description', ''),
                url('/project-details/' . $project->slug),
                optional($project->updated_at)?->toDateString()
            ));
        }

        $vacancies = Vacancy::query()
            ->whereIn('status', $publishedOrActive)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('contract', 'like', "%{$q}%")
                    ->orWhere('department', 'like', "%{$q}%");
            })
            ->limit(12)
            ->get();

        foreach ($vacancies as $vacancy) {
            $items->push(self::item('Vacancy', $vacancy->title, (string) $vacancy->description, url('/vacancy/details/' . $vacancy->slug), optional($vacancy->updated_at)?->toDateString()));
        }

        $teams = Team::query()
            ->when(Schema::hasColumn('teams', 'status'), function ($query) use ($publishedOrActive) {
                $query->whereIn('status', $publishedOrActive);
            })
            ->where(function ($query) use ($q, $like) {
                $query->where('name', $like, "%{$q}%")
                    ->orWhere('description', $like, "%{$q}%")
                    ->orWhere('position', $like, "%{$q}%");

                if (Schema::hasColumn('teams', 'salute')) {
                    $query->orWhere('salute', $like, "%{$q}%");
                }
            })
            ->limit(10)
            ->get();

        foreach ($teams as $team) {
            $items->push(self::item(
                'Team',
                (string) $team->name,
                (string) $team->description,
                url('/team-details/' . ($team->slug ?: $team->id)),
                optional($team->updated_at)?->toDateString()
            ));
        }

        $testimonies = Testimony::query()
            ->whereIn('status', $publishedOrActive)
            ->where(function ($query) use ($q, $like) {
                $query->where('name', $like, "%{$q}%")
                    ->orWhere('position', $like, "%{$q}%")
                    ->orWhere('description', $like, "%{$q}%");
            })
            ->limit(12)
            ->get();

        foreach ($testimonies as $testimony) {
            $items->push(self::item(
                'Testimonial',
                (string) $testimony->name,
                (string) $testimony->description,
                url('/?testimonial=' . $testimony->id . '#testimonials'),
                optional($testimony->updated_at)?->toDateString()
            ));
        }

        $about = About::query()->first();
        if ($about && self::matches($q, [$about->title, $about->description, $about->description_2 ?? null, $about->keywords ?? null])) {
            $items->push(self::item('Page', 'About Us', (string) $about->description, url('/about-us'), optional($about->updated_at)?->toDateString()));
        }

        $whoWeAre = WhoWeAre::query()->first();
        if ($whoWeAre && self::matches($q, [$whoWeAre->title, $whoWeAre->description])) {
            $items->push(self::item('Page', 'Who We Are', (string) $whoWeAre->description, url('/about-us'), optional($whoWeAre->updated_at)?->toDateString()));
        }

        $contact = Contact::query()->first();
        if ($contact && self::matches($q, [$contact->physical_address, $contact->email, $contact->phone, $contact->extra_1 ?? null])) {
            $items->push(self::item('Page', 'Contact Us', (string) $contact->physical_address, url('/contact-us'), optional($contact->updated_at)?->toDateString()));
        }

        foreach (self::staticPages($q) as $page) {
            $items->push($page);
        }

        return $items
            ->unique(fn ($item) => $item['type'] . '|' . $item['url'] . '|' . Str::lower($item['title']))
            ->sortByDesc(fn ($item) => self::score($q, $item['title'], $item['snippet']))
            ->take($limit)
            ->values()
            ->toArray();
    }

    private static function item(string $type, string $title, string $body, string $url, ?string $updatedAt): array
    {
        return [
            'type' => $type,
            'title' => $title,
            'snippet' => Str::limit(trim(strip_tags(html_entity_decode($body))), 150, '...'),
            'url' => $url,
            'updated_at' => $updatedAt ?? '',
        ];
    }

    private static function matches(string $term, array $texts): bool
    {
        $needle = Str::lower($term);

        foreach ($texts as $text) {
            if (!empty($text) && str_contains(Str::lower((string) $text), $needle)) {
                return true;
            }
        }

        return false;
    }

    private static function score(string $term, string $title, string $snippet): int
    {
        $needle = Str::lower($term);
        $titleLower = Str::lower($title);
        $snippetLower = Str::lower($snippet);

        $score = 0;

        if (str_starts_with($titleLower, $needle)) {
            $score += 50;
        }

        if (str_contains($titleLower, $needle)) {
            $score += 25;
        }

        if (str_contains($snippetLower, $needle)) {
            $score += 10;
        }

        return $score;
    }

    private static function staticPages(string $q): Collection
    {
        $pages = collect([
            self::item('Page', 'Home', 'Welcome to Project CLEAR home page.', url('/'), ''),
            self::item('Page', 'Services', 'Explore all consulting services.', url('/services'), ''),
            self::item('Page', 'Projects', 'Discover current and past projects.', url('/projects'), ''),
            self::item('Page', 'Vacancies', 'Open roles and opportunities.', url('/vacancies'), ''),
            self::item('Page', 'Publications', 'Read our publications and reports.', url('/publications'), ''),
            self::item('Page', 'News & Updates', 'Latest updates and announcements.', url('/news-and-updates'), ''),
            self::item('Page', 'Contact Us', 'Contact details and inquiry form.', url('/contact-us'), ''),
            self::item('Page', 'About Us', 'Learn about our mission and team.', url('/about-us'), ''),
        ]);

        return $pages->filter(fn ($page) => self::matches($q, [$page['title'], $page['snippet']]));
    }

    private static function projectTitleColumn(): string
    {
        return Schema::hasColumn('projects', 'title') ? 'title' : 'project_name';
    }
}
