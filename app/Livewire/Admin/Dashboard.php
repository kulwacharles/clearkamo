<?php

namespace App\Livewire\Admin;

use App\Models\WebsiteVisit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public string $dateFrom;
    public string $dateTo;
    public string $groupBy = 'day';

    public int $totalVisits = 0;
    public int $uniqueVisitors = 0;
    public int $uniquePages = 0;
    public int $avgDailyVisits = 0;

    public array $trendLabels = [];
    public array $trendValues = [];
    public array $topPages = [];

    public function mount(): void
    {
        $this->dateFrom = now()->subDays(29)->toDateString();
        $this->dateTo = now()->toDateString();
        $this->loadAnalytics();
    }

    public function applyFilters(): void
    {
        $this->validate([
            'dateFrom' => ['required', 'date'],
            'dateTo' => ['required', 'date', 'after_or_equal:dateFrom'],
            'groupBy' => ['required', 'in:day,month'],
        ]);

        $this->loadAnalytics();
    }

    public function setPreset(string $preset): void
    {
        if ($preset === '7d') {
            $this->dateFrom = now()->subDays(6)->toDateString();
            $this->dateTo = now()->toDateString();
            $this->groupBy = 'day';
        } elseif ($preset === '30d') {
            $this->dateFrom = now()->subDays(29)->toDateString();
            $this->dateTo = now()->toDateString();
            $this->groupBy = 'day';
        } elseif ($preset === '3m') {
            $this->dateFrom = now()->subMonths(2)->startOfMonth()->toDateString();
            $this->dateTo = now()->toDateString();
            $this->groupBy = 'month';
        } else {
            $this->dateFrom = now()->startOfMonth()->toDateString();
            $this->dateTo = now()->toDateString();
            $this->groupBy = 'day';
        }

        $this->loadAnalytics();
    }

    private function loadAnalytics(): void
    {
        $query = WebsiteVisit::query()->whereBetween('day', [$this->dateFrom, $this->dateTo]);

        $this->totalVisits = (clone $query)->count();

        $this->uniqueVisitors = (int) ((clone $query)
            ->selectRaw("COUNT(DISTINCT COALESCE(NULLIF(session_id, ''), ip_address)) as aggregate")
            ->value('aggregate') ?? 0);

        $this->uniquePages = (clone $query)->distinct('path')->count('path');

        $days = max(1, Carbon::parse($this->dateFrom)->diffInDays(Carbon::parse($this->dateTo)) + 1);
        $this->avgDailyVisits = (int) round($this->totalVisits / $days);

        $this->topPages = (clone $query)
            ->select('path', DB::raw('COUNT(*) as total'))
            ->groupBy('path')
            ->orderByDesc('total')
            ->limit(8)
            ->get()
            ->toArray();

        if ($this->groupBy === 'month') {
            $trendRows = (clone $query)
                ->select('month_key', DB::raw('COUNT(*) as total'))
                ->groupBy('month_key')
                ->orderBy('month_key')
                ->get();

            $this->trendLabels = $trendRows->pluck('month_key')->toArray();
            $this->trendValues = $trendRows->pluck('total')->map(fn ($v) => (int) $v)->toArray();
        } else {
            $trendRows = (clone $query)
                ->select('day', DB::raw('COUNT(*) as total'))
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $this->trendLabels = $trendRows
                ->pluck('day')
                ->map(fn ($d) => Carbon::parse($d)->format('d M'))
                ->toArray();

            $this->trendValues = $trendRows->pluck('total')->map(fn ($v) => (int) $v)->toArray();
        }

        $this->dispatch('visitor-trend-updated', labels: $this->trendLabels, values: $this->trendValues);
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('components.layouts.app');
    }
}
