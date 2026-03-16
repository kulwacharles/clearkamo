
<div>
    <div class="breadcumb-wrapper" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="breadcumb-shape1">
            <img src="assets/img/shape/breadcrumb-shape1.svg" alt="img">
        </div>
        <div class="breadcumb-shape2">
            <img src="assets/img/shape/breadcrumb-shape2.svg" alt="img">
        </div>
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Our Publications</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Publications</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="space-top space-extra-bottom">
        <div class="container">
            @if($publications && $publications->count() > 0)
                <div class="row g-4">
                    @foreach ($publications as $publication)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ $publication->link }}" target="_blank" rel="noopener noreferrer" class="pub-card d-block text-decoration-none">
                            <div class="pub-card-img">
                                <img src="{{ asset('storage/'.$publication->image) }}" alt="{{ $publication->title }}" loading="lazy">
                            </div>
                            <div class="pub-card-body">
                                <h6 class="pub-card-title">{{ $publication->title }}</h6>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="th-pagination mt-5">
                    {{ $publications->links() }}
                </div>
            @else
                <p class="text-center py-5">No publications available.</p>
            @endif
        </div>
    </section>

    <style>
        .pub-card { border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; transition: box-shadow .2s; }
        .pub-card:hover { box-shadow: 0 4px 18px rgba(0,0,0,.12); }
        .pub-card-img { width: 100%; height: 160px; overflow: hidden; }
        .pub-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s; }
        .pub-card:hover .pub-card-img img { transform: scale(1.06); }
        .pub-card-body { padding: 10px 12px; background: #fff; }
        .pub-card-title { font-size: .9rem; font-weight: 600; color: #1f2937; margin: 0; line-height: 1.4; }
    </style>
</div>

