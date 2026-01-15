@aware(['modalType' => 'default'])
<!-- Title Field -->
<div class="mb-3">
    <label class="form-label">Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control" wire:model="title" placeholder="Enter title">
    @error('title') 
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- Status Field -->
<div class="mb-3">
    <label class="form-label">Status <span class="text-danger">*</span></label>
    <select class="form-control" wire:model="status" required>
        <option value="draft">Draft</option>
        <option value="published">Published</option>
        <option value="archived">Archived</option>
    </select>
    @error('status') 
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- Description Field - This will be handled separately with CKEditor -->