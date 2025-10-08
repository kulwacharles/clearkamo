<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Publications</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="modal-body">
                    @if (session()->has('message'))
                        <div class="bg-success text-white p-2 rounded mb-2">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Title</label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Group</label>
                            <input type="text" class="form-control" wire:model="group">
                            @error('group') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3" wire:ignore>
                        <label>Descriptions</label>
                        <textarea id="description"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" class="form-control" wire:model="image">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var Ckeditor = function () {
        var editorInstance; // keep reference

        // Private init function
        var demos = function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    editorInstance = editor;

                    // Sync Livewire when CKEditor content changes
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData());
                    });

                    // Listen for Livewire reset event
                    window.addEventListener('reset-ckeditor', () => {
                        editor.setData(''); // clear CKEditor
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        return {
            // public init
            init: function() {
                demos();
            },
            // allow manual reset if needed
            reset: function() {
                if (editorInstance) {
                    editorInstance.setData('');
                }
            }
        };
    }();

    // Initialization
    jQuery(document).ready(function() {
        Ckeditor.init();
    });
    window.addEventListener('close-modal', event => {
        // Bootstrap 5 modal handling
        var myModalEl = document.getElementById('exampleModalCenter');
        var modal = bootstrap.Modal.getInstance(myModalEl);
        modal.hide();
    });
</script>

