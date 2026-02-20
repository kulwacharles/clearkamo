
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
                <h1 class="breadcumb-title">Work With Us</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Vacancies</li>
                </ul>
            </div>
        </div>
    </div>
    
    <section class="th-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-40">
                 @if($vacancies)
                <div class="col-xxl-8 col-lg-7">
                     @foreach ($vacancies as $vacancie)
                    <div class="service-card-horizontal d-flex align-items-stretch mb-4" style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                        <div class="service-image-wrapper" style="width: 260px; min-width: 260px; overflow: hidden;">
                            <a wire:navigate href="/vacancy/details/{{ $vacancie->slug }}" class="d-block h-100">
                                <img src="{{ asset('storage/'.$vacancie->image) }}" alt="{{ $vacancie->title }}" class="w-100 h-100" style="object-fit: cover;">
                            </a>
                        </div>
                        <div class="service-content flex-grow-1 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="blog-meta mb-2">
                                    <a class="author" wire:navigate href="/vacancy/details/{{ $vacancie->slug }}">
                                        <i class="far fa-user"></i>Publicated by Admin
                                    </a>
                                    <a wire:navigate href="/vacancy/details/{{ $vacancie->slug }}">
                                        <i class="fa-light fa-calendar-days"></i>{{ $vacancie->created_at->format('d F, Y') }}
                                    </a>
                                </div>
                                <h2 class="blog-title mb-3">
                                    <a wire:navigate href="/vacancy/details/{{ $vacancie->slug }}">{{ $vacancie->title }}</a>
                                </h2>
                                <p class="blog-text mb-3">
                                     {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($vacancie->description)), 240, '...') }}
                                </p>
                            </div>
                            <a wire:navigate href="/vacancy/details/{{ $vacancie->slug }}" class="th-btn">Read More
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-up-right ms-3"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="th-pagination">
                        {{ $vacancies->links() }}
                    </div>
                </div>
                @else
                <div class="col-xxl-8 col-lg-7">
                    There is no Vacancies
                </div>
                @endif
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        {{-- <div class="widget widget_search">
                            <form class="search-form">
                                <input type="text" placeholder="Enter Keyword"> 
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div> --}}
                         <div class="widget widget_categories">
                            <h3 class="widget_title">Contract Type</h3>
                            <ul>
                                <li>
                                    <a href="#" wire:click.prevent="setContractFilter('all')" class="{{ $selectedContract === 'all' ? 'fw-bold' : '' }}">
                                        All Contracts
                                    </a>
                                    <span>({{ $contractTypes->sum('total') }})</span>
                                </li>
                                @foreach($contractTypes as $contractType)
                                    <li>
                                        <a href="#" wire:click.prevent="setContractFilter('{{ $contractType->contract }}')" class="{{ $selectedContract === $contractType->contract ? 'fw-bold' : '' }}">
                                            {{ $contractType->contract }}
                                        </a>
                                        <span>({{ $contractType->total }})</span>
                                    </li>
                                @endforeach
                            </ul>
                         </div>
                        

                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>
