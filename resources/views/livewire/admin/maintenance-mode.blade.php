<div>
    <style>
        .maintenance-toggle {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 26px;
        }
        .maintenance-toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #ccc;
            transition: .3s;
            border-radius: 26px;
        }
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 20px; width: 20px;
            left: 3px; bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }
        input:checked + .toggle-slider { background-color: #e74c3c; }
        input:checked + .toggle-slider:before { transform: translateX(26px); }
        .toggle-slider.active-green { background-color: #2ecc71 !important; }
        .route-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 12px;
            background: #fff;
            transition: box-shadow .2s, border-color .2s;
        }
        .route-card:hover { box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .route-card.in-maintenance {
            border-left: 4px solid #e74c3c;
            background: #fff8f8;
        }
        .route-card.in-maintenance .route-name { color: #e74c3c; }
        .global-card {
            border-radius: 12px;
            border: 2px solid #e74c3c;
            background: linear-gradient(135deg, #fff5f5 0%, #fff 100%);
        }
        .global-card.inactive {
            border-color: #28a745;
            background: linear-gradient(135deg, #f5fff7 0%, #fff 100%);
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .3px;
        }
        .status-pill.down { background:#ffeaea; color:#c0392b; }
        .status-pill.up   { background:#eafaf1; color:#1e8449; }
        .stats-badge {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px 18px;
            text-align: center;
            border: 1px solid #e9ecef;
        }
        .stats-badge .num { font-size: 28px; font-weight: 700; }
        .stats-badge .lbl { font-size: 12px; color: #6c757d; }
        .message-edit-area { background: #f8f9fa; border-radius: 8px; padding: 12px; margin-top: 10px; }
        /* Toast notification */
        #maint-toast {
            position: fixed; bottom: 30px; right: 30px; z-index: 9999;
            min-width: 260px; display: none;
        }
    </style>

    <!-- Toast Notification -->
    <div id="maint-toast" class="alert" role="alert"></div>

    <div class="main_content_iner">
        <div class="container-fluid p-0">

            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="white_card p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <h3 class="mb-1 fw-bold" style="color:#2c3e50;">
                                <i class="fas fa-tools me-2" style="color:#e74c3c;"></i>Maintenance Mode
                            </h3>
                            <p class="mb-0 text-muted">Control which frontend pages are visible to visitors.</p>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button wire:click="enableAll" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Put ALL routes into maintenance mode?')">
                                <i class="fas fa-power-off me-1"></i> Enable All
                            </button>
                            <button wire:click="disableAll" class="btn btn-success btn-sm"
                                    onclick="return confirm('Restore ALL routes?')">
                                <i class="fas fa-check-circle me-1"></i> Restore All
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="row mb-4">
                @php
                    $total  = count($routes);
                    $down   = collect($routes)->where('is_active', true)->count();
                    $up     = $total - $down;
                @endphp
                <div class="col-md-4 mb-3">
                    <div class="stats-badge">
                        <div class="num text-secondary">{{ $total }}</div>
                        <div class="lbl">Total Routes</div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stats-badge">
                        <div class="num text-success">{{ $up }}</div>
                        <div class="lbl">Live Routes</div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stats-badge">
                        <div class="num text-danger">{{ $down }}</div>
                        <div class="lbl">In Maintenance</div>
                    </div>
                </div>
            </div>

            <!-- Global Maintenance Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="white_card p-4 global-card {{ $globalActive ? '' : 'inactive' }}">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <span style="font-size:32px;">🌐</span>
                                    <div>
                                        <h5 class="mb-0 fw-bold">Global Maintenance Mode</h5>
                                        <small class="text-muted">Instantly puts <strong>all</strong> frontend pages into maintenance mode</small>
                                    </div>
                                </div>
                                @if($globalActive)
                                    <div class="alert alert-danger py-2 mb-2" style="font-size:13px;">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Active!</strong> All frontend pages are currently showing the maintenance screen to visitors.
                                        Admin users can still access all pages.
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <label class="form-label small text-muted mb-1">Custom maintenance message (optional)</label>
                                    <div class="d-flex gap-2">
                                        <input type="text" wire:model.defer="globalMessage"
                                               class="form-control form-control-sm"
                                               placeholder="We are performing scheduled maintenance. Please check back soon.">
                                        <button wire:click="saveGlobalMessage" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-center gap-1">
                                <label class="maintenance-toggle" style="width:60px;height:30px;">
                                    <input type="checkbox" wire:click="toggleGlobal" {{ $globalActive ? 'checked' : '' }}>
                                    <span class="toggle-slider {{ $globalActive ? '' : 'active-green' }}" style="border-radius:30px;"></span>
                                </label>
                                <small class="fw-bold {{ $globalActive ? 'text-danger' : 'text-success' }}">
                                    {{ $globalActive ? 'ON' : 'OFF' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Per-Route Cards -->
            <div class="row">
                <div class="col-12">
                    <div class="white_card p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-route me-2 text-primary"></i>Per-Page Maintenance Control
                            </h5>
                            <span class="badge bg-secondary">{{ $total }} routes</span>
                        </div>

                        @if(count($routes) === 0)
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-database fa-2x mb-2"></i>
                                <p>No routes found. Run <code>php artisan db:seed --class=MaintenanceRoutesSeeder</code> to populate routes.</p>
                            </div>
                        @else
                            @foreach($routes as $route)
                                <div class="route-card {{ $route['is_active'] ? 'in-maintenance' : '' }}">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-3 flex-grow-1">
                                            <div>
                                                <span class="route-name fw-semibold">{{ $route['name'] }}</span>
                                                <br>
                                                <code class="small text-muted">{{ $route['path'] }}</code>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($route['is_active'])
                                                <span class="status-pill down">
                                                    <i class="fas fa-wrench me-1"></i> Maintenance
                                                </span>
                                            @else
                                                <span class="status-pill up">
                                                    <i class="fas fa-check me-1"></i> Live
                                                </span>
                                            @endif
                                            <button wire:click="startEdit({{ $route['id'] }})"
                                                    class="btn btn-outline-secondary btn-sm" title="Set custom message">
                                                <i class="fas fa-comment-dots"></i>
                                            </button>
                                            <label class="maintenance-toggle mb-0">
                                                <input type="checkbox"
                                                       wire:click="toggleRoute({{ $route['id'] }})"
                                                       {{ $route['is_active'] ? 'checked' : '' }}>
                                                <span class="toggle-slider"></span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Inline message editor --}}
                                    @if($editingId === $route['id'])
                                        <div class="message-edit-area mt-2">
                                            <label class="form-label small mb-1">
                                                <i class="fas fa-pen me-1"></i>Custom message for this page:
                                            </label>
                                            <textarea wire:model.defer="editingMessage"
                                                      class="form-control form-control-sm"
                                                      rows="2"
                                                      placeholder="This page is under maintenance. We'll be back shortly!"></textarea>
                                            <div class="mt-2 d-flex gap-2">
                                                <button wire:click="saveMessage" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-save me-1"></i>Save
                                                </button>
                                                <button wire:click="cancelEdit" class="btn btn-outline-secondary btn-sm">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    @elseif(!empty($route['message']))
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-quote-left me-1"></i>{{ $route['message'] }}
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('notify', (event) => {
                const toast = document.getElementById('maint-toast');
                toast.className = 'alert alert-' + (event.type === 'warning' ? 'warning' : (event.type === 'success' ? 'success' : 'info'));
                toast.textContent = event.message;
                toast.style.display = 'block';
                setTimeout(() => { toast.style.display = 'none'; }, 3500);
            });
        });
    </script>
</div>
