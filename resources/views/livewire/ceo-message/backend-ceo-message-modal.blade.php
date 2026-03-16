<div>
    <!-- Add CEO Message Modal -->
    <div class="modal fade" id="addCeoMessageModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add CEO Message</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetAll">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">CEO (select team member) <span class="text-danger">*</span></label>
                            <select class="form-control" wire:model="team_id">
                                <option value="">— Select a team member —</option>
                                @foreach($teams as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->position }})</option>
                                @endforeach
                            </select>
                            @error('team_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CEO Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="message" rows="5"
                                      placeholder="Enter the CEO's message to site visitors…"></textarea>
                            @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Scroll Trigger (% of page) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="scroll_trigger_percent"
                                       min="0" max="100" placeholder="30">
                                <small class="text-muted">Popup appears after the user has scrolled this percentage of the page. Default: 30%</small>
                                @error('scroll_trigger_percent') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 d-flex align-items-center mt-3 mt-md-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="is_active" id="addIsActive">
                                    <label class="form-check-label" for="addIsActive">
                                        Activate immediately <span class="text-muted">(only one message can be active at a time)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetAll">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save</span>
                            <span wire:loading>Saving…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit CEO Message Modal -->
    <div class="modal fade" id="editCeoMessageModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit CEO Message</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetAll">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">CEO (select team member) <span class="text-danger">*</span></label>
                            <select class="form-control" wire:model="team_id">
                                <option value="">— Select a team member —</option>
                                @foreach($teams as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->position }})</option>
                                @endforeach
                            </select>
                            @error('team_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CEO Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" wire:model="message" rows="5"></textarea>
                            @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Scroll Trigger (% of page) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="scroll_trigger_percent"
                                       min="0" max="100">
                                <small class="text-muted">Popup appears after the user has scrolled this % of the page.</small>
                                @error('scroll_trigger_percent') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 d-flex align-items-center mt-3 mt-md-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="is_active" id="editIsActive">
                                    <label class="form-check-label" for="editIsActive">
                                        Active <span class="text-muted">(only one can be active at a time)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetAll">Close</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Update</span>
                            <span wire:loading>Updating…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('open-modal', event => {
            const el = document.getElementById(event.detail);
            if (el) new bootstrap.Modal(el).show();
        });
        window.addEventListener('close-modal', event => {
            const el = document.getElementById(event.detail);
            if (el) {
                const m = bootstrap.Modal.getInstance(el);
                if (m) m.hide();
            }
        });
    </script>
</div>
