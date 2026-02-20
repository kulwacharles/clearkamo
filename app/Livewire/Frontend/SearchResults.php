<?php

namespace App\Livewire\Frontend;

use App\Models\About;
use App\Models\SearchQuery;
use App\Support\SiteSearch;
use Illuminate\Support\Str;
use Livewire\Component;

class SearchResults extends Component
{
    public string $q = '';
    public array $results = [];

    protected $queryString = [
        'q' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->q = trim((string) request('q', $this->q));
        $this->logSearchFromPage();
        $this->runSearch();
    }

    public function updatedQ(): void
    {
        $this->runSearch();
    }

    public function runSearch(): void
    {
        $this->results = SiteSearch::search($this->q, 80);
    }

    public function render()
    {
        $about = About::first();

        return view('livewire.frontend.search-results', [
            'results' => $this->results,
            'q' => $this->q,
        ])->layout('components.layouts.frontend', [
            'title' => 'Search - ' . ($this->q ?: 'Website'),
            'description' => 'Search results for ' . ($this->q ?: 'website content'),
            'keywords' => 'search, website search, project clear',
            'image' => $about?->logo,
        ]);
    }

    private function logSearchFromPage(): void
    {
        if (Str::length($this->q) < 2) {
            return;
        }

        $request = request();

        SearchQuery::create([
            'term' => $this->q,
            'normalized_term' => Str::lower($this->q),
            'path' => '/' . ltrim($request->path(), '/'),
            'source' => 'search-results-page',
            'session_id' => $request->session()->getId(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'searched_at' => now(),
            'day' => now()->toDateString(),
            'month_key' => now()->format('Y-m'),
        ]);
    }
}
