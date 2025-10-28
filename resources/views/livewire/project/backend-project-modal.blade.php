<div>
    <!-- Add Blog Modal -->
    <div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog"
         aria-labelledby="addBlogModalTitle" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Project Post</h5>
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

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label>Title</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Project Category</label>
                                <select class="form-control" wire:model="category" required>
                                    <option value="">Please Select Category</option>
                                    <option value="BCC Experience and Expertise">BCC Experience and Expertise</option>
                                    <option value="Information & Communication">Information & Communication</option>
                                    <option value="Infrustructure Development">Infrustructure Development</option>
                                    <option value="Institutional Development">Institutional Development</option>
                                </select>
                                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Start Date</label>
                                <input type="date" class="form-control" wire:model="startDate">
                                @error('startDate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>End Date</label>
                                <input type="date" class="form-control" wire:model="endDate">
                                @error('endDate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Amount Funded</label>
                                <input type="text" class="form-control" wire:model="amountFunded">
                                @error('amountFunded') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select class="form-control" wire:model="status" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3" wire:ignore>
                            <label>Description</label>
                            <textarea id="description"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog"
         aria-labelledby="editBlogModalTitle" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Project Post</h5>
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

                        <input type="hidden" wire:model="blogId">

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label>Project Name</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Post Category</label>
                                <select class="form-control" wire:model="category" required>
                                    <option value="">Please Select Category</option>
                                    <option value="BCC Experience and Expertise">BCC Experience and Expertise</option>
                                    <option value="Information & Communication">Information & Communication</option>
                                    <option value="Infrustructure Development">Infrustructure Development</option>
                                    <option value="Institutional Development">Institutional Development</option>
                                </select>
                                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Start Date</label>
                                <input type="date" class="form-control" wire:model="startDate">
                                @error('startDate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>End Date</label>
                                <input type="date" class="form-control" wire:model="endDate">
                                @error('endDate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Amount Funded</label>
                                <input type="text" class="form-control" wire:model="amountFunded">
                                @error('amountFunded') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select class="form-control" wire:model="status" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3" wire:ignore>
                            <label>Description</label>
                            <div id="editDescriptionContainer">
                                <textarea id="editDescription">{{ $description }}</textarea>
                            </div>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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
    <div class="modal fade" id="viewBlogModal" tabindex="-1" role="dialog"
         aria-labelledby="viewBlogModalTitle" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Project Post</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="fw-bold">Project Name</label>
                            <p class="form-control-plaintext border-bottom pb-2">{{ $viewTitle ?? 'No title' }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold">Category</label>
                            <p class="form-control-plaintext border-bottom pb-2">{{ $viewCategory ?? 'No category' }}</p>
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
                            <label class="fw-bold">Amount Funded</label>
                            <p class="form-control-plaintext border-bottom pb-2">
                              
                                    {{ $viewamountFunded ?? "Funde Amount not available" }}

                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Start Date</label>
                            <p class="form-control-plaintext border-bottom pb-2">
                                
                                {{ $viewstartDate ?? "Date is not available" }}
                             
                            </p>
                        </div>
                         <div class="col-md-6">
                            <label class="fw-bold">End Date</label>
                            <p class="form-control-plaintext border-bottom pb-2">
                              
                                    {{ $viewendDate ?? "End date not available" }}

                            </p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Description</label>
                        <div class="blog-content-preview border rounded p-3 bg-light">
                            {!! $viewDescription ?? 'No description' !!}
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
            initializeCreateEditor();

            // Handle modal events for edit modal
            const editModal = document.getElementById('editBlogModal');
            if (editModal) {
                editModal.addEventListener('shown.bs.modal', function () {
                    // Small delay to ensure modal is fully rendered
                    setTimeout(() => {
                        initializeEditEditor();
                    }, 100);
                });

                editModal.addEventListener('hidden.bs.modal', function () {
                    // Destroy edit editor when modal closes to prevent conflicts
                    if (editEditor) {
                        editEditor.destroy().then(() => {
                            editEditor = null;
                            // Recreate the textarea for next time
                            const container = document.getElementById('editDescriptionContainer');
                            if (container) {
                                container.innerHTML = '<textarea id="editDescription">{{ $description }}</textarea>';
                            }
                        });
                    }
                });
            }

            // Handle modal open/close events
            Livewire.on('open-modal', (event) => {
                $('#' + event).modal('show');
            });

            Livewire.on('close-modal', (event) => {
                $('#' + event).modal('hide');
            });

            // Listen for events from blog list
            Livewire.on('viewBlog', (event) => {
                @this.viewBlog(event.blogId);
            });

            Livewire.on('editBlog', (event) => {
                @this.editBlog(event.blogId);
            });

            Livewire.on('deleteBlog', (event) => {
                @this.deleteBlog(event.blogId);
            });

            // Handle CKEditor content setting for edit modal
            Livewire.on('set-ckeditor-content', (event) => {
                if (editEditor) {
                    editEditor.setData(event.content || '');
                } else {
                    // If editor not ready, try again after a short delay
                    setTimeout(() => {
                        if (editEditor) {
                            editEditor.setData(event.content || '');
                        }
                    }, 200);
                }
            });

            // Refresh page on update
            Livewire.on('blog-updated', () => {
                window.location.reload();
            });
        });

        function initializeCreateEditor() {
            const descriptionElement = document.querySelector('#description');
            if (descriptionElement && typeof ClassicEditor !== 'undefined' && !createEditor) {
                ClassicEditor
                    .create(descriptionElement)
                    .then(editor => {
                        createEditor = editor;
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData());
                        });

                        // Reset editor when modal is closed
                        Livewire.on('reset-ckeditor', () => {
                            editor.setData('');
                        });
                    })
                    .catch(error => {
                        console.error('Create editor error:', error);
                    });
            }
        }

        function initializeEditEditor() {
            const editDescriptionElement = document.querySelector('#editDescription');
            if (editDescriptionElement && typeof ClassicEditor !== 'undefined' && !editEditor) {
                ClassicEditor
                    .create(editDescriptionElement)
                    .then(editor => {
                        editEditor = editor;
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData());
                        });

                        // Set initial content from Livewire
                        const currentDescription = @this.get('description');
                        if (currentDescription) {
                            editor.setData(currentDescription);
                        }
                    })
                    .catch(error => {
                        console.error('Edit editor error:', error);
                    });
            }
        }

        // Alternative approach: Reinitialize editors when Livewire updates
        document.addEventListener('livewire:update', () => {
            // Check if edit modal is visible and initialize editor if needed
            const editModal = document.getElementById('editBlogModal');
            if (editModal && editModal.classList.contains('show') && !editEditor) {
                setTimeout(() => {
                    initializeEditEditor();
                }, 100);
            }
        });
    </script>
</div>