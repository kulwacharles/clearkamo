<div>
    <!-- Add Gallery Photo Modal -->
    <div class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Gallery Photo</h5>
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
                                <label class="form-label">Project <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="project_id">
                                    <option value="">— Select Project —</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj->id }}">{{ $proj->project_name }}</option>
                                    @endforeach
                                </select>
                                @error('project_id') <span class="text-danger small">{{ $message }}</span> @enderror
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
                            <label class="form-label">Caption <span class="text-muted">(optional)</span></label>
                            <input type="text" class="form-control" wire:model="caption" placeholder="Short description of this photo">
                            @error('caption') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order" min="0" placeholder="0">
                                @error('sort_order') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" wire:model="image" accept="image/*">
                            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" style="max-height:180px;border-radius:8px;" alt="preview">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetAll">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save</span>
                            <span wire:loading>Uploading…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Gallery Photo Modal -->
    <div class="modal fade" id="editGalleryModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Gallery Photo</h5>
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
                                <label class="form-label">Project <span class="text-danger">*</span></label>
                                <select class="form-control" wire:model="project_id">
                                    <option value="">— Select Project —</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj->id }}">{{ $proj->project_name }}</option>
                                    @endforeach
                                </select>
                                @error('project_id') <span class="text-danger small">{{ $message }}</span> @enderror
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
                            <label class="form-label">Caption <span class="text-muted">(optional)</span></label>
                            <input type="text" class="form-control" wire:model="caption">
                            @error('caption') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-3">
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
                                    <img src="{{ asset('storage/'.$currentImage) }}" style="max-height:140px;border-radius:8px;" alt="current">
                                    <small class="d-block text-muted mt-1">Current photo</small>
                                </div>
                            @endif
                            <input type="file" class="form-control" wire:model="image" accept="image/*">
                            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" style="max-height:180px;border-radius:8px;" alt="new preview">
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
            Livewire.on('open-modal', (event) => {
                $('#' + event).modal('show');
            });

            Livewire.on('close-modal', (event) => {
                $('#' + event).modal('hide');
            });
        });
    </script>
</div>
