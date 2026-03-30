<div class="admin-auth-shell">
    @php
        $authLogo = \App\Models\About::query()->value('logo');
        $authLogoUrl = $authLogo ? url('/storage/' . $authLogo) : asset('img/mini_logo.png');
    @endphp
    <div class="admin-auth-panel">
        <aside class="admin-auth-aside">
            <div class="admin-auth-brand">
                <img src="{{ $authLogoUrl }}" alt="ClearKamo">
            </div>

            <span class="admin-auth-kicker">Admin Access</span>
            <h1>Sign in to manage the platform.</h1>
            <p>
                Access the admin workspace, monitor site activity, publish updates, and respond faster with a cleaner security flow.
            </p>

            <ul class="admin-auth-points">
                <li><i class="ti-shield"></i><span>Protected admin access with password reset support.</span></li>
                <li><i class="ti-bolt"></i><span>Direct access to dashboards, content tools, and live support operations.</span></li>
                <li><i class="ti-lock"></i><span>Built for everyday admin work on mobile, tablet, and desktop.</span></li>
            </ul>
        </aside>

        <main class="admin-auth-main">
            <div class="admin-auth-card">
                <h2 class="admin-auth-title">Welcome back</h2>
                <p class="admin-auth-subtitle">
                    Use your admin email and password to continue into the control panel.
                </p>

                @if (session('status'))
                    <div class="admin-auth-alert success">{{ session('status') }}</div>
                @endif

                <form wire:submit.prevent="login">
                    <div class="mb-3">
                        <label for="email" class="admin-auth-label">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            class="form-control admin-auth-control @error('email') is-invalid @enderror"
                            wire:model="email"
                            placeholder="name@clearkamo.com"
                            autocomplete="email"
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="admin-auth-label">Password</label>
                        <input
                            type="password"
                            id="password"
                            class="form-control admin-auth-control @error('password') is-invalid @enderror"
                            wire:model="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                        >
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <div class="form-check m-0">
                            <input
                                type="checkbox"
                                id="remember"
                                class="form-check-input"
                                wire:model="remember"
                            >
                            <label class="form-check-label text-muted" for="remember">Keep me signed in</label>
                        </div>

                        <a href="{{ route('password.request') }}" class="admin-auth-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn admin-auth-btn">
                        <span wire:loading.remove wire:target="login">Sign In</span>
                        <span wire:loading wire:target="login">
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Signing in...
                        </span>
                    </button>
                </form>

                <div class="admin-auth-links">
                    <a href="{{ url('/') }}" class="admin-auth-link">Back to website</a>
                    <span class="text-muted">Need access help? Contact the system owner.</span>
                </div>
            </div>
        </main>
    </div>
</div>
