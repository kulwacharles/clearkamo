<div>
    <!-- Add Blog Modal -->
    <div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog"
         aria-labelledby="addBlogModalTitle" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Client Details</h5>
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

                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="col-md-6">
                                <label>Status</label>
                                <select class="form-control" wire:model="status" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label>URL</label>
                                <input type="text" class="form-control" wire:model="url">
                                @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Image</label>
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
                    <h5 class="modal-title">Edit Client Details</h5>
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

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="col-md-6">
                                <label>Status</label>
                                <select class="form-control" wire:model="status" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-10">
                                <label>URL</label>
                                <input type="text" class="form-control" wire:model="url">
                                @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
 
                        </div>

                        <div class="mb-3">
                            <label>Current Image</label>
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
                    <h5 class="modal-title">View Client Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <label class="fw-bold">Name</label>
                            <p class="form-control-plaintext border-bottom pb-2">{{ $viewName ?? 'No ' }}</p>
                        </div>
                        <div class="col-md-10">
                            <label class="fw-bold">url</label>
                            <p class="form-control-plaintext border-bottom pb-2">{{ $viewUrl ?? 'No Url' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Status</label>
                            <p class="form-control-plaintext border-bottom pb-2">
                                @if($viewStatus)
                                    {{ ucfirst($viewStatus) }}
                                @else
                                    No status
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Publish Date</label>
                            <p class="form-control-plaintext border-bottom pb-2">
                                @if($viewPublishedDate)
                                    {{ $viewPublishedDate }}
                                @else
                                    No publish date
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Image</label>
                        <div class="text-center">
                            @if($viewImage)
                                <img src="{{ asset('storage/'.$viewImage) }}" alt="Blog Image" class="blog-image-preview img-fluid rounded">
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
        // Global variables to store CKEditor instances
        let createEditor = null;
        let editEditor = null;

        document.addEventListener('livewire:initialized', () => {
            // Initialize CKEditor for create modal
            //initializeCreateEditor();

            // Handle modal events for edit modal
            const editModal = document.getElementById('editPubModal');
            // if (editModal) {
            //     editModal.addEventListener('shown.bs.modal', function () {
            //         // Small delay to ensure modal is fully rendered
            //         setTimeout(() => {
            //             initializeEditEditor();
            //         }, 100);
            //     });


            // }

            // Handle modal open/close events
            Livewire.on('open-modal', (event) => {
                $('#' + event).modal('show');
            });

            Livewire.on('close-modal', (event) => {
                $('#' + event).modal('hide');
            });

            // Listen for events from blog list
            Livewire.on('viewPub', (event) => {
                @this.viewPub(event.pubId);
            });

            Livewire.on('editPub', (event) => {
                @this.editPub(event.pubId);
            });

            Livewire.on('deletePub', (event) => {
                @this.deletePub(event.pubId);
            });

            // Handle CKEditor content setting for edit modal


            // Refresh page on update
            Livewire.on('pub-updated', () => {
                window.location.reload();
            });
        });



        // Alternative approach: Reinitialize editors when Livewire updates
        document.addEventListener('livewire:update', () => {
            // Check if edit modal is visible and initialize editor if needed
            // const editModal = document.getElementById('editPubModal');
            // if (editModal && editModal.classList.contains('show') && !editEditor) {
            //     setTimeout(() => {
            //         initializeEditEditor();
            //     }, 100);
            // }
        });
    </script>
</div>