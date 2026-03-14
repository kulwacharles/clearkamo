<div>
    <style>
        .cv-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
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
                                    <h3 class="m-0">Core Values</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Our Core Values</h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="add_button ms-2">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addCoreValueModal" class="btn_1">Add New</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active3">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Icon</th>
                                                <th>Order</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($coreValues as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        @if($item->image)
                                                            <img src="{{ asset('storage/'.$item->image) }}" class="cv-preview" alt="img">
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->icon)
                                                            <i class="fas {{ $item->icon }} fa-lg"></i>
                                                            <small class="text-muted ms-1">{{ $item->icon }}</small>
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->sort_order }}</td>
                                                    <td>
                                                        <span class="badge status-badge bg-{{ $item->status === 'published' ? 'success' : 'warning' }}">
                                                            {{ ucfirst($item->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <button class="btn btn-warning btn-sm" onclick="openEditCoreValue({{ $item->id }})">
                                                                <i class="ti-pencil"></i> Edit
                                                            </button>
                                                            <button class="btn btn-danger btn-sm" onclick="confirmDeleteCoreValue({{ $item->id }})">
                                                                <i class="ti-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="7" class="text-center text-muted">No core values found. Add one above.</td></tr>
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
            @livewire('core-value.backend-core-value-modal')
        @endpush
    </div>

    <script>
        function openEditCoreValue(id) {
            Livewire.dispatch('editCoreValueItem', {id: id});
        }

        function confirmDeleteCoreValue(id) {
            if (confirm('Are you sure you want to delete this core value?')) {
                Livewire.dispatch('deleteCoreValueItem', {id: id});
            }
        }

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('core-value-updated', () => {
                window.location.reload();
            });
        });
    </script>
</div>
