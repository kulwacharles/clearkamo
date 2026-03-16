<div>
    <!-- Add Blog Modal -->
    <div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog"
         aria-labelledby="addBlogModalTitle" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Publication Post</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetAll">
                        <span>&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>External Link (URL) <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" wire:model="link" placeholder="https://example.com/publication.pdf">
                            <small class="text-muted">Users will be directed to this link when they click on the publication.</small>
                            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Cover Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" class="blog-image-preview">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetAll">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Blog Modal -->
    <div class="modal fade" id="editPubModal" tabindex="-1" role="dialog"
         aria-labelledby="editBlogModalTitle" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Publication Post</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetAll">
                        <span>&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <input type="hidden" wire:model="pubId">

                        <div class="mb-3">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>External Link (URL) <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" wire:model="link" placeholder="https://example.com/publication.pdf">
                            <small class="text-muted">Users will be directed to this link when they click on the publication.</small>
                            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Cover Image</label>
                            @if($currentImage)
                                <div class="text-center mb-2">
                                    <img src="{{ asset('storage/'.$currentImage) }}" alt="Current Image" class="blog-image-preview img-fluid rounded" style="max-height: 200px;">
                                </div>
                            @else
                                <p class="text-muted">No image uploaded</p>
                            @endif
                            
                            <label>Change Image (Optional)</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            
                            @if($image)
                                <div class="mt-2">
                                    <p>New Image Preview:</p>
                                    <img src="{{ $image->temporaryUrl() }}" class="blog-image-preview">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetAll">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Update</span>
                            <span wire:loading>Updating...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Blog Modal -->
    <div class="modal fade" id="viewPubModal" tabindex="-1" role="dialog"
         aria-labelledby="viewBlogModalTitle" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Publication Post</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">Title</label>
                        <p class="form-control-plaintext border-bottom pb-2">{{ $viewTitle ?? 'No title' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Status</label>
                        <p class="form-control-plaintext border-bottom pb-2">
                            {{ $viewStatus ? ucfirst($viewStatus) : 'No status' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">External Link</label>
                        <p class="form-control-plaintext">
                            @if($viewLink)
                                <a href="{{ $viewLink }}" target="_blank" rel="noopener noreferrer">{{ $viewLink }}</a>
                            @else
                                <span class="text-muted">No link provided</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Cover Image</label>
                        <div class="text-center">
                            @if($viewImage)
                                <img src="{{ asset('storage/'.$viewImage) }}" alt="Cover Image" class="blog-image-preview img-fluid rounded">
                            @else
                                <p class="text-muted">No image uploaded</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Handle modal open/close events
            Livewire.on('open-modal', (event) => {
                $('#' + event).modal('show');
            });

            Livewire.on('close-modal', (event) => {
                $('#' + event).modal('hide');
            });

            // Listen for events from publication list
            Livewire.on('viewPub', (event) => {
                @this.viewPub(event.pubId);
            });

            Livewire.on('editPub', (event) => {
                @this.editPub(event.pubId);
            });

            Livewire.on('deletePub', (event) => {
                @this.deletePub(event.pubId);
            });

            // Refresh page on update
            Livewire.on('pub-updated', () => {
                window.location.reload();
            });
        });
    </script>
</div>