<div class="col-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Business Inquiries</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->full_name }}</td>
                                <td>{{ $inquiry->company_name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>
                                    <span class="badge {{ $inquiry->status === 'reviewed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                </td>
                                <td>{{ optional($inquiry->created_at)->format('Y-m-d H:i') }}</td>
                                <td class="d-flex gap-2">
                                    <button class="btn btn-sm btn-primary" wire:click="viewInquiry({{ $inquiry->id }})">View</button>
                                    @if($inquiry->status !== 'reviewed')
                                        <button class="btn btn-sm btn-outline-success" wire:click="markReviewed({{ $inquiry->id }})">Mark Reviewed</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No business inquiries yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($selectedInquiry)
                <div class="mt-4 p-3" style="border:1px solid var(--admin-border); border-radius:12px; background:var(--admin-surface-soft);">
                    <h4 class="mb-3">Inquiry Details</h4>
                    <div class="row">
                        <div class="col-md-6 mb-2"><strong>Name:</strong> {{ $selectedInquiry->full_name }}</div>
                        <div class="col-md-6 mb-2"><strong>Email:</strong> {{ $selectedInquiry->email }}</div>
                        <div class="col-md-6 mb-2"><strong>Phone:</strong> {{ $selectedInquiry->phone ?: '-' }}</div>
                        <div class="col-md-6 mb-2"><strong>Company:</strong> {{ $selectedInquiry->company_name }}</div>
                    </div>
                    <div class="mt-3">
                        <strong>Business Summary:</strong>
                        <p class="mb-2">{{ $selectedInquiry->business_summary }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
