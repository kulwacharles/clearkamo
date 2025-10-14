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
                                    <h3 class="m-0">News & Updates List</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>News & Updates Posts</h4>
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
                                            @if($blogs != null)
                                            @foreach ($blogs as $blog)
                                                <tr>
                                                    <th scope="row"><a href="#" class="question_content">{{ $blog->title }}</a></th>
                                                    <td>{{ $blog->category }}</td>
                                                    <td>
                                                        @if($blog->image)
                                                            <img class="img" src="{{ asset('storage/'.$blog->image) }}" width="100px" height="100px" style="object-fit: cover;">
                                                        @else
                                                            No Image
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge status-badge bg-{{ $blog->status == 'published' ? 'success' : ($blog->status == 'draft' ? 'warning' : 'secondary') }}">
                                                            {{ ucfirst($blog->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <button type="button" class="btn btn-info btn-sm" 
                                                                    onclick="openViewModal({{ $blog->id }})">
                                                                <i class="ti-eye"></i> View
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm" 
                                                                    onclick="openEditModal({{ $blog->id }})">
                                                                <i class="ti-pencil"></i> Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm" 
                                                                    onclick="confirmDelete({{ $blog->id }})">
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
            @livewire('blog.backend-blog-modal')
        @endpush
    </div>
    <script>
        function openViewModal(blogId) {
            // Dispatch event to the modal component
            Livewire.dispatch('viewBlog', {blogId: blogId});
        }

        function openEditModal(blogId) {
            // Dispatch event to the modal component
            Livewire.dispatch('editBlog', {blogId: blogId});
        }

        function confirmDelete(blogId) {
            if (confirm('Are you sure you want to delete this blog post?')) {
                Livewire.dispatch('deleteBlog', {blogId: blogId});
            }
        }

        // Listen for blog updates to refresh the page
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('blog-updated', () => {
                window.location.reload();
            });
        });
    </script>
</div>