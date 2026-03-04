<div>
    <div class="breadcumb-wrapper" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="breadcumb-shape1"><img src="assets/img/shape/breadcrumb-shape1.svg" alt="img"></div>
        <div class="breadcumb-shape2"><img src="assets/img/shape/breadcrumb-shape2.svg" alt="img"></div>
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Search</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Search Results</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="widget widget_search mb-4">
                        <form wire:submit.prevent="runSearch" class="search-form">
                            <input type="text" placeholder="Search across all site content..." wire:model.live.debounce.250ms="q">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>

                    <div class="mb-4">
                        <h4>Results for "{{ $q }}"</h4>
                        <p class="text-muted mb-0">{{ count($results) }} result(s) found</p>
                    </div>

                    @forelse($results as $result)
                        <div class="th-blog blog-single mb-3" style="border:1px solid #e5e7eb;border-radius:12px;padding:18px;background:#fff;">
                            <div class="blog-content p-0">
                                <div class="blog-meta mb-2">
                                    <span class="badge" style="background:rgba(3,164,252,0.15);color:#03A4FC;border-radius:999px;padding:4px 10px;">{{ $result['type'] }}</span>
                                    @if(!empty($result['updated_at']))
                                        <span><i class="fa-light fa-calendar-days"></i> {{ $result['updated_at'] }}</span>
                                    @endif
                                </div>
                                <h3 class="blog-title mb-2" style="font-size:24px;">
                                    <a wire:navigate href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                                </h3>
                                <p class="blog-text mb-2">{{ $result['snippet'] }}</p>
                                <a wire:navigate href="{{ $result['url'] }}" class="th-btn">
                                    Open
                                    <div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            No matching content found. Try another keyword.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
