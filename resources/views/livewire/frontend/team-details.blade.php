<div>
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg.jpg') }}">
        <div class="breadcumb-shape1">
            <img src="{{ asset('assets/img/shape/breadcrumb-shape1.svg') }}" alt="img">
        </div>
        <div class="breadcumb-shape2">
            <img src="{{ asset('assets/img/shape/breadcrumb-shape2.svg') }}" alt="img">
        </div>
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $member->name }}</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="{{ route('home') }}">Home</a></li>
                    <li>Team Details</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="space">
        <div class="container">
            <div class="row mb-60 align-items-start">
                <div class="col-xl-5 mb-4 mb-xl-0">
                    <div class="about-card-img">
                        <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" style="width:100%;border-radius:14px;">
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="about-card">
                        <h2 class="about-card_title h3">{{ $member->name }}</h2>
                        <p class="about-card_desig">{{ $member->position }}</p>
                        <p class="about-card_text">{!! $member->description !!}</p>

                        <div class="th-social mt-3">
                            @if(!empty($member->facebook))
                                <a target="_blank" href="{{ $member->facebook }}"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if(!empty($member->twitter))
                                <a target="_blank" href="{{ $member->twitter }}"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if(!empty($member->instagram))
                                <a target="_blank" href="{{ $member->instagram }}"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if(!empty($member->linkedin))
                                <a target="_blank" href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if(!empty($member->youtube))
                                <a target="_blank" href="{{ $member->youtube }}"><i class="fab fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($teams && $teams->count() > 0)
                <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-md-auto">
                        <h2 class="sec-title text-center text-md-start">Other Team Members</h2>
                    </div>
                    <div class="col-md d-none d-md-block">
                        <hr class="title-line">
                    </div>
                </div>

                <div class="row gy-30">
                    @foreach($teams as $team)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="team-card p-3 h-100" style="border:1px solid #e5e7eb;border-radius:14px;background:#fff;">
                                <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}" class="d-block">
                                    <img src="{{ asset('storage/' . $team->image) . '?v=' . (optional($team->updated_at)->timestamp ?? time()) }}" alt="{{ $team->name }}" style="width:100%;height:240px;object-fit:cover;border-radius:10px;">
                                </a>
                                <div class="pt-3">
                                    <h3 class="h5 mb-1">
                                        <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}" style="color:#0f172a;text-decoration:none;">
                                            {{ $team->name }}
                                        </a>
                                    </h3>
                                    <p class="mb-2" style="color:#03A4FC;font-weight:600;">{{ $team->position }}</p>
                                    <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}" class="link-btn style2">
                                        <i class="fas fa-plus-circle me-1"></i>View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
