<div>
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">CEO Message</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Floating CEO Message Popup</h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="add_button ms-2">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addCeoMessageModal" class="btn_1">Add CEO Message</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="QA_table mb_30">
                                    <table class="table lms_table_active3">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>CEO (Team Member)</th>
                                                <th>Message</th>
                                                <th>Scroll Trigger</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($messages as $msg)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if($msg->team)
                                                            <div class="d-flex align-items-center gap-2">
                                                                @if($msg->team->image)
                                                                    <img src="{{ asset('storage/'.$msg->team->image) }}"
                                                                         style="width:40px;height:40px;object-fit:cover;border-radius:50%;" alt="">
                                                                @endif
                                                                <div>
                                                                    <div class="fw-semibold">{{ $msg->team->name }}</div>
                                                                    <small class="text-muted">{{ $msg->team->position }}</small>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    <td style="max-width:320px;">
                                                        <span title="{{ $msg->message }}">{{ \Illuminate\Support\Str::limit($msg->message, 100) }}</span>
                                                    </td>
                                                    <td>{{ $msg->scroll_trigger_percent }}%</td>
                                                    <td>
                                                        @if($msg->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-buttons d-flex gap-2">
                                                            <button class="btn btn-sm {{ $msg->is_active ? 'btn-warning' : 'btn-success' }}"
                                                                    wire:click="$dispatch('toggleCeoMessage', { id: {{ $msg->id }} })"
                                                                    title="{{ $msg->is_active ? 'Deactivate' : 'Activate' }}">
                                                                <i class="ti-power-off"></i>
                                                                {{ $msg->is_active ? 'Deactivate' : 'Activate' }}
                                                            </button>
                                                            <button class="btn btn-sm btn-info"
                                                                    wire:click="$dispatch('editCeoMessage', { id: {{ $msg->id }} })">
                                                                <i class="ti-pencil"></i> Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-danger"
                                                                    wire:click="$dispatch('deleteCeoMessage', { id: {{ $msg->id }} })"
                                                                    wire:confirm="Are you sure you want to delete this CEO message?">
                                                                <i class="ti-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted py-4">
                                                        No CEO messages yet. Click "Add CEO Message" to create one.
                                                    </td>
                                                </tr>
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

    @livewire('ceo-message.backend-ceo-message-modal')
</div>
