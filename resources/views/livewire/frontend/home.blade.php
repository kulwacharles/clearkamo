{{-- @section('title',$title)
@section('description',$seodescription)
@section('keywords',$keywords) --}}
<div id="ck-home">
<style>
    /* Reduce section spacing on the home page */
    #ck-home { --section-space: 70px; --section-space-mobile: 45px; }
    @media (max-width: 575px) { #ck-home { --section-space-mobile: 30px; } }
</style>
    <!-- Hero Slider Section -->
    @if($slides && $slides->count() > 0)
    <section id="hero-sec">
        <div id="mainSlider" class="hero-slider">
            @foreach($slides as $index => $slide)
                <div class="hero-slide{{ $index === 0 ? ' active' : '' }}">
                    {{-- Pure background photo — no overlay, no text --}}
                    @if($slide->image)
                        <div class="hero-slide-bg" style="background-image: url('{{ asset('storage/'.$slide->image) }}');"></div>
                    @endif
                    {{-- Subtle bottom vignette for controls readability only --}}
                    <div class="hero-slide-vignette"></div>
                    {{-- Progress bar --}}
                    <div class="hero-progress{{ $index === 0 ? ' running' : '' }}"></div>
                </div>
            @endforeach
        </div>

        {{-- Prev / Next arrows --}}
        <button id="sliderPrev" class="hero-nav hero-nav-prev" aria-label="Previous slide">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="sliderNext" class="hero-nav hero-nav-next" aria-label="Next slide">
            <i class="fas fa-chevron-right"></i>
        </button>

        {{-- Dot indicators --}}
        <div class="hero-dots">
            @foreach($slides as $index => $slide)
                <button class="hero-dot{{ $index === 0 ? ' active' : '' }}" data-slide="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </section>

    <style>
        /* ── Hero Section — pure image slideshow ─────────────────── */
        #hero-sec {
            position: relative;
            overflow: hidden;
        }

        .hero-slider {
            position: relative;
            height: 100svh;
            min-height: 540px;
            max-height: 900px;
        }

        /* Each slide */
        .hero-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease, visibility 1s ease;
            overflow: hidden;
        }
        .hero-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 2;
        }

        /* Background photo — fills frame, subtle Ken Burns on active */
        .hero-slide-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transform: scale(1.04);
            transition: transform 7s ease;
        }
        .hero-slide.active .hero-slide-bg {
            transform: scale(1);
        }

        /* Very subtle bottom vignette — only to keep controls legible */
        .hero-slide-vignette {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(0,0,0,.35) 0%,
                rgba(0,0,0,.08) 22%,
                transparent     50%
            );
            pointer-events: none;
        }

        /* Progress bar at bottom of slide */
        .hero-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 0;
            background: #03A4FC;
            z-index: 5;
        }
        .hero-progress.running {
            animation: heroProgress 5s linear forwards;
        }
        @keyframes heroProgress {
            from { width: 0; }
            to   { width: 100%; }
        }

        /* Navigation arrows */
        .hero-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 52px; height: 52px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.88);
            color: #0f172a;
            font-size: 18px;
            box-shadow: 0 4px 18px rgba(0,0,0,.22);
            backdrop-filter: blur(6px);
            transition: background .2s ease, color .2s ease, transform .2s ease, box-shadow .2s ease;
        }
        .hero-nav:hover {
            background: #03A4FC;
            color: #fff;
            transform: translateY(-50%) scale(1.08);
            box-shadow: 0 8px 24px rgba(3,164,252,.45);
        }
        .hero-nav-prev { left: 24px; }
        .hero-nav-next { right: 24px; }

        /* Dot indicators */
        .hero-dots {
            position: absolute;
            bottom: 22px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            gap: 8px;
        }
        .hero-dot {
            width: 9px; height: 9px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,.8);
            background: transparent;
            cursor: pointer;
            transition: all .3s ease;
            padding: 0;
        }
        .hero-dot.active {
            background: #fff;
            border-color: #fff;
            width: 26px;
            border-radius: 5px;
        }

        /* Mobile */
        @media (max-width: 767.98px) {
            .hero-slider { height: 88svh; min-height: 420px; }
            .hero-nav { width: 40px; height: 40px; font-size: 15px; }
            .hero-nav-prev { left: 10px; }
            .hero-nav-next { right: 10px; }
        }
    </style>

    <script>
    (function() {
        'use strict';
        function initSlider() {
            const slider = document.getElementById('mainSlider');
            if (!slider) return;
            const slides     = slider.querySelectorAll('.hero-slide');
            const progresses = slider.querySelectorAll('.hero-progress');
            const dots       = document.querySelectorAll('.hero-dot');
            const prevBtn    = document.getElementById('sliderPrev');
            const nextBtn    = document.getElementById('sliderNext');
            if (!slides.length) return;

            let current = 0;
            let timer   = null;
            const DELAY = 5000;

            function go(idx) {
                slides[current].classList.remove('active');
                progresses[current].classList.remove('running');
                dots[current] && dots[current].classList.remove('active');

                // Force reflow so CSS animation restarts
                void progresses[idx].offsetWidth;

                current = idx;
                slides[current].classList.add('active');
                progresses[current].classList.add('running');
                dots[current] && dots[current].classList.add('active');
            }

            function next() { go((current + 1) % slides.length); }
            function prev() { go((current - 1 + slides.length) % slides.length); }

            function start() { timer = setInterval(next, DELAY); }
            function stop()  { clearInterval(timer); }
            function reset() { stop(); start(); }

            prevBtn && prevBtn.addEventListener('click', () => { prev(); reset(); });
            nextBtn && nextBtn.addEventListener('click', () => { next(); reset(); });
            dots.forEach((dot, i) => dot.addEventListener('click', () => { go(i); reset(); }));

            slider.addEventListener('mouseenter', stop);
            slider.addEventListener('mouseleave', start);

            // Touch / swipe
            let tx = 0;
            slider.addEventListener('touchstart', e => { tx = e.changedTouches[0].screenX; }, { passive: true });
            slider.addEventListener('touchend', e => {
                const diff = tx - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) { diff > 0 ? next() : prev(); reset(); }
            }, { passive: true });

            // Keyboard
            document.addEventListener('keydown', e => {
                if (e.key === 'ArrowLeft')  { prev(); reset(); }
                if (e.key === 'ArrowRight') { next(); reset(); }
            });

            // Init first slide
            slides[0].classList.add('active');
            progresses[0].classList.add('running');
            dots[0] && dots[0].classList.add('active');
            start();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSlider);
        } else {
            initSlider();
        }
    })();
    </script>
    @endif

    @if($about)
    <div class="space" id="about-sec">
        <div class="container">

            {{-- ── Row 1: Image stack + WHO WE ARE title / description / video ── --}}
            <div class="row align-items-stretch gy-4">
                <div class="col-xl-7 col-lg-6 order-2 order-lg-1">
                    <div class="title-area mb-4">
                        <span class="sub-title text-primary">
                            <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                            WHO WE ARE
                            <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                        </span>
                        {{-- <h3 class="sec-title">{{ $about->title }}</h3> --}}
                        <div class="sec-text about-description-text">
                            {!! html_entity_decode($about->description) !!}
                        </div>
                        <a wire:navigate href="{{ route('about-us') }}" class="about-readmore-link mt-3">
                            Learn More About Us <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 order-1 order-lg-2">
                    <div class="about-media-stack">
                        <div class="about-media-main">
                            <img src="{{ asset('storage/'.$about->image) }}" alt="About ClearKamo">
                        </div>
                        @if(!empty($about->image2))
                            <div class="about-media-secondary d-none d-lg-block">
                                <img src="{{ asset('storage/'.$about->image2) }}" alt="ClearKamo team">
                            </div>
                        @endif
                        {{-- Experience badge overlay --}}
                        <div class="about-exp-badge">
                            <span class="about-exp-num">{{ $about->ex_years ?? 25 }}+</span>
                            <span class="about-exp-label">Years of<br>Experience</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ── Row 2: Side-by-side YouTube video + Project Gallery ── --}}
            <div class="row gy-4 mt-2" id="media-row">
                {{-- Left: YouTube video --}}
                <div class="col-lg-6">
                    @if($aboutVideoEmbedUrl)
                        <div class="about-video-cinema h-100">
                            <div class="about-video-cinema-inner h-100">
                                <div class="about-video-cinema-label">
                                    <span class="about-video-dot"></span>
                                    Watch Our Story
                                </div>
                                <div class="about-video-frame">
                                    <iframe
                                        src="{{ $aboutVideoEmbedUrl }}"
                                        title="ClearKamo video"
                                        loading="lazy"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="about-video-cinema h-100">
                            <div class="about-video-cinema-inner h-100">
                                <div class="about-video-frame about-video-placeholder d-flex align-items-center justify-content-center">
                                    <div class="text-center text-white">
                                        <i class="fas fa-play-circle about-video-placeholder-icon"></i>
                                        <p class="mt-3 mb-0 opacity-75">Add a YouTube URL in the admin <strong>About Us</strong> panel to display a video here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right: Project Gallery Slider --}}
                <div class="col-lg-6">
                    <div class="gallery-block h-100">
                        <div class="gallery-block-header">
                            <div class="gallery-block-title-wrap">
                                <span class="gallery-block-dot"></span>
                                <span class="gallery-block-label">Our Gallery</span>
                            </div>
                            {{-- Project filter dropdown --}}
                            @if($galleryProjects && $galleryProjects->count())
                                <div class="gallery-select-wrap">
                                    <select id="galleryProjectSelect" class="gallery-select">
                                        <option value="all">All Projects</option>
                                        @foreach($galleryProjects as $gIdx => $gProj)
                                            <option value="{{ $gIdx }}">{{ $gProj->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="gallery-select-arrow"><i class="fas fa-chevron-down"></i></span>
                                </div>
                            @endif
                        </div>

                        @if($galleryProjects && $galleryProjects->count())
                            <div class="gallery-panels">
                                @foreach($galleryProjects as $gIdx => $gProj)
                                    <div class="gallery-panel{{ $gIdx === 0 ? ' active' : '' }}" data-panel="{{ $gIdx }}">
                                        <div class="gallery-slider" id="gallerySlider{{ $gIdx }}">
                                            @foreach($gProj->galleryPhotos as $photo)
                                                <div class="gallery-slide">
                                                    <div class="gallery-slide-img-wrap">
                                                        <img src="{{ asset('storage/'.$photo->image) }}"
                                                             alt="{{ $photo->caption ?: $gProj->title }}"
                                                             loading="lazy">
                                                        @if($photo->caption)
                                                            <div class="gallery-slide-caption">{{ $photo->caption }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- Slide navigation --}}
                                        @if($gProj->galleryPhotos->count() > 1)
                                            <div class="gallery-nav">
                                                <button class="gallery-nav-btn gallery-prev" data-slider="{{ $gIdx }}">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                                <div class="gallery-dots" id="galleryDots{{ $gIdx }}">
                                                    @foreach($gProj->galleryPhotos as $dIdx => $photo)
                                                        <span class="gallery-dot{{ $dIdx === 0 ? ' active' : '' }}"
                                                              data-slider="{{ $gIdx }}" data-idx="{{ $dIdx }}"></span>
                                                    @endforeach
                                                </div>
                                                <button class="gallery-nav-btn gallery-next" data-slider="{{ $gIdx }}">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="gallery-empty">
                                <i class="fas fa-images gallery-empty-icon"></i>
                                <p class="mt-3">No gallery photos yet. Add photos via the admin <strong>Gallery</strong> panel.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* ── About Section ───────────────────────────────────────────────── */
            #about-sec {
                background: #f8fafc;
                padding-top: 40px;
                padding-bottom: 40px;
            }

            /* Image stack */
            #about-sec .about-media-stack {
                position: relative;
                width: 100%;
                max-width: 520px;
                margin: 0 auto;
                padding-bottom: 10px;
            }
            #about-sec .col-xl-5.d-flex,
            #about-sec .col-lg-6.d-flex {
                flex-direction: column;
            }
            #about-sec .about-media-main {
                flex: 1;
                display: flex;
            }
            #about-sec .about-media-main img {
                width: 100%;
                height: 100%;
                min-height: 340px;
                object-fit: cover;
                border-radius: 18px;
                box-shadow: 0 20px 48px rgba(15, 23, 42, 0.16);
                display: block;
            }
            #about-sec .about-media-secondary {
                position: absolute;
                right: -24px;
                bottom: 60px;
                width: 52%;
                z-index: 2;
                animation: aboutFloat 5s ease-in-out infinite;
            }
            #about-sec .about-media-secondary img {
                width: 100%;
                height: 160px;
                object-fit: cover;
                border-radius: 14px;
                box-shadow: 0 12px 28px rgba(15, 23, 42, 0.18);
                border: 4px solid #fff;
            }

            /* Experience badge */
            #about-sec .about-exp-badge {
                position: absolute;
                left: -14px;
                bottom: 28px;
                background: linear-gradient(135deg, #03A4FC 0%, #025ea8 100%);
                color: #fff;
                border-radius: 16px;
                padding: 16px 22px;
                box-shadow: 0 10px 32px rgba(3, 164, 252, 0.38);
                display: flex;
                align-items: center;
                gap: 12px;
                z-index: 3;
                min-width: 148px;
            }
            #about-sec .about-exp-num {
                font-size: 2rem;
                font-weight: 800;
                line-height: 1;
                white-space: nowrap;
            }
            #about-sec .about-exp-label {
                font-size: 0.78rem;
                font-weight: 600;
                line-height: 1.35;
                text-transform: uppercase;
                letter-spacing: 0.04em;
                opacity: 0.92;
            }

            /* Description text */
            #about-sec .about-description-text {
                color: #475569;
                line-height: 1.8;
                font-size: 1rem;
            }
            #about-sec .about-description-text p { margin-bottom: 0.6rem; }
            #about-sec .about-description-text p:last-child { margin-bottom: 0; }

            #about-sec .about-readmore-link {
                display: inline-flex;
                align-items: center;
                font-size: .9rem;
                font-weight: 700;
                color: #03A4FC;
                text-decoration: none;
                gap: 4px;
                transition: gap .2s ease, color .2s ease;
            }
            #about-sec .about-readmore-link:hover {
                gap: 10px;
                color: #025ea8;
            }

            /* Cinematic video block */
            #about-sec .about-video-cinema {
                width: 100%;
            }
            #about-sec .about-video-cinema-inner {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0c1d35 100%);
                border-radius: 24px;
                padding: 28px 28px 28px;
                box-shadow: 0 24px 60px rgba(3, 164, 252, 0.18), 0 8px 24px rgba(15, 23, 42, 0.32);
                border: 1px solid rgba(3, 164, 252, 0.18);
                position: relative;
                overflow: hidden;
            }
            #about-sec .about-video-cinema-inner::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(ellipse at top left, rgba(3,164,252,0.1) 0%, transparent 60%);
                pointer-events: none;
            }
            #about-sec .about-video-cinema-label {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: rgba(255,255,255,0.72);
                margin-bottom: 16px;
            }
            #about-sec .about-video-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #03A4FC;
                box-shadow: 0 0 0 3px rgba(3,164,252,0.28);
                animation: videoPulse 2s ease-in-out infinite;
                display: inline-block;
            }
            @keyframes videoPulse {
                0%, 100% { box-shadow: 0 0 0 3px rgba(3,164,252,0.28); }
                50%       { box-shadow: 0 0 0 6px rgba(3,164,252,0.14); }
            }
            #about-sec .about-video-frame {
                width: 100%;
                aspect-ratio: 16 / 9;
                border-radius: 14px;
                overflow: hidden;
                background: #000;
                box-shadow: 0 8px 32px rgba(0,0,0,0.45);
            }
            #about-sec .about-video-frame iframe {
                width: 100%;
                height: 100%;
                border: 0;
                display: block;
            }
            #about-sec .about-video-placeholder {
                color: rgba(255,255,255,0.6);
                font-size: 0.95rem;
                background: rgba(255,255,255,0.04);
                min-height: 260px;
            }
            #about-sec .about-video-placeholder-icon {
                font-size: 4rem;
                color: rgba(3,164,252,0.7);
            }

            /* ── Mission / Vision cards ──────────────────────────────────────── */
            #about-sec .about-mv-row {
                margin-top: 56px;
            }
            #about-sec .about-mv-card {
                background: #fff;
                border-radius: 18px;
                padding: 24px 18px;
                height: 100%;
                box-shadow: 0 4px 28px rgba(15, 23, 42, 0.07);
                border-top: 4px solid #03A4FC;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }
            #about-sec .about-mv-card--vision {
                border-top-color: #0ea5e9;
            }
            #about-sec .about-mv-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 16px 40px rgba(3, 164, 252, 0.14);
            }
            #about-sec .about-mv-icon {
                width: 58px;
                height: 58px;
                border-radius: 16px;
                background: linear-gradient(135deg, #03A4FC, #025ea8);
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;
                font-size: 1.45rem;
                color: #fff;
                box-shadow: 0 6px 18px rgba(3, 164, 252, 0.32);
            }
            #about-sec .about-mv-icon--vision {
                background: linear-gradient(135deg, #0ea5e9, #0284c7);
                box-shadow: 0 6px 18px rgba(14, 165, 233, 0.32);
            }
            #about-sec .about-mv-title {
                font-size: 1.3rem;
                font-weight: 700;
                color: #0f172a;
                margin-bottom: 14px;
            }
            #about-sec .about-mv-text {
                color: #475569;
                line-height: 1.8;
                font-size: 0.97rem;
                margin-bottom: 0;
            }

            /* ── Core Values ─────────────────────────────────────────────────── */
            #about-sec .about-cv-section {
                margin-top: 60px;
            }
            #about-sec .about-cv-header {
                margin-bottom: 38px;
            }
            #about-sec .about-cv-card {
                background: #fff;
                border-radius: 18px;
                padding: 32px 28px;
                height: 100%;
                box-shadow: 0 4px 24px rgba(15, 23, 42, 0.07);
                border-top: 3px solid #03A4FC;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }
            #about-sec .about-cv-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 14px 36px rgba(3, 164, 252, 0.15);
            }
            #about-sec .about-cv-icon {
                width: 54px;
                height: 54px;
                border-radius: 14px;
                background: linear-gradient(135deg, rgba(3,164,252,0.12), rgba(3,164,252,0.22));
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 18px;
                font-size: 1.35rem;
                color: #03A4FC;
            }
            #about-sec .about-cv-title {
                font-size: 1.08rem;
                font-weight: 700;
                color: #0f172a;
                margin-bottom: 10px;
            }
            #about-sec .about-cv-text {
                color: #475569;
                line-height: 1.75;
                font-size: 0.93rem;
                margin-bottom: 0;
            }

            @keyframes aboutFloat {
                0%, 100% { transform: translateY(0); }
                50%       { transform: translateY(-10px); }
            }

            /* ── Media row (side-by-side video + gallery) ─────────────────────── */
            #about-sec #media-row {
                margin-top: 40px;
            }

            /* Cinematic video block */
            #about-sec .about-video-cinema {
                width: 100%;
            }
            #about-sec .about-video-cinema-inner {
                background: linear-gradient(135deg, #0f172a 0%, #1e2d44 60%, #0c1d35 100%);
                border-radius: 24px;
                padding: 24px;
                box-shadow: 0 24px 60px rgba(3, 164, 252, 0.15), 0 8px 24px rgba(15, 23, 42, 0.28);
                border: 1px solid rgba(3, 164, 252, 0.18);
                position: relative;
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }
            #about-sec .about-video-cinema-inner::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(ellipse at top left, rgba(3,164,252,0.1) 0%, transparent 60%);
                pointer-events: none;
            }
            #about-sec .about-video-cinema-label {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: rgba(255,255,255,0.72);
                margin-bottom: 14px;
            }
            #about-sec .about-video-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #03A4FC;
                box-shadow: 0 0 0 3px rgba(3,164,252,0.28);
                animation: videoPulse 2s ease-in-out infinite;
                display: inline-block;
            }
            @keyframes videoPulse {
                0%, 100% { box-shadow: 0 0 0 3px rgba(3,164,252,0.28); }
                50%       { box-shadow: 0 0 0 6px rgba(3,164,252,0.14); }
            }
            #about-sec .about-video-frame {
                width: 100%;
                aspect-ratio: 16 / 9;
                border-radius: 14px;
                overflow: hidden;
                background: #000;
                box-shadow: 0 8px 32px rgba(0,0,0,0.45);
                flex: 1;
            }
            #about-sec .about-video-frame iframe {
                width: 100%;
                height: 100%;
                border: 0;
                display: block;
            }
            #about-sec .about-video-placeholder {
                color: rgba(255,255,255,0.6);
                font-size: 0.95rem;
                background: rgba(255,255,255,0.04);
                min-height: 220px;
            }
            #about-sec .about-video-placeholder-icon {
                font-size: 4rem;
                color: rgba(3,164,252,0.7);
            }

            /* ── Gallery block ───────────────────────────────────────────────── */
            #about-sec .gallery-block {
                background: linear-gradient(135deg, #0f172a 0%, #1e2d44 60%, #0c1d35 100%);
                border-radius: 24px;
                padding: 24px;
                box-shadow: 0 24px 60px rgba(3, 164, 252, 0.15), 0 8px 24px rgba(15, 23, 42, 0.28);
                border: 1px solid rgba(3, 164, 252, 0.18);
                display: flex;
                flex-direction: column;
                position: relative;
                overflow: hidden;
                min-height: 340px;
            }
            #about-sec .gallery-block::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(ellipse at bottom right, rgba(3,164,252,0.08) 0%, transparent 60%);
                pointer-events: none;
            }
            #about-sec .gallery-block-header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 12px;
                margin-bottom: 16px;
            }
            #about-sec .gallery-block-title-wrap {
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }
            #about-sec .gallery-block-dot {
                width: 8px; height: 8px;
                border-radius: 50%;
                background: #10b981;
                box-shadow: 0 0 0 3px rgba(16,185,129,0.3);
                display: inline-block;
                animation: galleryDotPulse 2.4s ease-in-out infinite;
            }
            @keyframes galleryDotPulse {
                0%, 100% { box-shadow: 0 0 0 3px rgba(16,185,129,0.3); }
                50%       { box-shadow: 0 0 0 6px rgba(16,185,129,0.12); }
            }
            #about-sec .gallery-block-label {
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: rgba(255,255,255,0.72);
            }

            /* Project dropdown */
            #about-sec .gallery-select-wrap {
                position: relative;
                display: inline-flex;
                align-items: center;
            }
            #about-sec .gallery-select {
                appearance: none;
                -webkit-appearance: none;
                background: rgba(255,255,255,0.07);
                color: #fff;
                border: 1px solid rgba(255,255,255,0.18);
                border-radius: 20px;
                padding: 5px 34px 5px 14px;
                font-size: 0.78rem;
                font-weight: 600;
                cursor: pointer;
                outline: none;
                transition: all 0.2s ease;
            }
            #about-sec .gallery-select option {
                background: #1a2535;
                color: #fff;
            }
            #about-sec .gallery-select:focus,
            #about-sec .gallery-select:hover {
                background: rgba(3,164,252,0.18);
                border-color: #03A4FC;
                box-shadow: 0 4px 12px rgba(3,164,252,0.25);
            }
            #about-sec .gallery-select-arrow {
                position: absolute;
                right: 11px;
                pointer-events: none;
                color: rgba(255,255,255,0.6);
                font-size: 0.65rem;
            }

            /* Panels */
            #about-sec .gallery-panels {
                flex: 1;
                position: relative;
                display: flex;
                flex-direction: column;
            }
            #about-sec .gallery-panel {
                display: none;
                flex: 1;
                flex-direction: column;
            }
            #about-sec .gallery-panel.active {
                display: flex;
            }

            /* Slider */
            #about-sec .gallery-slider {
                flex: 1;
                overflow: hidden;
                border-radius: 14px;
                position: relative;
            }
            #about-sec .gallery-slide {
                display: none;
            }
            #about-sec .gallery-slide.active {
                display: block;
            }
            #about-sec .gallery-slide-img-wrap {
                position: relative;
                width: 100%;
                aspect-ratio: 4 / 3;
                border-radius: 14px;
                overflow: hidden;
                background: #000;
                box-shadow: 0 8px 28px rgba(0,0,0,0.5);
            }
            #about-sec .gallery-slide-img-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform 0.4s ease;
            }
            #about-sec .gallery-slide.active .gallery-slide-img-wrap img {
                transform: scale(1.02);
            }
            #about-sec .gallery-slide-caption {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(transparent, rgba(0,0,0,0.72));
                color: rgba(255,255,255,0.92);
                font-size: 0.82rem;
                padding: 24px 14px 12px;
                border-radius: 0 0 14px 14px;
                font-weight: 500;
            }

            /* Nav */
            #about-sec .gallery-nav {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                margin-top: 12px;
            }
            #about-sec .gallery-nav-btn {
                width: 34px; height: 34px;
                border-radius: 50%;
                border: 1px solid rgba(255,255,255,0.2);
                background: rgba(255,255,255,0.08);
                color: rgba(255,255,255,0.75);
                display: flex; align-items: center; justify-content: center;
                cursor: pointer;
                font-size: 0.75rem;
                transition: all 0.2s ease;
                padding: 0;
            }
            #about-sec .gallery-nav-btn:hover {
                background: #03A4FC;
                border-color: #03A4FC;
                color: #fff;
                box-shadow: 0 4px 12px rgba(3,164,252,0.35);
            }
            #about-sec .gallery-dots {
                display: flex; gap: 6px; align-items: center;
            }
            #about-sec .gallery-dot {
                width: 6px; height: 6px;
                border-radius: 50%;
                background: rgba(255,255,255,0.28);
                cursor: pointer;
                transition: all 0.2s ease;
            }
            #about-sec .gallery-dot.active {
                width: 20px;
                border-radius: 3px;
                background: #03A4FC;
            }

            /* Empty state */
            #about-sec .gallery-empty {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: rgba(255,255,255,0.45);
                font-size: 0.95rem;
                text-align: center;
                padding: 40px 20px;
            }
            #about-sec .gallery-empty-icon {
                font-size: 3.5rem;
                color: rgba(3,164,252,0.4);
            }
            #about-sec .gallery-empty strong { color: rgba(255,255,255,0.65); }

            /* ── Responsive ──────────────────────────────────────────────────── */
            @media (max-width: 1199.98px) {
                #about-sec .about-media-stack  { max-width: 460px; }
                #about-sec .about-media-main img { min-height: 300px; }
            }
            @media (max-width: 991.98px) {
                #about-sec .about-media-stack  { max-width: 100%; min-height: 280px; }
                #about-sec .about-media-main img { min-height: 260px; }
                #about-sec .about-media-secondary { right: 0; bottom: 60px; }
                #about-sec .about-exp-badge { left: 12px; bottom: 20px; }
            }
            @media (max-width: 575.98px) {
                #about-sec { padding-top: 12px; padding-bottom: 12px; }
                #about-sec .about-media-main img { height: 220px; }
                #about-sec .about-mv-row { margin-top: 16px; }
                #about-sec .about-cv-section { margin-top: 40px; }
                #about-sec .about-mv-card,
                #about-sec .about-cv-card { padding: 12px 8px; }
                #about-sec .gallery-block-header { flex-direction: column; }
            }
        </style>

        <script>
        (function () {
                // ── Gallery: dropdown switching + slide navigation ──────────────────
                var sliderState = {}; // keyed by panel index
                var autoRotateInterval = null;

                // Collect ordered panel indices
                var panelIndices = [];
                document.querySelectorAll('#about-sec .gallery-panel').forEach(function (panel) {
                    panelIndices.push(panel.dataset.panel);
                });

                function initGallery() {
                    // Build initial state for each panel
                    document.querySelectorAll('#about-sec .gallery-panel').forEach(function (panel) {
                        var idx = panel.dataset.panel;
                        var slides = panel.querySelectorAll('.gallery-slide');
                        sliderState[idx] = { current: 0, total: slides.length };
                        showSlide(idx, 0);
                    });

                    // Dropdown change
                    var sel = document.getElementById('galleryProjectSelect');
                    if (sel) {
                        sel.addEventListener('change', function () {
                            var val = sel.value;
                            stopAutoRotate();
                            if (val === 'all') {
                                // Show first panel and begin cross-project autoplay
                                activatePanel(panelIndices[0]);
                                startAutoRotate();
                            } else {
                                // Lock to the chosen project
                                activatePanel(val);
                                // Still autoplay slides within the locked project
                                startSlideOnlyAutoplay(val);
                            }
                        });
                    }

                    // Prev / Next
                    document.querySelectorAll('#about-sec .gallery-prev').forEach(function (btn) {
                        btn.addEventListener('click', function () {
                            var idx = btn.dataset.slider;
                            var s = sliderState[idx];
                            if (!s) return;
                            showSlide(idx, (s.current - 1 + s.total) % s.total);
                        });
                    });
                    document.querySelectorAll('#about-sec .gallery-next').forEach(function (btn) {
                        btn.addEventListener('click', function () {
                            var idx = btn.dataset.slider;
                            var s = sliderState[idx];
                            if (!s) return;
                            showSlide(idx, (s.current + 1) % s.total);
                        });
                    });

                    // Dot click
                    document.querySelectorAll('#about-sec .gallery-dot').forEach(function (dot) {
                        dot.addEventListener('click', function () {
                            showSlide(dot.dataset.slider, parseInt(dot.dataset.idx, 10));
                        });
                    });

                    // Start in "all projects" mode
                    startAutoRotate();
                }

                // Activate a panel by index string, deactivate all others
                function activatePanel(panelIdx) {
                    document.querySelectorAll('#about-sec .gallery-panel').forEach(function (p) {
                        p.classList.remove('active');
                    });
                    var target = document.querySelector('#about-sec .gallery-panel[data-panel="' + panelIdx + '"]');
                    if (target) { target.classList.add('active'); }
                }

                // Cross-project autoplay: advances slide; when last slide of a project is
                // shown, next tick moves to the first slide of the next project.
                function startAutoRotate() {
                    stopAutoRotate();
                    autoRotateInterval = setInterval(function () {
                        var activePanel = document.querySelector('#about-sec .gallery-panel.active');
                        if (!activePanel) return;
                        var idx = activePanel.dataset.panel;
                        var s   = sliderState[idx];
                        if (!s) return;
                        var nextSlide = (s.current + 1) % s.total;
                        if (nextSlide !== 0 || s.total === 1) {
                            // Advance within this project
                            showSlide(idx, nextSlide);
                        } else {
                            // Finished last slide — advance to the next project's first slide
                            showSlide(idx, 0);
                            var currentPanelPos = panelIndices.indexOf(idx);
                            var nextPanelIdx    = panelIndices[(currentPanelPos + 1) % panelIndices.length];
                            activatePanel(nextPanelIdx);
                            showSlide(nextPanelIdx, 0);
                        }
                    }, 4000);
                }

                // Slide-only autoplay for a locked project (no project rotation)
                function startSlideOnlyAutoplay(panelIdx) {
                    stopAutoRotate();
                    autoRotateInterval = setInterval(function () {
                        var s = sliderState[panelIdx];
                        if (!s || s.total <= 1) return;
                        showSlide(panelIdx, (s.current + 1) % s.total);
                    }, 4000);
                }

                function stopAutoRotate() {
                    if (autoRotateInterval) {
                        clearInterval(autoRotateInterval);
                        autoRotateInterval = null;
                    }
                }

                function showSlide(panelIdx, slideIdx) {
                    var panel = document.querySelector('#about-sec .gallery-panel[data-panel="' + panelIdx + '"]');
                    if (!panel) return;
                    var slides = panel.querySelectorAll('.gallery-slide');
                    var dots   = panel.querySelectorAll('.gallery-dot');
                    slides.forEach(function (s) { s.classList.remove('active'); });
                    dots.forEach(function (d) { d.classList.remove('active'); });
                    if (slides[slideIdx]) slides[slideIdx].classList.add('active');
                    if (dots[slideIdx])   dots[slideIdx].classList.add('active');
                    sliderState[panelIdx] = sliderState[panelIdx] || {};
                    sliderState[panelIdx].current = slideIdx;
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initGallery);
                } else {
                    initGallery();
                }
        })();
        </script>
    </div>
    @endif


    <section class="space-top space-bottom" id="service-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title-area text-center sr-fade-up">
                        <span class="sub-title">
                            <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">OUR SERVICES
                            <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                        </span>
                        <h2 class="sec-title">What We Do</h2>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @if($services)
                    @foreach ($services as $key => $service)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <article class="svc-card h-100">
                                <a wire:navigate href="/service/details/{{ $service->slug }}" class="svc-card-img-link">
                                    <div class="svc-card-img">
                                        <img src="{{ url('/storage/'.$service->image) }}" alt="{{ $service->title }}">
                                        <span class="svc-card-num">{{ str_pad($key+1, 2, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </a>
                                <div class="svc-card-body">
                                    <h3 class="svc-card-title">
                                        <a wire:navigate href="/service/details/{{ $service->slug }}">{{ $service->title }}</a>
                                    </h3>
                                    <a wire:navigate href="/service/details/{{ $service->slug }}" class="svc-card-link">
                                        Explore <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <style>
            #service-sec .svc-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
                display: flex;
                flex-direction: column;
                transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
            }
            #service-sec .svc-card:hover {
                transform: translateY(-5px);
                border-color: rgba(3,164,252,.4);
                box-shadow: 0 18px 32px rgba(3,164,252,.16);
            }
            #service-sec .svc-card-img {
                position: relative;
                width: 100%;
                height: 300px;
                overflow: hidden;
            }
            #service-sec .svc-card-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .4s ease;
            }
            #service-sec .svc-card:hover .svc-card-img img {
                transform: scale(1.05);
            }
            #service-sec .svc-card-num {
                position: absolute;
                top: 12px;
                right: 12px;
                width: 34px; height: 34px;
                border-radius: 8px;
                background: #03A4FC;
                color: #fff;
                font-size: 13px;
                font-weight: 700;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            #service-sec .svc-card-body {
                padding: 22px 24px 24px;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }
            #service-sec .svc-card-title {
                font-size: 1.2rem;
                font-weight: 700;
                color: #0f172a;
                margin: 0;
                line-height: 1.35;
            }
            #service-sec .svc-card-title a {
                color: inherit;
                text-decoration: none;
                transition: color .2s ease;
            }
            #service-sec .svc-card-title a:hover { color: #03A4FC; }
            #service-sec .svc-card-link {
                display: inline-flex;
                align-items: center;
                color: #03A4FC;
                font-size: .88rem;
                font-weight: 700;
                text-decoration: none;
                gap: 5px;
                transition: gap .2s ease, color .2s ease;
            }
            #service-sec .svc-card-link:hover {
                gap: 10px;
                color: #025ea8;
            }
            @media (max-width: 575.98px) {
                #service-sec .svc-card-img { height: 220px; }
            }
        </style>
    </section>

    {{-- ── Projects Section ─────────────────────────────────────── --}}
    @if($projects && $projects->count() > 0)
    <section class="space-top space-bottom" id="projects-sec" style="background: #f8fafc;">
        <div class="container">
            <div class="title-area text-center mb-4 sr-fade-up">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">Our Projects
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
                <h2 class="sec-title">Delivering Real-World Impact</h2>
            </div>
            <div class="row g-3">
                @foreach($projects->take(6) as $index => $project)
                <div class="col-lg-4 col-md-6 col-sm-6 sr-fade-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <a wire:navigate href="{{ route('project', ['slug' => $project->slug]) }}" class="proj-pic-card d-block text-decoration-none">
                        <div class="proj-pic-img">
                            <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" loading="lazy">
                            <div class="proj-pic-overlay">
                                <span class="proj-pic-category">{{ $project->category }}</span>
                                <h4 class="proj-pic-title">{{ $project->title }}</h4>
                                <span class="proj-pic-cta"><i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a wire:navigate href="{{ route('projects') }}" class="th-btn style3">
                    View All Projects <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        <style>
            #projects-sec .proj-pic-card { display: block; }
            #projects-sec .proj-pic-img {
                position: relative;
                height: 260px;
                overflow: hidden;
                border-radius: 16px;
                box-shadow: 0 8px 24px rgba(15,23,42,0.10);
            }
            #projects-sec .proj-pic-img img {
                width: 100%; height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .45s ease;
            }
            #projects-sec .proj-pic-card:hover .proj-pic-img img { transform: scale(1.07); }
            #projects-sec .proj-pic-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(10,25,50,.82) 0%, rgba(10,25,50,.18) 60%, transparent 100%);
                border-radius: 16px;
                padding: 20px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                opacity: .92;
                transition: opacity .3s ease;
            }
            #projects-sec .proj-pic-card:hover .proj-pic-overlay { opacity: 1; }
            #projects-sec .proj-pic-category {
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .06em;
                color: #03A4FC;
                background: rgba(3,164,252,.15);
                border: 1px solid rgba(3,164,252,.35);
                border-radius: 20px;
                padding: 3px 10px;
                display: inline-block;
                margin-bottom: 8px;
                width: fit-content;
            }
            #projects-sec .proj-pic-title {
                font-size: 1rem;
                font-weight: 700;
                color: #fff;
                line-height: 1.35;
                margin: 0 0 10px;
            }
            #projects-sec .proj-pic-cta {
                width: 34px; height: 34px;
                border-radius: 50%;
                background: #03A4FC;
                color: #fff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: .85rem;
                transition: background .2s ease, transform .2s ease;
            }
            #projects-sec .proj-pic-card:hover .proj-pic-cta {
                background: #025ea8;
                transform: translateX(4px);
            }
            @media (max-width: 575.98px) {
                #projects-sec .proj-pic-img { height: 220px; }
            }
        </style>
    </section>
    @endif
    {{-- ── News & Updates ───────────────────────────────────────── --}}
    @if($blogs && $blogs->count() > 0)
    <section class="space-top space-bottom" id="news-sec">
        <div class="container">
            <div class="title-area text-center sr-fade-up">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">LATEST NEWS
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
                <h2 class="sec-title">News &amp; Updates</h2>
            </div>

            <div class="row g-4">
                @foreach($blogs->take(3) as $blogIdx => $blog)
                @if($blog->slug)
                <div class="col-lg-4 col-md-6 sr-fade-up" style="animation-delay: {{ $blogIdx * 0.12 }}s">
                    <article class="news-card h-100">
                        <a wire:navigate href="{{ route('news-and-updates.details', ['slug' => $blog->slug]) }}" class="news-card-thumb-link">
                            <div class="news-card-thumb">
                                <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">
                                <span class="news-card-category">{{ $blog->category }}</span>
                            </div>
                        </a>
                        <div class="news-card-body">
                            <div class="news-card-meta">
                                <span class="news-card-date">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $blog->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <h3 class="news-card-title">
                                <a wire:navigate href="{{ route('news-and-updates.details', ['slug' => $blog->slug]) }}">
                                    {{ $blog->title }}
                                </a>
                            </h3>
                            <a wire:navigate href="{{ route('news-and-updates.details', ['slug' => $blog->slug]) }}" class="news-card-link">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>
                @endif
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a wire:navigate href="{{ route('news-and-update') }}" class="th-btn style3">
                    View All News &amp; Updates
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <style>
            #news-sec .news-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 8px 22px rgba(15, 23, 42, 0.07);
                transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
                display: flex;
                flex-direction: column;
            }
            #news-sec .news-card:hover {
                transform: translateY(-5px);
                border-color: rgba(3, 164, 252, 0.45);
                box-shadow: 0 18px 36px rgba(3, 164, 252, 0.15);
            }
            /* Thumbnail */
            #news-sec .news-card-thumb-link { display: block; }
            #news-sec .news-card-thumb {
                position: relative;
                height: 220px;
                overflow: hidden;
            }
            #news-sec .news-card-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .4s ease;
            }
            #news-sec .news-card:hover .news-card-thumb img {
                transform: scale(1.06);
            }
            /* Category badge */
            #news-sec .news-card-category {
                position: absolute;
                top: 14px;
                left: 14px;
                background: #03A4FC;
                color: #fff;
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .06em;
                padding: 4px 11px;
                border-radius: 20px;
            }
            /* Body */
            #news-sec .news-card-body {
                padding: 20px 22px 22px;
                display: flex;
                flex-direction: column;
                gap: 10px;
                flex: 1;
            }
            #news-sec .news-card-meta {
                margin: 0;
            }
            #news-sec .news-card-date {
                font-size: 12px;
                color: #94a3b8;
                font-weight: 500;
            }
            #news-sec .news-card-title {
                font-size: 1rem;
                font-weight: 700;
                line-height: 1.4;
                color: #0f172a;
                margin: 0;
                flex: 1;
            }
            #news-sec .news-card-title a {
                color: inherit;
                text-decoration: none;
                transition: color .2s ease;
            }
            #news-sec .news-card-title a:hover { color: #03A4FC; }
            #news-sec .news-card-link {
                display: inline-flex;
                align-items: center;
                font-size: .875rem;
                font-weight: 700;
                color: #03A4FC;
                text-decoration: none;
                gap: 4px;
                transition: gap .2s ease, color .2s ease;
            }
            #news-sec .news-card-link:hover {
                gap: 8px;
                color: #0284c7;
            }
            @media (max-width: 575.98px) {
                #news-sec .news-card-thumb { height: 200px; }
            }
        </style>
    </section>
    @endif

    {{-- ── Publications Section ─────────────────────────────────── --}}
    @if($publications && $publications->count() > 0)
    <section class="space-top space-bottom" id="publications-sec">
        <div class="container">
            <div class="title-area text-center mb-4 sr-fade-up">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">Publications
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
                <h2 class="sec-title">Research &amp; Publications</h2>
            </div>
            <div class="row g-4">
                @foreach($publications->take(4) as $index => $pub)
                <div class="col-lg-3 col-md-6 sr-fade-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <a href="{{ $pub->link }}" target="_blank" rel="noopener noreferrer" class="pub-pic-card d-block text-decoration-none">
                        <div class="pub-pic-img">
                            <img src="{{ asset('storage/'.$pub->image) }}" alt="{{ $pub->title }}" loading="lazy">
                            <div class="pub-pic-overlay">
                                <h4 class="pub-pic-title">{{ $pub->title }}</h4>
                                <span class="pub-pic-cta">
                                    Open <i class="fas fa-external-link-alt ms-1"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5 sr-fade-up">
                <a wire:navigate href="{{ route('publications') }}" class="th-btn style3">
                    View All Publications <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        <style>
            #publications-sec .pub-pic-card { display: block; }
            #publications-sec .pub-pic-img {
                position: relative;
                height: 340px;
                overflow: hidden;
                border-radius: 16px;
                box-shadow: 0 8px 24px rgba(15,23,42,0.10);
            }
            #publications-sec .pub-pic-img img {
                width: 100%; height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .5s ease;
            }
            #publications-sec .pub-pic-card:hover .pub-pic-img img { transform: scale(1.08); }
            #publications-sec .pub-pic-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(10,25,50,.92) 0%, rgba(10,25,50,.10) 55%, transparent 100%);
                border-radius: 16px;
                padding: 22px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                transition: background .35s ease;
            }
            #publications-sec .pub-pic-card:hover .pub-pic-overlay {
                background: linear-gradient(to top, rgba(3,60,110,.95) 0%, rgba(3,60,110,.18) 60%, transparent 100%);
            }
            #publications-sec .pub-pic-title {
                font-size: .97rem;
                font-weight: 700;
                color: #fff;
                line-height: 1.4;
                margin: 0 0 10px;
            }
            #publications-sec .pub-pic-cta {
                font-size: .82rem;
                font-weight: 700;
                color: #03A4FC;
                letter-spacing: .02em;
                transition: color .2s;
            }
            #publications-sec .pub-pic-card:hover .pub-pic-cta { color: #7dd3fc; }
            @media (max-width: 575.98px) {
                #publications-sec .pub-pic-img { height: 280px; }
            }
        </style>
    </section>
    @endif

    @if($teams && $teams->count() > 0)
    <section class="space-top" id="team-sec">
        <div class="container">
            <div class="title-area text-center sr-fade-up">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">OUR TEAM
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
                <h2 class="sec-title">Meet Our Team</h2>
            </div>
            <div class="row gy-30">
                @foreach($teams as $teamIdx => $team)
                    <div class="col-xl-3 col-lg-4 col-md-6 sr-fade-up" style="animation-delay: {{ $teamIdx * 0.1 }}s">
                        <div class="team-card h-100">
                            <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}" class="team-card-photo-link">
                                <img
                                    src="{{ asset('storage/'.$team->image) }}"
                                    alt="{{ $team->name }}"
                                    class="team-card-photo"
                                >
                                <div class="team-card-hover-overlay">
                                    <span class="team-card-view-btn"><i class="fas fa-user me-1"></i> View Profile</span>
                                </div>
                            </a>
                            <div class="team-card-info">
                                <h3 class="team-card-name">
                                    <a wire:navigate href="{{ route('team-details', ['slug' => $team->slug ?: $team->id]) }}">
                                        {{ $team->name }}
                                    </a>
                                </h3>
                                <p class="team-card-position">{{ $team->position }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        #team-sec .team-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 22px rgba(15,23,42,.08);
            border: 1px solid #e5e7eb;
            transition: transform .25s ease, box-shadow .25s ease;
            text-align: center;
            padding: 28px 20px 24px;
        }
        #team-sec .team-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(3,164,252,.14);
        }
        #team-sec .team-card-photo-link {
            display: inline-block;
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #03A4FC;
            margin-bottom: 18px;
            flex-shrink: 0;
        }
        #team-sec .team-card-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .45s ease;
        }
        #team-sec .team-card:hover .team-card-photo { transform: scale(1.08); }
        #team-sec .team-card-hover-overlay {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(3,164,252,.75);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .3s ease;
        }
        #team-sec .team-card:hover .team-card-hover-overlay { opacity: 1; }
        #team-sec .team-card-view-btn {
            color: #fff;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .03em;
            text-decoration: none;
            text-align: center;
            line-height: 1.3;
        }
        #team-sec .team-card-info {
            padding: 0;
        }
        #team-sec .team-card-name {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }
        #team-sec .team-card-name a {
            color: inherit;
            text-decoration: none;
            transition: color .2s ease;
        }
        #team-sec .team-card-name a:hover { color: #03A4FC; }
        #team-sec .team-card-position {
            font-size: .85rem;
            color: #03A4FC;
            font-weight: 600;
            margin: 0;
        }
    </style>

    @endif


    {{-- ── Testimonials ─────────────────────────────────────────── --}}
    <section class="overflow-hidden space-top space-bottom" id="testimonials">
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

{{-- ── Clients & Partners Marquee ──────────────────────────── --}}
@if($clients && $clients->count() > 0)
<section id="clients-sec">
    <div class="clients-marquee-label">
        <span>Our Clients &amp; Partners</span>
    </div>
    <div class="clients-track-wrap">
        <div class="clients-track">
            @foreach($clients as $client)
                <div class="clients-item">
                    @if($client->url)
                        <a href="{{ $client->url }}" target="_blank" rel="noopener noreferrer" class="clients-link">
                            <img src="{{ asset('storage/'.$client->image) }}" alt="{{ $client->name }}" loading="lazy">
                        </a>
                    @else
                        <span class="clients-link">
                            <img src="{{ asset('storage/'.$client->image) }}" alt="{{ $client->name }}" loading="lazy">
                        </span>
                    @endif
                </div>
            @endforeach
            {{-- Duplicate for seamless infinite loop --}}
            @foreach($clients as $client)
                <div class="clients-item" aria-hidden="true">
                    @if($client->url)
                        <a href="{{ $client->url }}" target="_blank" rel="noopener noreferrer" class="clients-link">
                            <img src="{{ asset('storage/'.$client->image) }}" alt="{{ $client->name }}" loading="lazy">
                        </a>
                    @else
                        <span class="clients-link">
                            <img src="{{ asset('storage/'.$client->image) }}" alt="{{ $client->name }}" loading="lazy">
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    #clients-sec {
        background: #ffffff;
        padding: 36px 0 40px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        overflow: hidden;
    }
    .clients-marquee-label {
        text-align: center;
        margin-bottom: 22px;
    }
    .clients-marquee-label span {
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: #94a3b8;
    }
    .clients-track-wrap {
        overflow: hidden;
        position: relative;
    }
    .clients-track-wrap::before,
    .clients-track-wrap::after {
        content: '';
        position: absolute;
        top: 0; bottom: 0;
        width: 120px;
        z-index: 2;
        pointer-events: none;
    }
    .clients-track-wrap::before {
        left: 0;
        background: linear-gradient(to right, #ffffff, transparent);
    }
    .clients-track-wrap::after {
        right: 0;
        background: linear-gradient(to left, #ffffff, transparent);
    }
    .clients-track {
        display: flex;
        align-items: center;
        gap: 0;
        width: max-content;
        animation: clientsScroll 28s linear infinite;
    }
    .clients-track:hover { animation-play-state: paused; }
    @keyframes clientsScroll {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .clients-item {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 44px;
        flex-shrink: 0;
    }
    .clients-link {
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    .clients-item img {
        height: 52px;
        width: auto;
        max-width: 140px;
        object-fit: contain;
        transition: transform .3s ease;
        display: block;
    }
    .clients-item:hover img {
        transform: scale(1.06);
    }
    @media (max-width: 575.98px) {
        .clients-item { padding: 0 28px; }
        .clients-item img { height: 38px; max-width: 100px; }
    }
</style>
@endif

{{-- ── Scroll-Reveal Animations ──────────────────────────────── --}}
<style>
    /* Scroll-reveal base */
    .sr-fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity .65s ease, transform .65s ease;
    }
    .sr-fade-up.sr-visible {
        opacity: 1;
        transform: translateY(0);
    }
    /* Picture zoom on hover — global helper */
    .pic-zoom { overflow: hidden; border-radius: 16px; }
    .pic-zoom img { transition: transform .5s ease; display: block; width: 100%; height: 100%; object-fit: cover; }
    .pic-zoom:hover img { transform: scale(1.07); }
</style>
<script>
(function () {
    'use strict';
    var elems = document.querySelectorAll('.sr-fade-up');
    if (!elems.length) return;
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('sr-visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    elems.forEach(function (el) { io.observe(el); });
})();
</script>

@if(isset($ceoMessage) && $ceoMessage && $ceoMessage->team)
{{-- ── Floating CEO Message Popup ──────────────────────────────────── --}}
<style>
    #ceo-popup {
        position: fixed;
        bottom: -320px;
        right: 24px;
        z-index: 9999;
        width: 340px;
        max-width: calc(100vw - 32px);
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 40px rgba(15,23,42,.22), 0 2px 8px rgba(15,23,42,.10);
        border: 1px solid rgba(3,164,252,.18);
        overflow: hidden;
        transition: bottom .55s cubic-bezier(.22,1,.36,1), opacity .45s ease;
        opacity: 0;
    }
    #ceo-popup.ceo-popup-visible {
        bottom: 24px;
        opacity: 1;
    }
    #ceo-popup .ceo-popup-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 70%, #0c1d35 100%);
        padding: 18px 20px 14px;
        display: flex;
        align-items: center;
        gap: 14px;
        position: relative;
    }
    #ceo-popup .ceo-popup-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(3,164,252,.55);
        flex-shrink: 0;
    }
    #ceo-popup .ceo-popup-avatar-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(3,164,252,.18);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 3px solid rgba(3,164,252,.55);
        color: #03A4FC;
        font-size: 1.6rem;
    }
    #ceo-popup .ceo-popup-name {
        color: #fff;
        font-weight: 700;
        font-size: .95rem;
        line-height: 1.3;
        margin: 0;
    }
    #ceo-popup .ceo-popup-position {
        color: rgba(255,255,255,.65);
        font-size: .78rem;
        margin: 2px 0 0;
    }
    #ceo-popup .ceo-popup-close {
        position: absolute;
        top: 10px;
        right: 12px;
        background: rgba(255,255,255,.12);
        border: none;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        color: rgba(255,255,255,.8);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        transition: background .2s;
        line-height: 1;
    }
    #ceo-popup .ceo-popup-close:hover { background: rgba(255,255,255,.22); }
    #ceo-popup .ceo-popup-body {
        padding: 16px 20px 20px;
    }
    #ceo-popup .ceo-popup-quote-icon {
        color: #03A4FC;
        font-size: 1.5rem;
        line-height: 1;
        margin-bottom: 6px;
        display: block;
    }
    #ceo-popup .ceo-popup-message {
        font-size: .88rem;
        color: #374151;
        line-height: 1.7;
        margin: 0;
    }
</style>

<div id="ceo-popup" role="dialog" aria-label="Message from {{ $ceoMessage->team->name }}">
    <div class="ceo-popup-header">
        @if($ceoMessage->team->image)
            <img class="ceo-popup-avatar"
                 src="{{ asset('storage/'.$ceoMessage->team->image) }}"
                 alt="{{ $ceoMessage->team->name }}">
        @else
            <div class="ceo-popup-avatar-placeholder">
                <i class="fa fa-user"></i>
            </div>
        @endif
        <div>
            <p class="ceo-popup-name">{{ $ceoMessage->team->name }}</p>
            <p class="ceo-popup-position">{{ $ceoMessage->team->position }}</p>
        </div>
        <button class="ceo-popup-close" id="ceo-popup-close-btn" aria-label="Close">&#x2715;</button>
    </div>
    <div class="ceo-popup-body">
        <span class="ceo-popup-quote-icon">&#8220;</span>
        <p class="ceo-popup-message">{{ $ceoMessage->message }}</p>
    </div>
</div>

<script>
(function () {
    var trigger = {{ (int)$ceoMessage->scroll_trigger_percent }};
    var popup   = document.getElementById('ceo-popup');
    var closeBtn = document.getElementById('ceo-popup-close-btn');
    var shown   = false;
    var dismissed = sessionStorage.getItem('ceo_popup_dismissed') === '1';

    if (dismissed || !popup) return;

    function checkScroll() {
        if (shown || dismissed) return;
        var scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
        if (scrolled >= trigger) {
            popup.classList.add('ceo-popup-visible');
            shown = true;
        }
    }

    window.addEventListener('scroll', checkScroll, { passive: true });

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            popup.classList.remove('ceo-popup-visible');
            dismissed = true;
            sessionStorage.setItem('ceo_popup_dismissed', '1');
        });
    }
})();
</script>
@endif

</div>
