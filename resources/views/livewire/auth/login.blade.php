<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Login</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input 
                                type="email" 
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                wire:model="email"
                                placeholder="Enter your email"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input 
                                type="password" 
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                wire:model="password"
                                placeholder="Enter your password"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input 
                                type="checkbox" 
                                id="remember"
                                class="form-check-input"
                                wire:model="remember"
                            >
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Login</span>
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                    Logging in...
                                </span>
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                Don't have an account? Register here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>