<div>
    <style>
        .blog-image-preview {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 14px;
        }
        .blog-content-preview {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #e9ecef;
            padding: 10px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        .status-badge {
            font-size: 12px;
            padding: 4px 8px;
        }
    </style>

    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Publication List</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Publication Posts</h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form Active="#">
                                                    <div class="search_field">
                                                        <input type="text" placeholder="Search content here...">
                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add_button ms-2">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addBlogModal" class="btn_1">Add New</a>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Image</th> 
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($pubs != null)
                                            @foreach ($pubs as $pub)
                                                <tr>
                                                    <th scope="row"><a href="#" class="question_content">{{ $pub->title }}</a></th>
                                                    <td>{{ $pub->category }}</td>
                                                    <td>
                                                        @if($pub->image)
                                                            <img class="img" src="{{ asset('storage/'.$pub->image) }}" width="100px" height="100px" style="object-fit: cover;">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge status-badge bg-{{ $pub->status == 'published' ? 'success' : ($pub->status == 'draft' ? 'warning' : 'secondary') }}">
                                                            {{ ucfirst($pub->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <button type="button" class="btn btn-info btn-sm" 
                                                                    onclick="openViewModal({{ $pub->id }})">
                                                                <i class="ti-eye"></i> View
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" 
                                                                    onclick="openEditModal({{ $pub->id }})">
                                                                <i class="ti-pencil"></i> Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" 
                                                                    onclick="confirmDelete({{ $pub->id }})">
                                                                <i class="ti-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
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
            @livewire('publication.publications-modal')
        @endpush
    </div>
    <script>
        function openViewModal(pubId) {
            // Dispatch event to the modal component
            Livewire.dispatch('viewPub', {pubId: pubId});
        }

        function openEditModal(pubId) {
            // Dispatch event to the modal component
            Livewire.dispatch('editPub', {pubId: pubId});
        }

        function confirmDelete(pubId) {
            if (confirm('Are you sure you want to delete this Publication post?')) {
                Livewire.dispatch('deletePub', {pubId: pubId});
            }
        }

        // Listen for blog updates to refresh the page
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('pub-updated', () => {
                window.location.reload();
            });
        });
    </script>
</div>