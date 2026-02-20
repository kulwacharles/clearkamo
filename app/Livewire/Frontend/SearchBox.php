<?php

namespace App\Livewire\Frontend;

use App\Models\SearchQuery;
use App\Support\SiteSearch;
use Illuminate\Support\Str;
use Livewire\Component;

class SearchBox extends Component
{
    public string $query = '';
    public array $suggestions = [];
    public bool $showSuggestions = false;

    public function updatedQuery(): void
    {
        $q = trim($this->query);

        if (strlen($q) < 2) {
            $this->suggestions = [];
            $this->showSuggestions = false;
            return;
        }

        $this->suggestions = array_slice(SiteSearch::search($q, 8), 0, 8);
        $this->showSuggestions = count($this->suggestions) > 0;
    }

    public function search(): void
    {
        $q = trim($this->query);

        if ($q === '') {
            return;
        }

        $this->redirect('/search?q=' . urlencode($q), navigate: true);
    }

    public function openResult(string $url): void
    {
        $q = trim($this->query);
        if ($q !== '') {
            $this->logSearch($q, 'search-box-suggestion', $url);
        }

        $this->redirect($url, navigate: true);
    }

    public function hideSuggestions(): void
    {
        $this->showSuggestions = false;
    }

    public function render()
    {
        return view('livewire.frontend.search-box');
    }

    private function logSearch(string $term, string $source, ?string $path = null): void
    {
        $cleanTerm = trim($term);
        if (Str::length($cleanTerm) < 2) {
            return;
        }

        $request = request();

        SearchQuery::create([
            'term' => $cleanTerm,
            'normalized_term' => Str::lower($cleanTerm),
            'path' => $path ?: '/' . ltrim($request->path(), '/'),
            'source' => $source,
            'session_id' => $request->session()->getId(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'searched_at' => now(),
            'day' => now()->toDateString(),
            'month_key' => now()->format('Y-m'),
        ]);
    }
}
