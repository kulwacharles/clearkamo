<div>
    <style>
        .gal-thumb { width: 64px; height: 64px; object-fit: cover; border-radius: 8px; }
        .action-buttons { display: flex; gap: 8px; }
        .status-badge { font-size: 12px; padding: 4px 8px; }
    </style>

    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Project Gallery</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Gallery Photos</h4>
                                    <div class="box_right d-flex lms_block align-items-center gap-2">
                                        <select class="form-control form-control-sm" wire:model.live="filterProjectId" style="min-width:200px;">
                                            <option value="">— All Projects —</option>
                                            @foreach($projects as $proj)
                                                <option value="{{ $proj->id }}">{{ $proj->project_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="add_button ms-2">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addGalleryModal" class="btn_1">Add Photo</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active3">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Photo</th>
                                                <th>Project</th>
                                                <th>Caption</th>
                                                <th>Order</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($photos as $photo)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/'.$photo->image) }}" class="gal-thumb" alt="gallery">
                                                    </td>
                                                    <td>{{ $photo->project->project_name ?? '—' }}</td>
                                                    <td>{{ $photo->caption ?: '—' }}</td>
                                                    <td>{{ $photo->sort_order }}</td>
                                                    <td>
                                                        <span class="badge status-badge bg-{{ $photo->status === 'published' ? 'success' : 'warning' }}">
                                                            {{ ucfirst($photo->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <button class="btn btn-warning btn-sm" onclick="openEditGallery({{ $photo->id }})">
                                                                <i class="ti-pencil"></i> Edit
                                                            </button>
                                                            <button class="btn btn-danger btn-sm" onclick="confirmDeleteGallery({{ $photo->id }})">
                                                                <i class="ti-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="7" class="text-center text-muted">No photos yet. Add one above.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        @push('modals')
            @livewire('gallery.backend-gallery-modal')
        @endpush
    </div>

    <script>
        function openEditGallery(id) {
            Livewire.dispatch('editGalleryItem', {id: id});
        }

        function confirmDeleteGallery(id) {
            if (confirm('Are you sure you want to delete this photo?')) {
                Livewire.dispatch('deleteGalleryItem', {id: id});
            }
        }

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('gallery-updated', () => {
                // reload handled by #[On] in component
            });
        });
    </script>
</div>
