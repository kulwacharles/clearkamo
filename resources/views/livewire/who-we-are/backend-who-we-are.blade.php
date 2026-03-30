<div class="col-lg-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Who We Are (Home Page)</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body">
            <div class="card-body">
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" wire:model.lazy="title" placeholder="Who We Are">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Years of Experience</label>
                            <input type="number" min="0" class="form-control" wire:model.lazy="years_of_experience">
                            @error('years_of_experience') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">YouTube URL</label>
                            <input type="url" class="form-control" wire:model.lazy="youtube_url" placeholder="https://youtube.com/watch?v=...">
                            @error('youtube_url') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3" wire:ignore>
                        <label class="form-label">Description</label>
                        <textarea id="who_we_are_description" wire:model.defer="description"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @elseif ($existingImagePath)
                                <img src="{{ asset('storage/'.$existingImagePath) }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @endif
                            <label class="form-label d-block">Main Image</label>
                            <input type="file" class="form-control" wire:model="image" accept="image/*">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            @if ($secondary_image)
                                <img src="{{ $secondary_image->temporaryUrl() }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @elseif ($existingSecondaryImagePath)
                                <img src="{{ asset('storage/'.$existingSecondaryImagePath) }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @endif
                            <label class="form-label d-block">Secondary Image (Optional)</label>
                            <input type="file" class="form-control" wire:model="secondary_image" accept="image/*">
                            @error('secondary_image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Market Position</label>
                            <textarea class="form-control" rows="6" wire:model.defer="market_position_description" placeholder="Explain why ClearKamo is different."></textarea>
                            @error('market_position_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            @if ($market_position_image)
                                <img src="{{ $market_position_image->temporaryUrl() }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @elseif ($existingMarketPositionImagePath)
                                <img src="{{ asset('storage/'.$existingMarketPositionImagePath) }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @endif
                            <label class="form-label d-block">Market Position Image</label>
                            <input type="file" class="form-control" wire:model="market_position_image" accept="image/*">
                            @error('market_position_image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Our Purpose</label>
                            <textarea class="form-control" rows="6" wire:model.defer="purpose_description" placeholder="Describe ClearKamo's purpose."></textarea>
                            @error('purpose_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            @if ($purpose_image)
                                <img src="{{ $purpose_image->temporaryUrl() }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @elseif ($existingPurposeImagePath)
                                <img src="{{ asset('storage/'.$existingPurposeImagePath) }}" class="img img-responsive mb-2" style="max-height: 220px;">
                            @endif
                            <label class="form-label d-block">Our Purpose Image</label>
                            <input type="file" class="form-control" wire:model="purpose_image" accept="image/*">
                            @error('purpose_image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        Save Who We Are
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        let editorInstance = null;

        function initEditor() {
            const el = document.querySelector('#who_we_are_description');
            if (!el || editorInstance || typeof ClassicEditor === 'undefined') {
                return;
            }

            ClassicEditor.create(el)
                .then(editor => {
                    editorInstance = editor;
                    const initialData = @js($description ?? '');
                    if (initialData) {
                        editorInstance.setData(initialData);
                    }

                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData());
                    });

                    Livewire.on('load-who-we-are-ckeditor', (data) => {
                        if (editorInstance) {
                            editorInstance.setData(data || '');
                        }
                    });
                })
                .catch(error => console.error(error));
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEditor);
        } else {
            initEditor();
        }
    })();
</script>
