<div class="col-12">
    <style>
        .password-settings-card {
            border: 1px solid var(--admin-border);
            background: var(--admin-surface);
            border-radius: 22px;
            box-shadow: var(--admin-shadow);
            overflow: hidden;
        }

        .password-settings-grid {
            display: grid;
            grid-template-columns: minmax(280px, 380px) minmax(0, 1fr);
            gap: 0;
        }

        .password-settings-aside {
            padding: 30px 26px;
            background: linear-gradient(155deg, rgba(3, 164, 252, 0.96) 0%, rgba(11, 125, 214, 0.92) 100%);
            color: #fff;
        }

        .password-settings-aside h3 {
            margin: 0 0 12px;
            font-size: 28px;
            font-weight: 800;
            color: #fff;
        }

        .password-settings-aside p {
            margin: 0;
            line-height: 1.8;
            opacity: .94;
        }

        .password-settings-points {
            margin: 22px 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .password-settings-points li {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 12px 14px;
            background: rgba(255,255,255,.12);
            border-radius: 16px;
        }

        .password-settings-main {
            padding: 30px 30px 26px;
        }

        .password-settings-main h4 {
            margin: 0 0 8px;
            font-size: 28px;
            font-weight: 800;
            color: var(--admin-text);
        }

        .password-settings-main p {
            margin: 0 0 22px;
            color: var(--admin-muted);
            line-height: 1.75;
        }

        .password-settings-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: var(--admin-text);
            font-size: 13px;
        }

        .password-settings-input {
            height: 52px !important;
            border-radius: 16px !important;
            border: 1px solid var(--admin-border) !important;
            background: var(--admin-surface-soft) !important;
            color: var(--admin-text) !important;
            padding: 0 16px !important;
        }

        .password-settings-input:focus {
            border-color: #03a4fc !important;
            box-shadow: 0 0 0 4px rgba(3,164,252,.14) !important;
        }

        .password-settings-btn {
            min-height: 52px;
            border: 0;
            border-radius: 16px;
            padding: 0 22px;
            color: #fff;
            font-weight: 700;
            background: linear-gradient(135deg, #03a4fc 0%, #0b7dd6 100%);
            box-shadow: 0 18px 36px rgba(3,164,252,.22);
        }

        .password-settings-alert {
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .password-settings-alert.success {
            background: #effdf5;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        @media (max-width: 991.98px) {
            .password-settings-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="password-settings-card">
        <div class="password-settings-grid">
            <div class="password-settings-aside">
                <h3>Protect Admin Access</h3>
                <p>
                    Keep the control panel secure by rotating your password when needed and using a stronger one than before.
                </p>

                <ul class="password-settings-points">
                    <li><i class="ti-shield"></i><span>Use a password with at least 8 characters.</span></li>
                    <li><i class="ti-lock"></i><span>Do not reuse your current password.</span></li>
                    <li><i class="ti-check-box"></i><span>The change applies immediately after saving.</span></li>
                </ul>
            </div>

            <div class="password-settings-main">
                <h4>Change Password</h4>
                <p>Update your current admin password from inside the panel.</p>

                @if (session('status'))
                    <div class="password-settings-alert success">{{ session('status') }}</div>
                @endif

                <form wire:submit.prevent="updatePassword">
                    <div class="mb-3">
                        <label class="password-settings-label" for="current_password">Current Password</label>
                        <input
                            type="password"
                            id="current_password"
                            wire:model="current_password"
                            class="form-control password-settings-input @error('current_password') is-invalid @enderror"
                            autocomplete="current-password"
                        >
                        @error('current_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="password-settings-label" for="password">New Password</label>
                        <input
                            type="password"
                            id="password"
                            wire:model="password"
                            class="form-control password-settings-input @error('password') is-invalid @enderror"
                            autocomplete="new-password"
                        >
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="password-settings-label" for="password_confirmation">Confirm New Password</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            wire:model="password_confirmation"
                            class="form-control password-settings-input"
                            autocomplete="new-password"
                        >
                    </div>

                    <button type="submit" class="password-settings-btn">
                        <span wire:loading.remove wire:target="updatePassword">Update Password</span>
                        <span wire:loading wire:target="updatePassword">
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Updating...
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
