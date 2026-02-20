<div class="col-12">
    <style>
        .visitor-dashboard .metric-card {
            border: 1px solid var(--admin-border);
            border-radius: 14px;
            background: var(--admin-surface);
            padding: 18px;
            box-shadow: var(--admin-shadow);
            height: 100%;
        }
        .visitor-dashboard .metric-soft-blue { background: rgba(59, 130, 246, .08); border-color: rgba(59, 130, 246, .28); }
        .visitor-dashboard .metric-soft-emerald { background: rgba(16, 185, 129, .08); border-color: rgba(16, 185, 129, .28); }
        .visitor-dashboard .metric-soft-violet { background: rgba(139, 92, 246, .08); border-color: rgba(139, 92, 246, .28); }
        .visitor-dashboard .metric-soft-amber { background: rgba(245, 158, 11, .10); border-color: rgba(245, 158, 11, .30); }
        .visitor-dashboard .metric-soft-cyan { background: rgba(6, 182, 212, .08); border-color: rgba(6, 182, 212, .28); }
        .visitor-dashboard .metric-soft-rose { background: rgba(244, 63, 94, .08); border-color: rgba(244, 63, 94, .28); }
        .visitor-dashboard .metric-soft-indigo { background: rgba(99, 102, 241, .08); border-color: rgba(99, 102, 241, .28); }
        .visitor-dashboard .metric-soft-slate { background: rgba(71, 85, 105, .10); border-color: rgba(71, 85, 105, .30); }
        .visitor-dashboard .metric-label {
            font-size: 12px;
            color: var(--admin-muted);
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 6px;
        }
        .visitor-dashboard .metric-value {
            font-size: 30px;
            font-weight: 700;
            color: var(--admin-text);
            line-height: 1.1;
            margin: 0;
        }
        .visitor-dashboard .panel {
            border: 1px solid var(--admin-border);
            border-radius: 14px;
            background: var(--admin-surface);
            box-shadow: var(--admin-shadow);
            padding: 18px;
        }
        .visitor-dashboard .panel-title {
            color: var(--admin-text);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 14px;
        }
        .visitor-dashboard .table th,
        .visitor-dashboard .table td {
            color: var(--admin-text);
            border-color: var(--admin-border);
            background: transparent;
        }
        .visitor-dashboard .filters .btn {
            border-radius: 10px;
        }
    </style>

    <div class="visitor-dashboard">
        <div class="row mb_30 filters">
            <div class="col-12">
                <div class="panel">
                    <form wire:submit.prevent="applyFilters" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">From</label>
                            <input type="date" class="form-control" wire:model.defer="dateFrom">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">To</label>
                            <input type="date" class="form-control" wire:model.defer="dateTo">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Trend Group</label>
                            <select class="form-control" wire:model.defer="groupBy">
                                <option value="day">Day</option>
                                <option value="month">Month</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100" type="submit">Apply</button>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button class="btn btn-outline-secondary w-100" type="button" wire:click="setPreset('7d')">7D</button>
                            <button class="btn btn-outline-secondary w-100" type="button" wire:click="setPreset('30d')">30D</button>
                            <button class="btn btn-outline-secondary w-100" type="button" wire:click="setPreset('3m')">3M</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb_30">
            <div class="col-md-6 col-xl-2 mb-3">
                <div class="metric-card metric-soft-blue">
                    <div class="metric-label">Total Visits</div>
                    <p class="metric-value">{{ number_format($totalVisits) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-2 mb-3">
                <div class="metric-card metric-soft-emerald">
                    <div class="metric-label">Unique Visitors</div>
                    <p class="metric-value">{{ number_format($uniqueVisitors) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-2 mb-3">
                <div class="metric-card metric-soft-violet">
                    <div class="metric-label">Unique Pages</div>
                    <p class="metric-value">{{ number_format($uniquePages) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-2 mb-3">
                <div class="metric-card metric-soft-amber">
                    <div class="metric-label">Avg Daily Visits</div>
                    <p class="metric-value">{{ number_format($avgDailyVisits) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-2 mb-3">
                <div class="metric-card metric-soft-cyan">
                    <div class="metric-label">New Visitors</div>
                    <p class="metric-value">{{ number_format($newVisitors) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-2 mb-3">
                <div class="metric-card metric-soft-rose">
                    <div class="metric-label">Returning</div>
                    <p class="metric-value">{{ number_format($returningVisitors) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="metric-card metric-soft-indigo">
                    <div class="metric-label">Total Searches</div>
                    <p class="metric-value">{{ number_format($totalSearches) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="metric-card metric-soft-slate">
                    <div class="metric-label">Unique Search Terms</div>
                    <p class="metric-value">{{ number_format($uniqueSearchTerms) }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Visitor Trend</h4>
                    <div style="height: 340px;">
                        <canvas id="visitorTrendChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Device Split</h4>
                    <div style="height: 340px;">
                        <canvas id="visitorDeviceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Hourly Traffic</h4>
                    <div style="height: 320px;">
                        <canvas id="visitorHourlyChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Top Referrers</h4>
                    <div style="height: 320px;">
                        <canvas id="visitorReferrerChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Search Trend</h4>
                    <div style="height: 300px;">
                        <canvas id="searchTrendChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Top Search Terms</h4>
                    <div style="height: 300px;">
                        <canvas id="topSearchTermsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Recent Searches</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Term</th>
                                    <th>Path</th>
                                    <th>Source</th>
                                    <th>IP</th>
                                    <th class="text-end">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSearches as $search)
                                    <tr>
                                        <td>{{ $search['term'] }}</td>
                                        <td>{{ $search['path'] ?: '-' }}</td>
                                        <td>{{ $search['source'] }}</td>
                                        <td>{{ $search['ip_address'] ?: '-' }}</td>
                                        <td class="text-end">{{ $search['searched_at'] ?: '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No search data in selected range.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb_30">
                <div class="panel">
                    <h4 class="panel-title">Top Pages</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th class="text-end">Visits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topPages as $page)
                                    <tr>
                                        <td>{{ $page['path'] }}</td>
                                        <td class="text-end">{{ number_format($page['total']) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No visitor data in selected range.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            let trendChart;
            let hourlyChart;
            let deviceChart;
            let referrerChart;
            let searchTrendChart;
            let topSearchTermsChart;

            const buildTrendChart = (labels, values) => {
                const el = document.getElementById('visitorTrendChart');
                if (!el || typeof Chart === 'undefined') return;

                const ctx = el.getContext('2d');
                if (trendChart) {
                    trendChart.destroy();
                }

                trendChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels || [],
                        datasets: [{
                            label: 'Visits',
                            data: values || [],
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59,130,246,0.2)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.32,
                            pointRadius: 3,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                        },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                        },
                    },
                });
            };

            const buildHourlyChart = (labels, values) => {
                const el = document.getElementById('visitorHourlyChart');
                if (!el || typeof Chart === 'undefined') return;

                const ctx = el.getContext('2d');
                if (hourlyChart) hourlyChart.destroy();

                hourlyChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels || [],
                        datasets: [{
                            label: 'Visits',
                            data: values || [],
                            backgroundColor: 'rgba(96,165,250,0.7)',
                            borderColor: '#60a5fa',
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                        },
                    },
                });
            };

            const buildDeviceChart = (labels, values) => {
                const el = document.getElementById('visitorDeviceChart');
                if (!el || typeof Chart === 'undefined') return;

                const ctx = el.getContext('2d');
                if (deviceChart) deviceChart.destroy();

                deviceChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels || [],
                        datasets: [{
                            data: values || [],
                            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } },
                    },
                });
            };

            const buildReferrerChart = (labels, values) => {
                const el = document.getElementById('visitorReferrerChart');
                if (!el || typeof Chart === 'undefined') return;

                const ctx = el.getContext('2d');
                if (referrerChart) referrerChart.destroy();

                referrerChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels || [],
                        datasets: [{
                            label: 'Visits',
                            data: values || [],
                            backgroundColor: 'rgba(59,130,246,0.7)',
                            borderColor: '#3b82f6',
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { beginAtZero: true, ticks: { precision: 0 } },
                        },
                    },
                });
            };

            const buildSearchTrendChart = (labels, values) => {
                const el = document.getElementById('searchTrendChart');
                if (!el || typeof Chart === 'undefined') return;

                const ctx = el.getContext('2d');
                if (searchTrendChart) searchTrendChart.destroy();

                searchTrendChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels || [],
                        datasets: [{
                            label: 'Searches',
                            data: values || [],
                            borderColor: '#1d4ed8',
                            backgroundColor: 'rgba(29, 78, 216, 0.18)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.32,
                            pointRadius: 3,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                        },
                    },
                });
            };

            const buildTopSearchTermsChart = (labels, values) => {
                const el = document.getElementById('topSearchTermsChart');
                if (!el || typeof Chart === 'undefined') return;

                const ctx = el.getContext('2d');
                if (topSearchTermsChart) topSearchTermsChart.destroy();

                topSearchTermsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels || [],
                        datasets: [{
                            label: 'Searches',
                            data: values || [],
                            backgroundColor: 'rgba(37,99,235,0.75)',
                            borderColor: '#1d4ed8',
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { beginAtZero: true, ticks: { precision: 0 } },
                        },
                    },
                });
            };

            document.addEventListener('livewire:initialized', () => {
                buildTrendChart(@json($trendLabels), @json($trendValues));
                buildHourlyChart(@json($hourlyLabels), @json($hourlyValues));
                buildDeviceChart(@json($deviceLabels), @json($deviceValues));
                buildReferrerChart(@json($referrerLabels), @json($referrerValues));
                buildSearchTrendChart(@json($searchTrendLabels), @json($searchTrendValues));
                buildTopSearchTermsChart(@json(collect($topSearchTerms)->pluck('term')->toArray()), @json(collect($topSearchTerms)->pluck('total')->map(fn ($v) => (int) $v)->toArray()));

                Livewire.on('visitor-analytics-updated', (event) => {
                    const payload = Array.isArray(event) ? event[0] : event;
                    buildTrendChart(payload?.trendLabels || [], payload?.trendValues || []);
                    buildHourlyChart(payload?.hourlyLabels || [], payload?.hourlyValues || []);
                    buildDeviceChart(payload?.deviceLabels || [], payload?.deviceValues || []);
                    buildReferrerChart(payload?.referrerLabels || [], payload?.referrerValues || []);
                    buildSearchTrendChart(payload?.searchTrendLabels || [], payload?.searchTrendValues || []);
                    buildTopSearchTermsChart(payload?.topSearchLabels || [], payload?.topSearchValues || []);
                });
            });
        })();
    </script>
</div>
