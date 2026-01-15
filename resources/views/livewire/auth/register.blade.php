<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Register</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="register">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input 
                                type="text" 
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                wire:model="name"
                                placeholder="Enter your full name"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                class="form-control"
                                wire:model="password_confirmation"
                                placeholder="Confirm your password"
                            >
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <span wire:loading.remove>Register</span>
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                    Registering...
                                </span>
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Already have an account? Login here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>