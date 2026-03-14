{{-- @section('title',$title)
@section('description',$seodescription)
@section('keywords',$keywords) --}}
<div>
    <!-- Hero Slider Section -->
    @if($slides && $slides->count() > 0)
    <section class="hero-slider-section" style="position: relative; overflow: hidden; background: linear-gradient(135deg, #03A4FC 0%, #03A4FC 100%);">
        <!-- Animated Background Elements -->
        <div class="slider-bg-animation" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;">
            <div class="floating-shapes">
                <div class="shape shape-1" style="position: absolute; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%; top: 10%; left: 10%; animation: float 6s ease-in-out infinite;"></div>
                <div class="shape shape-2" style="position: absolute; width: 120px; height: 120px; background: rgba(255,255,255,0.05); border-radius: 50%; top: 60%; right: 15%; animation: float 8s ease-in-out infinite reverse;"></div>
                <div class="shape shape-3" style="position: absolute; width: 60px; height: 60px; background: rgba(255,255,255,0.08); border-radius: 50%; bottom: 20%; left: 20%; animation: float 7s ease-in-out infinite 2s;"></div>
                <div class="shape shape-4" style="position: absolute; width: 100px; height: 100px; background: rgba(255,255,255,0.06); border-radius: 50%; top: 30%; right: 30%; animation: float 9s ease-in-out infinite 1s;"></div>
            </div>
        </div>
        
        <div class="slider-wrapper" style="position: relative; height: 600px; z-index: 2;">
            <div id="mainSlider" class="main-slider" style="position: relative; height: 100%;">
                @foreach($slides as $index => $slide)
                    <div class="slider-slide" style="position: absolute; top: 0; left: 0; width: 100%; height: 600px; background-size: cover; background-position: center; opacity: 0; transition: opacity 0.8s ease-in-out;">
                        @if($slide->image)
                            <div class="slider-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('storage/'.$slide->image) }}'); background-size: cover; background-position: center; background-blend-mode: overlay; background-color: rgba(0,0,0,0.4);"></div>
                            <!-- Gradient Overlay -->
                            <div class="gradient-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(3,164,252,0.3) 0%, rgba(3,164,252,0.2) 50%, rgba(0,0,0,0.5) 100%);"></div>
                        @endif
                        <div class="slider-content" style="position: relative; z-index: 2; height: 100%; display: flex; align-items: flex-end; justify-content: center; padding-bottom: 120px;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 mx-auto text-center">
                                        <div class="slider-text" style="color: white; animation: fadeInUp 1.2s ease-out;">
                                            <div class="slider-cta" style="margin-top: 30px;">
                                                <a href="{{ route('services') }}" class="slider-btn" style="display: inline-block; background: linear-gradient(135deg, #03A4FC 0%, #03A4FC 100%); color: white; padding: 15px 40px; border-radius: 50px; font-size: 1rem; font-weight: 600; text-decoration: none; box-shadow: 0 10px 30px rgba(3,164,252,0.4); transform: translateY(0); transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;">
                                                    Explore Our Services
                                                    <i class="fas fa-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Enhanced Navigation -->
            <button id="sliderPrev" class="slider-nav-btn slider-prev" style="position: absolute; left: 40px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.95); color: #333; border: none; width: 60px; height: 60px; border-radius: 50%; cursor: pointer; z-index: 10; transition: all 0.4s ease; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.2); backdrop-filter: blur(10px);">
                <i class="fas fa-chevron-left" style="font-size: 20px;"></i>
            </button>
            <button id="sliderNext" class="slider-nav-btn slider-next" style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.95); color: #333; border: none; width: 60px; height: 60px; border-radius: 50%; cursor: pointer; z-index: 10; transition: all 0.4s ease; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,0,0,0.2); backdrop-filter: blur(10px);">
                <i class="fas fa-chevron-right" style="font-size: 20px;"></i>
            </button>
            
            <!-- Enhanced Indicators -->
            <div class="slider-indicators" style="position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); z-index: 10; display: flex; gap: 15px; padding: 15px 25px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50px;">
                @foreach($slides as $index => $slide)
                    <button class="slider-indicator" data-slide="{{ $index }}" style="width: 14px; height: 14px; border-radius: 50%; border: 2px solid white; background: transparent; cursor: pointer; transition: all 0.4s ease; position: relative;"></button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Enhanced Hero Slider Styles and JavaScript with Auto-Play -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            33% {
                transform: translateY(-20px) rotate(120deg);
            }
            66% {
                transform: translateY(20px) rotate(240deg);
            }
        }
        
        .slider-slide.active {
            opacity: 1 !important;
            z-index: 2;
        }
        
        .slider-indicator.active {
            background: white !important;
            transform: scale(1.3);
            box-shadow: 0 0 15px rgba(255,255,255,0.8);
        }
        
        .slider-nav-btn:hover {
            background: linear-gradient(135deg, #03A4FC 0%, #03A4FC 100%) !important;
            color: white !important;
            transform: translateY(-50%) scale(1.1);
        }
        
        .slider-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(3,164,252,0.6);
        }
    </style>

    <script>
    (function() {
        'use strict';
        
        // Initialize slider immediately and also wait for DOM ready
        initSlider();
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSlider);
        }
        
        // Also initialize after Livewire updates
        if (typeof Livewire !== 'undefined') {
            Livewire.hook('component.initialized', component => {
                if (component.name === 'home') {
                    setTimeout(initSlider, 100);
                }
            });
        }
        
        function initSlider() {
            const mainSlider = document.getElementById('mainSlider');
            if (!mainSlider) return;
            
            const slides = mainSlider.querySelectorAll('.slider-slide');
            const prevBtn = document.getElementById('sliderPrev');
            const nextBtn = document.getElementById('sliderNext');
            const indicators = document.querySelectorAll('.slider-indicator');
            
            if (slides.length === 0) return;
            
            let currentSlide = 0;
            const totalSlides = slides.length;
            let autoPlayInterval;
            const autoPlayDelay = 5000;
            
            slides[0].classList.add('active');
            slides[0].style.opacity = '1';
            if (indicators[0]) {
                indicators[0].classList.add('active');
            }
            
            function showSlide(index) {
                slides[currentSlide].classList.remove('active');
                slides[currentSlide].style.opacity = '0';
                
                if (indicators[currentSlide]) {
                    indicators[currentSlide].classList.remove('active');
                }
                
                currentSlide = index;
                
                slides[currentSlide].classList.add('active');
                slides[currentSlide].style.opacity = '1';
                
                if (indicators[currentSlide]) {
                    indicators[currentSlide].classList.add('active');
                }
            }
            
            function nextSlide() {
                const next = (currentSlide + 1) % totalSlides;
                showSlide(next);
            }
            
            function prevSlide() {
                const prev = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(prev);
            }
            
            function startAutoPlay() {
                stopAutoPlay();
                autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
            }
            
            function stopAutoPlay() {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                    autoPlayInterval = null;
                }
            }
            
            function resetAutoPlay() {
                stopAutoPlay();
                startAutoPlay();
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    prevSlide();
                    resetAutoPlay();
                });
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    nextSlide();
                    resetAutoPlay();
                });
            }
            
            indicators.forEach(function(indicator, index) {
                indicator.addEventListener('click', function() {
                    showSlide(index);
                    resetAutoPlay();
                });
            });
            
            mainSlider.addEventListener('mouseenter', stopAutoPlay);
            mainSlider.addEventListener('mouseleave', startAutoPlay);
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                    resetAutoPlay();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                    resetAutoPlay();
                }
            });
            
            let touchStartX = 0;
            let touchEndX = 0;
            
            mainSlider.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            
            mainSlider.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });
            
            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                    resetAutoPlay();
                }
            }
            
            startAutoPlay();
        }
    })();
    </script>
    @endif
    
    @if($about)
    <div class="space" id="about-sec">
        <div class="container">
            <div class="row align-items-start gy-4">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-media-stack">
                        <div class="about-media-main">
                            <img src="{{ asset('storage/'.$about->image) }}" alt="About us main image">
                        </div>
                        @if(!empty($about->image2))
                            <div class="about-media-secondary d-none d-lg-block">
                                <img src="{{ asset('storage/'.$about->image2) }}" alt="About us supporting image">
                            </div>
                        @endif
                    </div>
                    <div class="mission-vision-core-values about-mission-left" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 30px; border-radius: 15px; border-left: 4px solid #03A4FC;">
                        <div class="mb-4">
                            <h4 class="text-primary mb-3" style="font-weight: 600; font-size: 1.1rem;">
                                <i class="fas fa-bullseye me-2"></i>Mission
                            </h4>
                            <p style="color: #64748b; line-height: 1.6; margin-bottom: 0;">To apply decision science and systems design to help organizations define long-term strategies and translate them into clear, executable decisions that deliver reliable results under real-world conditions.</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-primary mb-3" style="font-weight: 600; font-size: 1.1rem;">
                                <i class="fas fa-eye me-2"></i>Vision
                            </h4>
                            <p style="color: #64748b; line-height: 1.6; margin-bottom: 0;">To be partner of choice for organizations seeking dependable execution and sustained results.</p>
                        </div>
                        <div>
                            <h4 class="text-primary mb-3" style="font-weight: 600; font-size: 1.1rem;">
                                <i class="fas fa-gem me-2"></i>Core Values
                            </h4>
                            <p style="color: #64748b; line-height: 1.6; margin-bottom: 0;">Community/Customer-centred; Local relevance with global reach; Evidence-based practice; Accountable results; Responsible innovation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="title-area mb-30">
                        <span class="sub-title text-primary">
                            <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                            WHO WE ARE
                            <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                        </span>
                        <h3 class="sec-title">{{ $about->title }}</h3>
                        <p class="sec-text">{!! $about->description !!}</p>
                    </div>
                    <div class="row gy-40">
                        <div class="col-lg-8">
                            @if($aboutVideoEmbedUrl)
                                <div class="about-video-wrap about-video-inline">
                                    <iframe
                                        src="{{ $aboutVideoEmbedUrl }}"
                                        title="ClearKamo video"
                                        loading="lazy"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            @else
                                <div class="about-video-wrap about-video-inline about-video-placeholder d-flex align-items-center justify-content-center">
                                    <span>Add YouTube URL in admin About Us to display video.</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <div class="year-counter style2 about-year-inline" style="background: linear-gradient(135deg, #03A4FC 0%, #03A4FC 100%); padding: 40px 30px; border-radius: 15px; text-align: center; color: white;">
                                <div class="year-counter_number">
                                    <span class="counter-number" style="font-size: 3rem; font-weight: 700; color: white;">{{ $about->ex_years ?? 25 }}</span>
                                </div>
                                <p class="year-counter_text" style="color: white; margin: 0; font-size: 1.1rem;">Years Of Experience</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="btn-wrap style2 mt-50">
                        <div class="about-grid style2">
                            <div class="thumb">
                                <img class="about-grid_thumb" src="assets/img/normal/client-group-1.png" alt="about">
                            </div>
                            <div class="details">
                                <p class="about-grid_number">
                                    <span class="counter-number">1500</span>+
                                </p>
                                <p class="about-grid_text">Active Reviews</p>
                            </div>
                        </div>
                        <a href="about.html" class="th-btn btn-primary">Read More
                            <div class="icon">
                                <i class="fa-solid fa-arrow-up-right ms-3"></i>
                            </div>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>

        <style>
            #about-sec .about-media-stack {
                position: relative;
                max-width: 520px;
                margin: 0 auto;
                padding-bottom: 0;
            }

            #about-sec .about-media-main img {
                width: 100%;
                height: 380px;
                object-fit: cover;
                border-radius: 14px;
                box-shadow: 0 16px 28px rgba(15, 23, 42, 0.14);
            }

            #about-sec .about-media-secondary {
                position: absolute;
                right: -20px;
                bottom: 0;
                width: 58%;
                z-index: 2;
                animation: aboutFloat 5s ease-in-out infinite;
            }

            #about-sec .about-media-secondary img {
                width: 100%;
                height: 180px;
                object-fit: cover;
                border-radius: 12px;
                box-shadow: 0 12px 24px rgba(15, 23, 42, 0.16);
                border: 4px solid #ffffff;
            }

            #about-sec .about-video-wrap {
                width: 100%;
                max-width: 520px;
                margin: 16px auto 0;
                aspect-ratio: 16 / 9;
                border-radius: 14px;
                overflow: hidden;
                box-shadow: 0 14px 30px rgba(15, 23, 42, 0.16);
                background: #0f172a;
            }

            #about-sec .about-video-wrap iframe {
                width: 100%;
                height: 100%;
                border: 0;
                display: block;
            }

            #about-sec .about-video-wrap.about-video-inline {
                max-width: 100%;
                margin: 0;
                min-height: 260px;
            }

            #about-sec .about-mission-left {
                max-width: 520px;
                margin: 16px auto 0;
            }

            #about-sec .about-year-inline {
                min-height: 220px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            #about-sec .about-video-placeholder {
                color: #64748b;
                font-size: 0.95rem;
                text-align: center;
                padding: 16px;
                background: #f1f5f9;
            }

            @keyframes aboutFloat {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-10px);
                }
            }

            @media (max-width: 1199.98px) {
                #about-sec .about-media-stack {
                    max-width: 460px;
                }

                #about-sec .about-media-main img {
                    height: 320px;
                }

                #about-sec .about-video-wrap {
                    max-width: 460px;
                }

                #about-sec .about-mission-left {
                    max-width: 460px;
                }
            }

            @media (max-width: 991.98px) {
                #about-sec .about-media-stack {
                    max-width: 420px;
                    padding-bottom: 0;
                    margin-bottom: 8px;
                }

                #about-sec .about-media-main img {
                    height: 260px;
                }

                #about-sec .about-video-wrap {
                    max-width: 420px;
                }

                #about-sec .about-video-wrap.about-video-inline {
                    margin-top: 6px;
                    min-height: 0;
                }

                #about-sec .about-mission-left {
                    max-width: 420px;
                }

                #about-sec .about-year-inline {
                    min-height: 0;
                }
            }

            @media (max-width: 575.98px) {
                #about-sec .about-media-stack {
                    max-width: 100%;
                }

                #about-sec .about-media-main img {
                    height: 210px;
                }

                #about-sec .about-video-wrap {
                    max-width: 100%;
                    margin-top: 12px;
                    border-radius: 12px;
                }

                #about-sec .about-video-wrap.about-video-inline {
                    margin-top: 8px;
                }

                #about-sec .about-mission-left {
                    max-width: 100%;
                }
            }
        </style>
    </div>
    @endif

    <section class="space-top space-bottom" id="focus-sec">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                    Our Focus Areas
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
                <p class="mx-auto" style="max-width: 980px;">
                    At CLEARKAMO, we strengthen execution performance in complex systems and help organizations convert strategic intent into reliable, measurable results.
                </p>
            </div>

            @if($focusAreas && $focusAreas->count())
            <div class="row g-4">
                @foreach($focusAreas as $index => $area)
                    <div class="col-xl-4 col-md-6">
                        <article class="focus-card h-100">
                            {{-- Photo banner (when an image is uploaded) --}}
                            @if($area->image)
                                <div class="focus-card-img">
                                    <img src="{{ asset('storage/'.$area->image) }}" alt="{{ $area->title }}">
                                    <span class="focus-card-number-overlay">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            @else
                            <div class="focus-card-top">
                                <span class="focus-card-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="focus-card-icon">
                                    <i class="fas {{ $area->icon ?? 'fa-star' }}"></i>
                                </span>
                            </div>
                            @endif
                            <h3 class="focus-card-title">{{ $area->title }}</h3>
                            <p class="focus-card-summary">{{ $area->summary }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <style>
            #focus-sec .focus-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 12px 26px rgba(15, 23, 42, 0.08);
                transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
                display: flex;
                flex-direction: column;
            }

            #focus-sec .focus-card:hover {
                transform: translateY(-4px);
                border-color: rgba(3, 164, 252, 0.45);
                box-shadow: 0 16px 30px rgba(3, 164, 252, 0.18);
            }

            /* Photo banner */
            #focus-sec .focus-card-img {
                position: relative;
                width: 100%;
                height: 200px;
                overflow: hidden;
            }

            #focus-sec .focus-card-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            #focus-sec .focus-card-number-overlay {
                position: absolute;
                top: 12px;
                left: 12px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 700;
                color: #ffffff;
                background: #03A4FC;
            }

            /* Icon-only header (no image) */
            #focus-sec .focus-card-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 14px;
                padding: 22px 22px 0;
            }

            #focus-sec .focus-card-number {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 10px;
                font-size: 15px;
                font-weight: 700;
                color: #ffffff;
                background: #03A4FC;
            }

            #focus-sec .focus-card-icon {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: rgba(3, 164, 252, 0.13);
                color: #03A4FC;
                font-size: 20px;
            }

            #focus-sec .focus-card-title {
                font-size: 1.1rem;
                line-height: 1.3;
                margin-bottom: 10px;
                color: #0f172a;
                padding: 16px 22px 0;
                font-weight: 700;
            }

            /* When there's no image the top-padding is already set by .focus-card-top */
            #focus-sec .focus-card:has(.focus-card-top) .focus-card-title {
                padding-top: 0;
            }

            #focus-sec .focus-card-summary {
                color: #334155;
                margin-bottom: 20px;
                padding: 0 22px 22px;
                flex-grow: 1;
            }

            @media (max-width: 575.98px) {
                #focus-sec .focus-card-img {
                    height: 180px;
                }
                #focus-sec .focus-card-title {
                    font-size: 1rem;
                }
            }
        </style>
    </section>

    <!-- Rest of your sections... I'll continue with the main ones -->
    <section class="space overflow-hidden bg-smoke2" id="service-sec">
        <div class="shape-mockup moving" data-top="0" data-left="0">
            <img src="assets/img/shape/service-bg-shape4-1.png" alt="shape">
        </div>
        <div class="shape-mockup movingX" data-bottom="0" data-right="0">
            <img src="assets/img/shape/service-bg-shape4-2.png" alt="shape">
        </div>
        <div class="why-sec-1 overflow-hidden" data-bg-src="assets/img/shape/why-shape-1-1.svg"></div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="title-area text-center">
                        <span class="sub-title">
                            <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                            Our Services
                            <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                        </span>
                        <h2 class="sec-title">Beyond Boundaries Into Success</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-30 gx-30 justify-content-center">
                @if($services)
                    @foreach ($services as $key => $service)
                       <div class="col-xl-3 col-md-6">
                        <div class="service-card4">
                            <div class="service-card-thumb">
                                <img src="{{ url('/storage/'.$service->image) }}" alt="img" style="width: 400px;height:250px">
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">
                                    <a wire:navigate href="/service/details/{{ $service->slug }}">{{ $service->title }}</a>
                                </h3>
                                <p class="box-text">
                                    {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($service->description)), 160, '...') }}
                                </p>
                                <div class="btn-wrap">
                                    <a  wire:navigate href="/service/details/{{ $service->slug }}" class="link-btn style2">
                                        <i class="fas fa-plus-circle me-1"></i>Read More
                                    </a>
                                    <div class="service-card-num">
                                        <span>{{ str_pad($key+1, 2, "0", STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div> 
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    @if($clients && $clients->count() > 0)
    <section class="space-top space-bottom" id="clients-sec" style="background: #f8fafc;">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">OUR CLIENTS
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
                <h2 class="sec-title">Trusted By Leading Organizations</h2>
                <p class="mx-auto" style="max-width: 760px;">
                    We partner with institutions and businesses to deliver practical, measurable impact.
                </p>
            </div>

            @php
                $scrollDuration = max(18, $clients->count() * 4);
            @endphp
            <div class="clients-marquee" style="--clients-scroll-duration: {{ $scrollDuration }}s;">
                <div class="clients-track">
                    @foreach($clients as $client)
                        <a
                            href="{{ $client->url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="client-card d-flex flex-column justify-content-center align-items-center text-center"
                        >
                            <div class="client-logo-wrap">
                                <img
                                    src="{{ asset('storage/'.$client->image) }}"
                                    alt="{{ $client->name }}"
                                    class="client-logo"
                                >
                            </div>
                            <h3 class="client-name">{{ $client->name }}</h3>
                        </a>
                    @endforeach

                    @foreach($clients as $client)
                        <a
                            href="{{ $client->url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-hidden="true"
                            tabindex="-1"
                            class="client-card d-flex flex-column justify-content-center align-items-center text-center"
                        >
                            <div class="client-logo-wrap">
                                <img
                                    src="{{ asset('storage/'.$client->image) }}"
                                    alt="{{ $client->name }}"
                                    class="client-logo"
                                >
                            </div>
                            <h3 class="client-name">{{ $client->name }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <style>
            #clients-sec .clients-marquee {
                position: relative;
                overflow: hidden;
                width: 100%;
                padding: 10px 0;
            }

            #clients-sec .clients-marquee::before,
            #clients-sec .clients-marquee::after {
                content: "";
                position: absolute;
                top: 0;
                width: 90px;
                height: 100%;
                z-index: 2;
                pointer-events: none;
            }

            #clients-sec .clients-marquee::before {
                left: 0;
                background: linear-gradient(to right, #f8fafc 35%, rgba(248, 250, 252, 0));
            }

            #clients-sec .clients-marquee::after {
                right: 0;
                background: linear-gradient(to left, #f8fafc 35%, rgba(248, 250, 252, 0));
            }

            #clients-sec .clients-track {
                display: flex;
                align-items: stretch;
                gap: 20px;
                width: max-content;
                animation: clients-scroll var(--clients-scroll-duration) linear infinite;
            }

            #clients-sec .client-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                padding: 24px 20px;
                text-decoration: none;
                box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
                transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
                flex: 0 0 230px;
                min-height: 170px;
            }

            #clients-sec .client-card:hover {
                transform: translateY(-6px);
                border-color: rgba(3, 164, 252, 0.45);
                box-shadow: 0 18px 30px rgba(3, 164, 252, 0.2);
            }

            #clients-sec .client-logo-wrap {
                width: 100%;
                height: 96px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 14px;
            }

            #clients-sec .client-logo {
                max-width: 170px;
                max-height: 86px;
                width: auto;
                height: auto;
                object-fit: contain;
                transition: transform .2s ease;
            }

            #clients-sec .client-card:hover .client-logo {
                transform: scale(1.04);
            }

            #clients-sec .client-name {
                margin: 0;
                font-size: 1rem;
                line-height: 1.4;
                color: #0f172a;
                font-weight: 600;
            }

            #clients-sec .clients-marquee:hover .clients-track {
                animation-play-state: paused;
            }

            @keyframes clients-scroll {
                from {
                    transform: translateX(0);
                }
                to {
                    transform: translateX(calc(-50% - 10px));
                }
            }
        </style>
    </section>
    @endif

    @if($teams && $teams->count() > 0)
    <section class="space-top" id="team-sec">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">OUR TEAM
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
                <h2 class="sec-title">Meet Our Team</h2>
            </div>
            <div class="row gy-30">
                @foreach($teams as $team)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="team-card p-3 h-100" style="border: 1px solid #e5e7eb; border-radius: 14px; background: #fff; box-shadow: 0 8px 22px rgba(15, 23, 42, 0.08);">
                            <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}" class="d-block">
                                <img
                                    src="{{ asset('storage/'.$team->image) }}"
                                    alt="{{ $team->name }}"
                                    style="width: 100%; height: 260px; object-fit: cover; border-radius: 10px;"
                                >
                            </a>
                            <div class="pt-3">
                                <h3 class="h5 mb-1">
                                    <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}" style="color: #0f172a; text-decoration: none;">
                                        {{ $team->name }}
                                    </a>
                                </h3>
                                <p class="mb-2" style="color: #03A4FC; font-weight: 600;">{{ $team->position }}</p>
                                <p class="mb-3" style="color: #64748b;">
                                    {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($team->description)), 110, '...') }}
                                </p>
                                <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}" class="link-btn style2">
                                    <i class="fas fa-plus-circle me-1"></i>View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="overflow-hidden space-top" id="testimonials">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title">
                <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">TESTIMONIAL
                <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
            </span>
            <h2 class="sec-title">What Clients Say About Us</h2>
        </div>
        <div class="slider-area testi-grid-area">
            <div class="swiper th-slider" id="testiSlide1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1356":{"slidesPerView":"3"}}}'>
                <div class="swiper-wrapper">
                    @if($testimonies)
                        @foreach ($testimonies as $testimony)
                            <div class="swiper-slide">
                                <div class="testi-card-3">
                                    <div class="testi-card-thumb">
                                        <img class="avatar" src="{{ asset('storage/'.$testimony->image) }}" alt="img">
                                        <div class="quote-icon">
                                            <img src="assets/img/icon/quote2.svg" alt="icon">
                                        </div>
                                    </div>
                                    <div class="testi-card-details">
                                        <p class="testi-card_text">
                                            {!! $testimony->description !!}
                                        </p>
                                        <div class="testi-card_profile">
                                            <div class="testi-card_content">
                                                <h3 class="testi-card_name">{{$testimony->name}}</h3>
                                                <span class="testi-card_desig">{{$testimony->position}}</span>
                                            </div>
                                        </div>
                                        <div class="testi-card_review">
                                            <i class="fa-sharp fa-solid fa-star"></i>
                                            <i class="fa-sharp fa-solid fa-star"></i>
                                            <i class="fa-sharp fa-solid fa-star"></i>
                                            <i class="fa-sharp fa-solid fa-star"></i>
                                            <i class="fa-sharp fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            
                    @else
                    N
                    @endif
                </div>
                <div class="slider-pagination">

                </div>
            </div>
        </div>
    </div>
</section>

</div>
