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

            <span class="admin-auth-kicker">Password Help</span>
            <h1>Reset your admin password securely.</h1>
            <p>
                Enter the email address linked to your admin account and we will send you a secure reset link.
            </p>

            <ul class="admin-auth-points">
                <li><i class="ti-email"></i><span>The reset link is sent to the account email address.</span></li>
                <li><i class="ti-timer"></i><span>Reset links expire automatically for better security.</span></li>
                <li><i class="ti-check-box"></i><span>Once changed, the new password works immediately in admin.</span></li>
            </ul>
        </aside>

        <main class="admin-auth-main">
            <div class="admin-auth-card">
                <h2 class="admin-auth-title">Forgot password</h2>
                <p class="admin-auth-subtitle">
                    We’ll email you a password reset link for your admin account.
                </p>

                @if($statusMessage)
                    <div class="admin-auth-alert success">{{ $statusMessage }}</div>
                @endif

                <form wire:submit.prevent="submit">
                    <div class="mb-4">
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

                    <button type="submit" class="btn admin-auth-btn">
                        <span wire:loading.remove wire:target="submit">Send reset link</span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Sending...
                        </span>
                    </button>
                </form>

                <div class="admin-auth-links">
                    <a href="{{ route('login') }}" class="admin-auth-link">Back to sign in</a>
                    <a href="{{ url('/') }}" class="admin-auth-link">Back to website</a>
                </div>
            </div>
        </main>
    </div>
</div>
