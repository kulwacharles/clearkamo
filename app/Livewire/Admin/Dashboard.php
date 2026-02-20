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
    public int $newVisitors = 0;
    public int $returningVisitors = 0;

    public array $trendLabels = [];
    public array $trendValues = [];
    public array $topPages = [];
    public array $hourlyLabels = [];
    public array $hourlyValues = [];
    public array $deviceLabels = [];
    public array $deviceValues = [];
    public array $referrerLabels = [];
    public array $referrerValues = [];

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

        $visits = (clone $query)
            ->select('session_id', 'ip_address', 'visited_at', 'referrer', 'user_agent')
            ->get();

        $visitorCounts = [];
        $hourCounts = array_fill(0, 24, 0);
        $weekdayCounts = ['Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0];
        $referrerCounts = [];
        $deviceCounts = ['Desktop' => 0, 'Mobile' => 0, 'Tablet' => 0, 'Bot' => 0];

        foreach ($visits as $visit) {
            $visitorKey = trim((string) $visit->session_id) !== '' ? $visit->session_id : ($visit->ip_address ?? null);
            if ($visitorKey) {
                $visitorCounts[$visitorKey] = ($visitorCounts[$visitorKey] ?? 0) + 1;
            }

            $time = Carbon::parse($visit->visited_at);
            $hourCounts[(int) $time->format('G')]++;

            $weekdayMap = [1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun'];
            $weekdayCounts[$weekdayMap[(int) $time->format('N')]]++;

            $device = $this->detectDeviceType($visit->user_agent ?? '');
            $deviceCounts[$device]++;

            if (!empty($visit->referrer)) {
                $host = parse_url((string) $visit->referrer, PHP_URL_HOST);
                if ($host) {
                    $host = preg_replace('/^www\./i', '', $host);
                    $referrerCounts[$host] = ($referrerCounts[$host] ?? 0) + 1;
                }
            }
        }

        $this->returningVisitors = collect($visitorCounts)->filter(fn ($count) => $count > 1)->count();
        $this->newVisitors = max(0, $this->uniqueVisitors - $this->returningVisitors);

        $this->hourlyLabels = collect(range(0, 23))->map(fn ($h) => str_pad((string) $h, 2, '0', STR_PAD_LEFT) . ':00')->toArray();
        $this->hourlyValues = array_values($hourCounts);

        $this->deviceLabels = array_keys($deviceCounts);
        $this->deviceValues = array_values($deviceCounts);

        arsort($referrerCounts);
        $topReferrers = array_slice($referrerCounts, 0, 6, true);
        $this->referrerLabels = array_keys($topReferrers);
        $this->referrerValues = array_values($topReferrers);

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

        $this->dispatch(
            'visitor-analytics-updated',
            trendLabels: $this->trendLabels,
            trendValues: $this->trendValues,
            hourlyLabels: $this->hourlyLabels,
            hourlyValues: $this->hourlyValues,
            deviceLabels: $this->deviceLabels,
            deviceValues: $this->deviceValues,
            referrerLabels: $this->referrerLabels,
            referrerValues: $this->referrerValues
        );
    }

    private function detectDeviceType(string $userAgent): string
    {
        $ua = strtolower($userAgent);
        if ($ua === '') {
            return 'Desktop';
        }

        if (str_contains($ua, 'bot') || str_contains($ua, 'crawler') || str_contains($ua, 'spider')) {
            return 'Bot';
        }

        if (str_contains($ua, 'ipad') || str_contains($ua, 'tablet')) {
            return 'Tablet';
        }

        if (str_contains($ua, 'mobile') || str_contains($ua, 'android') || str_contains($ua, 'iphone')) {
            return 'Mobile';
        }

        return 'Desktop';
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('components.layouts.app');
    }
}
