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
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="metric-card">
                    <div class="metric-label">Total Visits</div>
                    <p class="metric-value">{{ number_format($totalVisits) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="metric-card">
                    <div class="metric-label">Unique Visitors</div>
                    <p class="metric-value">{{ number_format($uniqueVisitors) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="metric-card">
                    <div class="metric-label">Unique Pages</div>
                    <p class="metric-value">{{ number_format($uniquePages) }}</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3">
                <div class="metric-card">
                    <div class="metric-label">Avg Daily Visits</div>
                    <p class="metric-value">{{ number_format($avgDailyVisits) }}</p>
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
            let chart;

            const buildChart = (labels, values) => {
                const el = document.getElementById('visitorTrendChart');
                if (!el || typeof Chart === 'undefined') return;

                const ctx = el.getContext('2d');
                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
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

            document.addEventListener('livewire:initialized', () => {
                buildChart(@json($trendLabels), @json($trendValues));

                Livewire.on('visitor-trend-updated', (event) => {
                    const payload = Array.isArray(event) ? event[0] : event;
                    buildChart(payload?.labels || [], payload?.values || []);
                });
            });
        })();
    </script>
</div>
