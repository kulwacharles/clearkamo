<div>
    <!-- Add Focus Area Modal -->
    <div class="modal fade" id="addFocusModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Focus Area</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetAll">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="title" placeholder="e.g. Execution Performance">
                                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="status">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                                @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Summary <span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="summary" rows="2" placeholder="Short one-liner shown on the card (max 500 chars)"></textarea>
                            @error('summary') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Details <span class="text-muted">(optional)</span></label>
                            <textarea class="form-control" wire:model="details" rows="3" placeholder="Additional details about this focus area."></textarea>
                            @error('details') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Font Awesome Icon <span class="text-muted">(e.g. fa-tasks)</span></label>
                                <input type="text" class="form-control" wire:model="icon" placeholder="fa-tasks">
                                @error('icon') <span class="text-danger small">{{ $message }}</span> @enderror
                                <small class="text-muted">Used as fallback when no image is uploaded. See <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com</a>.</small>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order" min="0" placeholder="0">
                                @error('sort_order') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo <span class="text-muted">(optional, replaces icon on card)</span></label>
                            <input type="file" class="form-control" wire:model="image" accept="image/*">
                            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" style="max-height:150px;border-radius:8px;" alt="preview">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetAll">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save</span>
                            <span wire:loading>Saving…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Focus Area Modal -->
    <div class="modal fade" id="editFocusModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Focus Area</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetAll">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="status">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                                @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Summary <span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="summary" rows="2"></textarea>
                            @error('summary') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Details <span class="text-muted">(optional)</span></label>
                            <textarea class="form-control" wire:model="details" rows="3"></textarea>
                            @error('details') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Font Awesome Icon <span class="text-muted">(e.g. fa-tasks)</span></label>
                                <input type="text" class="form-control" wire:model="icon" placeholder="fa-tasks">
                                @error('icon') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order" min="0">
                                @error('sort_order') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo <span class="text-muted">(leave blank to keep current)</span></label>
                            @if($currentImage)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$currentImage) }}" style="max-height:120px;border-radius:8px;" alt="current">
                                    <small class="d-block text-muted mt-1">Current photo</small>
                                </div>
                            @endif
                            <input type="file" class="form-control" wire:model="image" accept="image/*">
                            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" style="max-height:150px;border-radius:8px;" alt="new preview">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetAll">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Update</span>
                            <span wire:loading>Updating…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('editItem', (event) => {
                @this.editItem(event.id);
            });

            Livewire.on('deleteItem', (event) => {
                @this.deleteItem(event.id);
            });

            Livewire.on('open-modal', (event) => {
                const el = document.getElementById(event);
                if (el) bootstrap.Modal.getOrCreateInstance(el).show();
            });

            Livewire.on('close-modal', (event) => {
                const el = document.getElementById(event);
                if (el) {
                    const m = bootstrap.Modal.getInstance(el);
                    if (m) m.hide();
                }
            });
        });
    </script>
</div>
