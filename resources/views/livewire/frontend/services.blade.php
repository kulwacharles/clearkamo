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
                <h1 class="breadcumb-title">Our Services</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Services</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="th-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                @if($services)
                <div class="col-12">
                     @foreach ($services as $service)
                    <div class="service-card-horizontal d-flex align-items-stretch mb-4" style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s ease; cursor: pointer;" 
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)';">
                        <div class="service-image-wrapper" style="width: 280px; overflow: hidden;">
                            <a wire:navigate href="/service/details/{{ $service->slug }}" class="d-block h-100">
                                <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;"
                                     onmouseover="this.style.transform='scale(1.05)';"
                                     onmouseout="this.style.transform='scale(1)';">
                            </a>
                        </div>
                        <div class="service-content flex-grow-1 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h2 class="service-title mb-3" style="font-size: 1.5rem; font-weight: 600; color: #1f2937; line-height: 1.3;">
                                    <a wire:navigate href="/service/details/{{ $service->slug }}" style="color: inherit; text-decoration: none; transition: color 0.3s ease;"
                                       onmouseover="this.style.color='#03A4FC';"
                                       onmouseout="this.style.color='inherit';">{{ $service->title }}</a>
                                </h2>
                                <p class="service-description mb-4" style="font-size: 1rem; color: #6b7280; line-height: 1.6;">
                                    {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($service->description)), 200, '...') }}
                                </p>
                            </div>
                            <div>
                                <a wire:navigate href="/service/details/{{ $service->slug }}" class="th-btn style-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #03A4FC, #03A4FC); color: white; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;"
                                   onmouseover="this.style.background='linear-gradient(135deg, #03A4FC, #03A4FC)'; this.style.transform='translateX(4px)';"
                                   onmouseout="this.style.background='linear-gradient(135deg, #03A4FC, #03A4FC)'; this.style.transform='translateX(0)';">
                                    Read More
                                    <i class="fa-solid fa-arrow-up-right" style="font-size: 14px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="th-pagination">
                        {{ $services->links() }}
                    </div>
                </div>
                @else
                <div class="col-12 text-center">
                    There is no Publications
                </div>
                @endif

            </div>
        </div>
    </section>
</div>
