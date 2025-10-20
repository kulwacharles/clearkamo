<div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">About Us</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="card-body">
                                <form wire:submit.prevent="store" enctype="multipart/form-data">
                                     @if (session()->has('message'))
                                      <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="bg-green-200 text-green-800 p-2 rounded mb-2">
                                                {{ session('message') }}
                                            </div>
                                        </div>
                                      </div>
                                     @endif
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Title</label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="Title/Slogan" wire:model="title">
                                            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class=" col-md-6">
                                            <label class="form-label" for="inputPassword4">Years of Experience</label>
                                            <input type="number" class="form-control" id="inputPassword4" placeholder="Years of Experience" wire:model="years_of_experience">
                                            @error('years_of_experience') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3" wire:ignore>
                                        <label class="form-label" for="inputAddress">Descriptions</label>
                                         <textarea name="description" id="description" wire:model.defer="description">
                                            {?? $description ??}
                                         </textarea>
                                         @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                             <div class="row mb-3">
                                <div class="col-md-6">
                                    @if ($image)
                                        {{-- Show preview of new upload --}}
                                        <img class="img img-responsive mb-2" src="{{ $image->temporaryUrl() }}" height="200px">
                                    @elseif ($about1)
                                        {{-- Show stored image if no new upload --}}
                                        <img class="img img-responsive mb-2" src="{{ url('/storage/'.$about1) }}" height="200px">
                                    @endif
                                    <br>
                                    <label class="form-label">Image 1</label>
                                    <input type="file" class="form-control" wire:model="image">
                                    @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    @if ($image2)
                                        <img class="img img-responsive mb-2" src="{{ $image2->temporaryUrl() }}" height="200px">
                                    @elseif ($about2)
                                        <img class="img img-responsive mb-2" src="{{ url('/storage/'.$about2) }}" height="200px">
                                    @endif
                                    <br>
                                    <label class="form-label">Image 2</label>
                                    <input type="file" class="form-control" wire:model="image2">
                                    @error('image2') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                             </div>
                             <div class="row mb-3">
                                <div class="col-md-6">
                                    @if ($image3)
                                        <img class="img img-responsive mb-2" src="{{ $image3->temporaryUrl() }}" height="200px">
                                    @elseif ($about3)
                                        <img class="img img-responsive mb-2" src="{{ url('/storage/'.$about3) }}" height="200px">
                                    @endif
                                    <br>
                                    <label class="form-label">Image 3</label>
                                    <input type="file" class="form-control" wire:model="image3">
                                    @error('image3') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    @if ($logo)
                                        <img class="img img-responsive mb-2" src="{{ $logo->temporaryUrl() }}" height="200px">
                                    @elseif ($about4)
                                        <img class="img img-responsive mb-2" src="{{ url('/storage/'.$about4) }}" height="200px" width="100%">
                                    @endif
                                    <br>
                                    <label class="form-label">Logo</label>
                                    <input type="file" class="form-control" wire:model="logo">
                                    @error('logo') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                
                            </div>

                                
                                    <button  type="submit" class="btn btn-primary" wire:loading.attr="disabled">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

{{-- <script>
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
</script> --}}
<script>
    var Ckeditor = function () {
        var editorInstance;

        var demos = function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    editorInstance = editor;

                    // Sync Livewire when CKEditor content changes
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData());
                    });

                    // Listen for Livewire updates to description
                    Livewire.on('load-ckeditor-data', (data) => {
                        if (editorInstance) {
                            editorInstance.setData(data);
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        return {
            init: function () {
                demos();
            }
        };
    }();

    jQuery(document).ready(function () {
        Ckeditor.init();
    });
</script>
