<div  class="col-lg-12">

        <div class="white_card card_height_100 mb_30" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Us</h5>
                  
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
                            <div class="col-md-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" wire:model="phone">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label>map</label>
                                <input type="text" class="form-control" wire:model="map">
                                @error('map') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>email</label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Linkedin</label>
                                <input type="text" class="form-control" wire:model="linkedin">
                                @error('linkendin') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                          <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Facebook</label>
                                <input type="text" class="form-control" wire:model="facebook">
                                @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Instagram</label>
                                <input type="url" class="form-control" wire:model="instagram">
                                @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                       
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Youtube</label>
                                <input type="text" class="form-control" wire:model="youtube">
                                @error('youtube') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Twitter/X</label>
                                <input type="text" class="form-control" wire:model="twitter">
                                @error('twitter') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label>Physical Address</label>
                                <input type="text" class="form-control" wire:model="physicalAddress">
                                @error('physicalAddress') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                 <label>Extra Info</label>
                                <input type="text" class="form-control" wire:model="extraInfo">
                                @error('extraInfo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                               
                        </div>


                        {{-- <div class="mb-3">
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
                        </div> --}}
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