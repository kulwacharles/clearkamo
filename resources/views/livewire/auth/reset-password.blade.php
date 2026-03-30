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

            <span class="admin-auth-kicker">Reset Access</span>
            <h1>Create a new password for admin.</h1>
            <p>
                Choose a strong password that you have not used before so your admin account stays protected.
            </p>

            <ul class="admin-auth-points">
                <li><i class="ti-key"></i><span>Use at least 8 characters.</span></li>
                <li><i class="ti-lock"></i><span>Avoid reusing your current or old password.</span></li>
                <li><i class="ti-check"></i><span>Once saved, you can sign in immediately with the new password.</span></li>
            </ul>
        </aside>

        <main class="admin-auth-main">
            <div class="admin-auth-card">
                <h2 class="admin-auth-title">Reset password</h2>
                <p class="admin-auth-subtitle">
                    Enter your email and choose your new password to complete the reset.
                </p>

                <form wire:submit.prevent="submit">
                    <div class="mb-3">
                        <label for="email" class="admin-auth-label">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            class="form-control admin-auth-control @error('email') is-invalid @enderror"
                            wire:model="email"
                            autocomplete="email"
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="admin-auth-label">New Password</label>
                        <input
                            type="password"
                            id="password"
                            class="form-control admin-auth-control @error('password') is-invalid @enderror"
                            wire:model="password"
                            autocomplete="new-password"
                        >
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="admin-auth-label">Confirm Password</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            class="form-control admin-auth-control"
                            wire:model="password_confirmation"
                            autocomplete="new-password"
                        >
                    </div>

                    <button type="submit" class="btn admin-auth-btn">
                        <span wire:loading.remove wire:target="submit">Save new password</span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Updating...
                        </span>
                    </button>
                </form>

                <div class="admin-auth-links">
                    <a href="{{ route('login') }}" class="admin-auth-link">Back to sign in</a>
                </div>
            </div>
        </main>
    </div>
</div>
