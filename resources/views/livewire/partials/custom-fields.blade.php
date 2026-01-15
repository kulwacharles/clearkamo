@aware(['modalType' => 'default', 'mode' => 'create'])
@if($type === 'blog')
    <!-- Blog-specific fields -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select class="form-control" wire:model="customFields.category" required>
                <option value="">Select Category</option>
                <option value="Technology">Technology</option>
                <option value="Business">Business</option>
                <option value="Lifestyle">Lifestyle</option>
                <option value="Health">Health</option>
                <option value="Education">Education</option>
            </select>
            @error('customFields.category') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Reading Time (minutes)</label>
            <input type="number" class="form-control" wire:model="customFields.reading_time" placeholder="e.g., 5" min="1">
            @error('customFields.reading_time') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Tags</label>
        <input type="text" class="form-control" wire:model="customFields.tags" placeholder="Enter tags separated by commas">
        @error('customFields.tags') 
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
        <div class="form-text">Separate multiple tags with commas</div>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" wire:model="customFields.featured" id="featuredBlog">
            <label class="form-check-label" for="featuredBlog">
                Featured Post
            </label>
        </div>
        @error('customFields.featured') 
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

@elseif($type === 'publication')
    <!-- Publication-specific fields -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Publication Category <span class="text-danger">*</span></label>
            <select class="form-control" wire:model="customFields.publication_category" required>
                <option value="">Select Category</option>
                <option value="Research">Research</option>
                <option value="Journal">Journal</option>
                <option value="Conference">Conference</option>
                <option value="Book">Book</option>
                <option value="Thesis">Thesis</option>
            </select>
            @error('customFields.publication_category') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="col-md-6">
            <label class="form-label">ISBN</label>
            <input type="text" class="form-control" wire:model="customFields.isbn" placeholder="Enter ISBN number">
            @error('customFields.isbn') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div> --}}
    {{-- </div>

    <div class="mb-3"> --}}
        {{-- <label class="form-label">Author(s) <span class="text-danger">*</span></label>
        <input type="text" class="form-control" wire:model="customFields.authors" placeholder="Enter author names">
        @error('customFields.authors') 
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
        <div class="form-text">Separate multiple authors with commas</div> --}}
    {{-- </div> --}}

    {{-- <div class="row mb-3"> --}}
        <div class="col-md-6">
            <label class="form-label">Published Date</label>
            <input type="date" class="form-control" wire:model="customFields.published_date">
            @error('customFields.published_date') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        {{-- </div>
        <div class="col-md-6"> --}}
            {{-- <label class="form-label">Publisher</label>
            <input type="text" class="form-control" wire:model="customFields.publisher" placeholder="Enter publisher name">
            @error('customFields.publisher') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror --}}
        </div>
    </div>

@elseif($type === 'product')
    <!-- Product-specific fields -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Price <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" class="form-control" wire:model="customFields.price" placeholder="0.00">
            </div>
            @error('customFields.price') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
            <input type="number" class="form-control" wire:model="customFields.stock_quantity" placeholder="0" min="0">
            @error('customFields.stock_quantity') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">SKU <span class="text-danger">*</span></label>
            <input type="text" class="form-control" wire:model="customFields.sku" placeholder="Product SKU">
            @error('customFields.sku') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Brand</label>
            <input type="text" class="form-control" wire:model="customFields.brand" placeholder="Enter brand name">
            @error('customFields.brand') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Weight (kg)</label>
            <input type="number" step="0.01" class="form-control" wire:model="customFields.weight" placeholder="0.00" min="0">
            @error('customFields.weight') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Dimensions</label>
        <input type="text" class="form-control" wire:model="customFields.dimensions" placeholder="e.g., 10x5x2 cm">
        @error('customFields.dimensions') 
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

@elseif($type === 'news')
    <!-- News-specific fields -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">News Category <span class="text-danger">*</span></label>
            <select class="form-control" wire:model="customFields.news_category" required>
                <option value="">Select Category</option>
                <option value="Breaking">Breaking News</option>
                <option value="Local">Local News</option>
                <option value="International">International</option>
                <option value="Sports">Sports</option>
                <option value="Entertainment">Entertainment</option>
            </select>
            @error('customFields.news_category') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" wire:model="customFields.location" placeholder="Enter location">
            @error('customFields.location') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Source</label>
        <input type="text" class="form-control" wire:model="customFields.source" placeholder="Enter news source">
        @error('customFields.source') 
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Reporter</label>
        <input type="text" class="form-control" wire:model="customFields.reporter" placeholder="Enter reporter name">
        @error('customFields.reporter') 
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

@elseif($type === 'event')
    <!-- Event-specific fields -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Event Type <span class="text-danger">*</span></label>
            <select class="form-control" wire:model="customFields.event_type" required>
                <option value="">Select Type</option>
                <option value="Conference">Conference</option>
                <option value="Workshop">Workshop</option>
                <option value="Seminar">Seminar</option>
                <option value="Webinar">Webinar</option>
                <option value="Meeting">Meeting</option>
            </select>
            @error('customFields.event_type') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Venue</label>
            <input type="text" class="form-control" wire:model="customFields.venue" placeholder="Enter venue">
            @error('customFields.venue') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Start Date & Time</label>
            <input type="datetime-local" class="form-control" wire:model="customFields.start_datetime">
            @error('customFields.start_datetime') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">End Date & Time</label>
            <input type="datetime-local" class="form-control" wire:model="customFields.end_datetime">
            @error('customFields.end_datetime') 
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Organizer</label>
        <input type="text" class="form-control" wire:model="customFields.organizer" placeholder="Enter organizer name">
        @error('customFields.organizer') 
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

@else
    <!-- Default fallback for unknown types -->
    <div class="alert alert-info">
        <i class="ti-info-alt me-2"></i>
        No custom fields configured for this content type.
    </div>
@endif