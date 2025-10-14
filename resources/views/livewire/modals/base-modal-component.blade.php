<div>
    @php
        $modalType = $this->modalType ?? 'default';
    @endphp

    <!-- Add Modal -->
    <div class="modal fade" id="{{ $modalType }}AddModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New {{ ucfirst($modalType) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetAll"></button>
                </div>

                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Custom Fields -->
                        {{-- @if($modalType === 'blog')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Category *</label>
                                    <select class="form-control" wire:model="customFields.category">
                                        <option value="">Select Category</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Business">Business</option>
                                        <option value="Lifestyle">Lifestyle</option>
                                    </select>
                                    @error('customFields.category') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reading Time (minutes)</label>
                                    <input type="number" class="form-control" wire:model="customFields.reading_time" min="1">
                                    @error('customFields.reading_time') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" class="form-control" wire:model="customFields.tags" placeholder="tag1, tag2, tag3">
                                @error('customFields.tags') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="customFields.featured">
                                    <label class="form-check-label">Featured Post</label>
                                </div>
                            </div>
                        @endif --}}
                            <!-- In the Add Modal and Edit Modal, update the custom fields section: -->

                        @if($modalType === 'blog')
                            <!-- Blog fields (existing code) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Category *</label>
                                    <select class="form-control" wire:model="customFields.category">
                                        <option value="">Select Category</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Business">Business</option>
                                        <option value="Lifestyle">Lifestyle</option>
                                    </select>
                                    @error('customFields.category') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reading Time (minutes)</label>
                                    <input type="number" class="form-control" wire:model="customFields.reading_time" min="1">
                                    @error('customFields.reading_time') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" class="form-control" wire:model="customFields.tags" placeholder="tag1, tag2, tag3">
                                @error('customFields.tags') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="customFields.featured">
                                    <label class="form-check-label">Featured Post</label>
                                </div>
                            </div>

                        @elseif($modalType === 'publication')
                            <!-- Publication-specific fields -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Publication Category *</label>
                                    <select class="form-control" wire:model="customFields.publication_category" required>
                                        <option value="">Select Category</option>
                                        <option value="Research Paper">Research Paper</option>
                                        <option value="Journal Article">Journal Article</option>
                                        <option value="Conference Paper">Conference Paper</option>
                                        <option value="Book">Book</option>
                                        <option value="Thesis">Thesis</option>
                                        <option value="Technical Report">Technical Report</option>
                                    </select>
                                    @error('customFields.publication_category') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ISBN</label>
                                    <input type="text" class="form-control" wire:model="customFields.isbn" placeholder="Enter ISBN number">
                                    @error('customFields.isbn') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label class="form-label">Authors *</label>
                                <input type="text" class="form-control" wire:model="customFields.authors" placeholder="Enter author names">
                                @error('customFields.authors') <span class="text-danger small">{{ $message }}</span> @enderror
                                <div class="form-text">Separate multiple authors with commas</div>
                            </div> --}}

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Published Date</label>
                                    <input type="date" class="form-control" wire:model="customFields.published_date">
                                    @error('customFields.published_date') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Publisher</label>
                                    <input type="text" class="form-control" wire:model="customFields.publisher" placeholder="Enter publisher name">
                                    @error('customFields.publisher') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        @endif
                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-control" wire:model="status">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3" wire:ignore>
                            <label class="form-label">Description *</label>
                            <textarea id="{{ $modalType }}CreateEditor">{{ $description ?? '' }}</textarea>
                            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 200px;">
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

    <!-- Edit Modal -->
    <div class="modal fade" id="{{ $modalType }}EditModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ ucfirst($modalType) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetAll"></button>
                </div>

                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <input type="hidden" wire:model="recordId">

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Custom Fields -->
                        <!-- In the Add Modal and Edit Modal, update the custom fields section: -->

                        @if($modalType === 'blog')
                            <!-- Blog fields (existing code) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Category *</label>
                                    <select class="form-control" wire:model="customFields.category">
                                        <option value="">Select Category</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Business">Business</option>
                                        <option value="Lifestyle">Lifestyle</option>
                                    </select>
                                    @error('customFields.category') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reading Time (minutes)</label>
                                    <input type="number" class="form-control" wire:model="customFields.reading_time" min="1">
                                    @error('customFields.reading_time') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" class="form-control" wire:model="customFields.tags" placeholder="tag1, tag2, tag3">
                                @error('customFields.tags') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="customFields.featured">
                                    <label class="form-check-label">Featured Post</label>
                                </div>
                            </div>

                        @elseif($modalType === 'publication')
                            <!-- Publication-specific fields -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Publication Category *</label>
                                    <select class="form-control" wire:model="customFields.publication_category" required>
                                        <option value="">Select Category</option>
                                        <option value="Research Paper">Research Paper</option>
                                        <option value="Journal Article">Journal Article</option>
                                        <option value="Conference Paper">Conference Paper</option>
                                        <option value="Book">Book</option>
                                        <option value="Thesis">Thesis</option>
                                        <option value="Technical Report">Technical Report</option>
                                    </select>
                                    @error('customFields.publication_category') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ISBN</label>
                                    <input type="text" class="form-control" wire:model="customFields.isbn" placeholder="Enter ISBN number">
                                    @error('customFields.isbn') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Authors *</label>
                                <input type="text" class="form-control" wire:model="customFields.authors" placeholder="Enter author names">
                                @error('customFields.authors') <span class="text-danger small">{{ $message }}</span> @enderror
                                <div class="form-text">Separate multiple authors with commas</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Published Date</label>
                                    <input type="date" class="form-control" wire:model="customFields.published_date">
                                    @error('customFields.published_date') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Publisher</label>
                                    <input type="text" class="form-control" wire:model="customFields.publisher" placeholder="Enter publisher name">
                                    @error('customFields.publisher') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        @endif

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-control" wire:model="status">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                            @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                       <div class="mb-3" wire:ignore>
                            <label class="form-label">Description *</label>
                             <textarea id="{{ $modalType }}EditEditor" wire:model="description">{{ $description }}</textarea>
                          @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            @if($currentImage)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$currentImage) }}" class="img-fluid rounded" style="max-height: 200px;">
                                </div>
                            @else
                                <p class="text-muted">No image</p>
                            @endif
                            
                            <label class="form-label">Change Image</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded" style="max-height: 200px;">
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

    <!-- View Modal -->
    <div class="modal fade" id="{{ $modalType }}ViewModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View {{ ucfirst($modalType) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- In the View Modal, update the content section: -->
                <div class="modal-body">
                    @if(isset($viewData['title']))
                        <div class="mb-3">
                            <label class="fw-bold">Title</label>
                            <p>{{ $viewData['title'] }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="fw-bold">Status</label>
                            <p>{{ ucfirst($viewData['status']) }}</p>
                        </div>
                        
                        @if($modalType === 'blog' && isset($viewData['category']))
                            <div class="mb-3">
                                <label class="fw-bold">Category</label>
                                <p>{{ $viewData['category'] }}</p>
                            </div>
                        @endif
                        
                        @if($modalType === 'publication')
                            @if(isset($viewData['publication_category']))
                                <div class="mb-3">
                                    <label class="fw-bold">Publication Category</label>
                                    <p>{{ $viewData['publication_category'] }}</p>
                                </div>
                            @endif
                            
                            @if(isset($viewData['authors']))
                                <div class="mb-3">
                                    <label class="fw-bold">Authors</label>
                                    <p>{{ $viewData['authors'] }}</p>
                                </div>
                            @endif
                            
                            @if(isset($viewData['isbn']))
                                <div class="mb-3">
                                    <label class="fw-bold">ISBN</label>
                                    <p>{{ $viewData['isbn'] }}</p>
                                </div>
                            @endif
                            
                            @if(isset($viewData['published_date']))
                                <div class="mb-3">
                                    <label class="fw-bold">Published Date</label>
                                    <p>{{ \Carbon\Carbon::parse($viewData['published_date'])->format('M d, Y') }}</p>
                                </div>
                            @endif
                            
                            @if(isset($viewData['publisher']))
                                <div class="mb-3">
                                    <label class="fw-bold">Publisher</label>
                                    <p>{{ $viewData['publisher'] }}</p>
                                </div>
                            @endif
                        @endif
                        
                        <div class="mb-3">
                            <label class="fw-bold">Description</label>
                            <div class="border rounded p-3">
                                {!! $viewData['description'] !!}
                            </div>
                        </div>
                        
                        @if($viewData['image'])
                            <div class="mb-3">
                                <label class="fw-bold">Image</label>
                                <img src="{{ asset('storage/'.$viewData['image']) }}" class="img-fluid rounded">
                            </div>
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Simple and robust modal manager
class SimpleModalManager {
    constructor() {
        this.modalType = '{{ $modalType }}';
        this.currentOpenModal = null;
        this.init();
    }

    init() {
        this.initializeModals();
        this.setupLivewireEvents();
        this.setupGlobalHandlers();
        this.ensureCleanStart();
    }

    ensureCleanStart() {
        // Clean up any leftover modal states on page load
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('show');
            modal.style.display = 'none';
        });
        
        // Remove any leftover backdrops
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
            backdrop.remove();
        });
        
        // Reset body
        document.body.classList.remove('modal-open');
    }

    initializeModals() {
        console.log('🔄 Initializing modals for:', this.modalType);
        
        ['AddModal', 'EditModal', 'ViewModal'].forEach(suffix => {
            this.initializeSingleModal(this.modalType + suffix);
        });
    }

    initializeSingleModal(modalId) {
        const modalElement = document.getElementById(modalId);
        if (!modalElement) return;

        // Clean up existing instance
        const existingInstance = bootstrap.Modal.getInstance(modalElement);
        if (existingInstance) {
            existingInstance.dispose();
        }

        // Create fresh instance
        const modalInstance = new bootstrap.Modal(modalElement, {
            backdrop: true,
            keyboard: true,
            focus: true
        });

        // Store reference
        modalElement.bootstrapInstance = modalInstance;

        this.setupModalEvents(modalElement, modalId);
    }

    setupModalEvents(modalElement, modalId) {
        // Clone to remove old event listeners
        const newModal = modalElement.cloneNode(true);
        modalElement.parentNode.replaceChild(newModal, modalElement);
        
        const freshModal = document.getElementById(modalId);
        if (!freshModal) return;

        freshModal.addEventListener('show.bs.modal', () => {
            console.log('Opening modal:', modalId);
            this.closeAnyOpenModal(); // Close any other open modal first
            this.currentOpenModal = modalId;
        });

        freshModal.addEventListener('shown.bs.modal', () => {
            console.log('Modal shown:', modalId);
            if (modalId.includes('EditModal')) {
                this.initCKEditor(this.modalType + 'EditEditor', 'edit');
            } else if (modalId.includes('AddModal')) {
                this.initCKEditor(this.modalType + 'CreateEditor', 'create');
            }
        });

        freshModal.addEventListener('hide.bs.modal', () => {
            console.log('Closing modal:', modalId);
        });

        freshModal.addEventListener('hidden.bs.modal', () => {
            console.log('Modal hidden:', modalId);
            this.currentOpenModal = null;
            
            if (modalId.includes('EditModal')) {
                this.destroyCKEditor(this.modalType + 'EditEditor');
            } else if (modalId.includes('AddModal')) {
                this.destroyCKEditor(this.modalType + 'CreateEditor');
            }

            this.cleanupAfterClose();
        });
    }

    closeAnyOpenModal() {
        if (this.currentOpenModal) {
            const currentModal = document.getElementById(this.currentOpenModal);
            if (currentModal) {
                const instance = bootstrap.Modal.getInstance(currentModal);
                if (instance) {
                    instance.hide();
                }
            }
        }
    }

    cleanupAfterClose() {
        // Wait a bit then clean up
        setTimeout(() => {
            // Remove extra backdrops
            const backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 1) {
                console.log('Removing extra backdrops');
                for (let i = 1; i < backdrops.length; i++) {
                    backdrops[i].remove();
                }
            }

            // Ensure body is clean
            const openModals = document.querySelectorAll('.modal.show');
            if (openModals.length === 0) {
                document.body.classList.remove('modal-open');
                document.body.style.paddingRight = '';
                document.body.style.overflow = '';
            }
        }, 150);
    }

    initCKEditor(editorId, mode) {
        // Destroy existing first
        this.destroyCKEditor(editorId);

        if (typeof ClassicEditor === 'undefined') {
            setTimeout(() => this.initCKEditor(editorId, mode), 100);
            return;
        }

        const editorElement = document.getElementById(editorId);
        if (!editorElement) return;

        ClassicEditor.create(editorElement)
            .then(editor => {
                window[editorId + '_instance'] = editor;
                
                if (mode === 'edit') {
                    const content = editorElement.value;
                    if (content) editor.setData(content);
                }

                editor.model.document.on('change:data', () => {
                    editorElement.value = editor.getData();
                });
            })
            .catch(console.error);
    }

    destroyCKEditor(editorId) {
        const editor = window[editorId + '_instance'];
        if (editor) {
            editor.destroy().catch(() => {});
            delete window[editorId + '_instance'];
        }
    }

    setupLivewireEvents() {
        if (typeof Livewire === 'undefined') {
            setTimeout(() => this.setupLivewireEvents(), 100);
            return;
        }

        Livewire.on('open-modal', (modalId) => {
            console.log('🚪 Livewire opening:', modalId);
            this.openModal(modalId);
        });

        Livewire.on('close-modal', (modalId) => {
            console.log('🚪 Livewire closing:', modalId);
            this.closeModal(modalId);
        });
    }

    setupGlobalHandlers() {
        // Handle manual modal clicks
        document.addEventListener('click', (e) => {
            const trigger = e.target.closest('[data-bs-toggle="modal"]');
            if (trigger && trigger.getAttribute('data-bs-toggle') === 'modal') {
                const targetModal = trigger.getAttribute('data-bs-target');
                if (targetModal?.startsWith('#')) {
                    e.preventDefault();
                    this.openModal(targetModal.substring(1));
                }
            }
        });

        // Handle page navigation
        if (typeof Livewire !== 'undefined') {
            document.addEventListener('livewire:navigating', () => {
                this.cleanupAll();
            });

            document.addEventListener('livewire:navigated', () => {
                setTimeout(() => new SimpleModalManager(), 500);
            });
        }
    }

    openModal(modalId) {
        this.closeAnyOpenModal(); // Close any open modal first
        
        const modalElement = document.getElementById(modalId);
        if (!modalElement) {
            console.error('Modal not found:', modalId);
            return;
        }

        let modalInstance = modalElement.bootstrapInstance;
        if (!modalInstance) {
            modalInstance = new bootstrap.Modal(modalElement);
            modalElement.bootstrapInstance = modalInstance;
        }

        modalInstance.show();
    }

    closeModal(modalId) {
        const modalElement = document.getElementById(modalId);
        if (!modalElement) return;

        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
            modalInstance.hide();
        }
    }

    cleanupAll() {
        console.log('🧹 Cleaning up all modals');
        
        // Destroy CKEditors
        this.destroyCKEditor(this.modalType + 'EditEditor');
        this.destroyCKEditor(this.modalType + 'CreateEditor');
        
        // Close all modals
        document.querySelectorAll('.modal').forEach(modal => {
            const instance = bootstrap.Modal.getInstance(modal);
            if (instance) instance.hide();
        });
        
        this.cleanupAfterClose();
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new SimpleModalManager();
});

// Debug
window.debugModals = function() {
    console.log('=== MODAL DEBUG ===');
    document.querySelectorAll('.modal').forEach(modal => {
        const instance = bootstrap.Modal.getInstance(modal);
        console.log(`${modal.id}:`, {
            instance: instance ? '✅' : '❌',
            visible: modal.classList.contains('show') ? '✅' : '❌',
            display: modal.style.display
        });
    });
    
    const backdrops = document.querySelectorAll('.modal-backdrop');
    console.log('Backdrops:', backdrops.length);
};
</script>