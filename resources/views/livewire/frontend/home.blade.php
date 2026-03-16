{{-- @section('title',$title)
@section('description',$seodescription)
@section('keywords',$keywords) --}}
<div>
    <!-- Hero Slider Section -->
    @if($slides && $slides->count() > 0)
    <section id="hero-sec">
        <div id="mainSlider" class="hero-slider">
            @foreach($slides as $index => $slide)
                <div class="hero-slide{{ $index === 0 ? ' active' : '' }}">
                    {{-- Background image + dark-blue overlay --}}
                    @if($slide->image)
                        <div class="hero-slide-bg" style="background-image: url('{{ asset('storage/'.$slide->image) }}');"></div>
                    @endif
                    <div class="hero-slide-overlay"></div>

                    {{-- Decorative floating blobs --}}
                    <div class="hero-blob hero-blob-1"></div>
                    <div class="hero-blob hero-blob-2"></div>

                    {{-- Content --}}
                    <div class="hero-slide-content">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-9 col-lg-10 text-center">
                                    <span class="hero-eyebrow">
                                        <span class="hero-eyebrow-dot"></span>
                                        CLEARKAMO
                                        <span class="hero-eyebrow-dot"></span>
                                    </span>
                                    @if($slide->title)
                                        <h1 class="hero-title">{{ $slide->title }}</h1>
                                    @endif
                                    @if($slide->description)
                                        <p class="hero-desc">{!! $slide->description !!}</p>
                                    @endif
                                    <div class="hero-cta-row">
                                        <a wire:navigate href="{{ route('services') }}" class="hero-btn-primary">
                                            Explore Our Services
                                            <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                        <a wire:navigate href="{{ route('contact-us') }}" class="hero-btn-outline">
                                            Get In Touch
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Progress bar at bottom of slide --}}
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
        /* ── Hero Section ────────────────────────────────────────── */
        #hero-sec {
            position: relative;
            overflow: hidden;
        }

        .hero-slider {
            position: relative;
            height: 100svh;
            min-height: 540px;
            max-height: 860px;
        }

        /* Each slide */
        .hero-slide {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity .9s ease, visibility .9s ease;
            overflow: hidden;
        }
        .hero-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 2;
        }

        /* Background photo */
        .hero-slide-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transform: scale(1.06);
            transition: transform 6s ease;
        }
        .hero-slide.active .hero-slide-bg {
            transform: scale(1);
        }

        /* Dark gradient overlay */
        .hero-slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(3,164,252,.55) 0%,
                rgba(2,80,140,.7)  50%,
                rgba(5,5,20,.82)   100%
            );
        }

        /* Decorative blobs */
        .hero-blob {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-blob-1 {
            width: 420px; height: 420px;
            background: radial-gradient(circle, rgba(3,164,252,.25) 0%, transparent 70%);
            top: -120px; right: -80px;
            animation: blobFloat 8s ease-in-out infinite;
        }
        .hero-blob-2 {
            width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 70%);
            bottom: -60px; left: -40px;
            animation: blobFloat 11s ease-in-out infinite reverse;
        }
        @keyframes blobFloat {
            0%,100% { transform: translate(0,0) scale(1); }
            50%      { transform: translate(16px,-22px) scale(1.06); }
        }

        /* Content */
        .hero-slide-content {
            position: relative;
            z-index: 3;
            width: 100%;
            padding: 0 16px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,.85);
            font-size: .82rem;
            font-weight: 600;
            letter-spacing: .2em;
            text-transform: uppercase;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(20px);
            animation: none;
        }
        .hero-slide.active .hero-eyebrow {
            animation: heroFadeUp .7s ease forwards .1s;
        }
        .hero-eyebrow-dot {
            display: inline-block;
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #03A4FC;
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: #ffffff;
            line-height: 1.15;
            margin-bottom: 22px;
            opacity: 0;
            transform: translateY(28px);
            animation: none;
        }
        .hero-slide.active .hero-title {
            animation: heroFadeUp .8s ease forwards .28s;
        }

        .hero-desc {
            font-size: clamp(.95rem, 2vw, 1.18rem);
            color: rgba(255,255,255,.82);
            line-height: 1.7;
            max-width: 700px;
            margin: 0 auto 32px;
            opacity: 0;
            transform: translateY(28px);
            animation: none;
        }
        .hero-slide.active .hero-desc {
            animation: heroFadeUp .8s ease forwards .44s;
        }

        .hero-cta-row {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            opacity: 0;
            transform: translateY(24px);
            animation: none;
        }
        .hero-slide.active .hero-cta-row {
            animation: heroFadeUp .8s ease forwards .6s;
        }

        .hero-btn-primary {
            display: inline-flex;
            align-items: center;
            background: #03A4FC;
            color: #fff;
            padding: 15px 36px;
            border-radius: 50px;
            font-size: .97rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: .04em;
            box-shadow: 0 10px 30px rgba(3,164,252,.45);
            transition: transform .25s ease, box-shadow .25s ease, background .25s ease;
        }
        .hero-btn-primary:hover {
            background: #0295e8;
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(3,164,252,.55);
            color: #fff;
        }

        .hero-btn-outline {
            display: inline-flex;
            align-items: center;
            background: transparent;
            color: #fff;
            padding: 14px 34px;
            border-radius: 50px;
            border: 2px solid rgba(255,255,255,.65);
            font-size: .97rem;
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(6px);
            transition: border-color .25s ease, background .25s ease, transform .25s ease;
        }
        .hero-btn-outline:hover {
            border-color: #fff;
            background: rgba(255,255,255,.12);
            color: #fff;
            transform: translateY(-3px);
        }

        /* Progress bar at bottom of slide */
        .hero-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 0;
            background: #03A4FC;
            border-radius: 0 2px 2px 0;
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
            background: rgba(255,255,255,.92);
            color: #0f172a;
            font-size: 18px;
            box-shadow: 0 6px 20px rgba(0,0,0,.18);
            backdrop-filter: blur(8px);
            transition: background .25s ease, color .25s ease, transform .25s ease, box-shadow .25s ease;
        }
        .hero-nav:hover {
            background: #03A4FC;
            color: #fff;
            box-shadow: 0 10px 28px rgba(3,164,252,.45);
        }
        .hero-nav-prev { left: 28px; }
        .hero-nav-next { right: 28px; }

        /* Dot indicators */
        .hero-dots {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            gap: 10px;
        }
        .hero-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,.7);
            background: transparent;
            cursor: pointer;
            transition: all .35s ease;
            padding: 0;
        }
        .hero-dot.active {
            background: #03A4FC;
            border-color: #03A4FC;
            width: 28px;
            border-radius: 5px;
            box-shadow: 0 0 12px rgba(3,164,252,.7);
        }

        /* Entry animation keyframe */
        @keyframes heroFadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33%       { transform: translateY(-20px) rotate(120deg); }
            66%       { transform: translateY(20px) rotate(240deg); }
        }

        /* Mobile */
        @media (max-width: 767.98px) {
            .hero-slider { height: 92svh; min-height: 480px; }
            .hero-nav { width: 40px; height: 40px; font-size: 15px; }
            .hero-nav-prev { left: 12px; }
            .hero-nav-next { right: 12px; }
            .hero-blob-1 { width: 220px; height: 220px; }
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
                        <h3 class="sec-title">{{ $about->title }}</h3>
                        <div class="sec-text about-description-text">{!! $about->description !!}</div>
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
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0c1d35 100%);
                border-radius: 24px;
                padding: 24px;
                box-shadow: 0 24px 60px rgba(3, 164, 252, 0.18), 0 8px 24px rgba(15, 23, 42, 0.32);
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

    {{-- ── Impact Stats Cards ──────────────────────────────────── --}}
    @if($about)
    <section id="stats-section">
        <div class="container">
            <div class="stats-section-header text-center">
                <span class="sub-title text-primary">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                    Our Impact in Numbers
                    <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                </span>
                <p class="stats-section-subtext">Trusted results, delivered consistently across every engagement.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-card-icon-wrap">
                            <i class="fas fa-calendar-check stat-card-icon"></i>
                        </div>
                        <div class="stat-card-body">
                            <div class="stat-card-number">
                                <span class="stat-num" data-target="{{ $about->ex_years ?? 25 }}">0</span><span class="stat-suffix">+</span>
                            </div>
                            <p class="stat-card-label">Years of Experience</p>
                        </div>
                        <div class="stat-card-glow"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-card stat-card--2">
                        <div class="stat-card-icon-wrap">
                            <i class="fas fa-rocket stat-card-icon"></i>
                        </div>
                        <div class="stat-card-body">
                            <div class="stat-card-number">
                                <span class="stat-num" data-target="{{ $projectsCount }}">0</span><span class="stat-suffix">+</span>
                            </div>
                            <p class="stat-card-label">Projects Delivered</p>
                        </div>
                        <div class="stat-card-glow"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-card stat-card--3">
                        <div class="stat-card-icon-wrap">
                            <i class="fas fa-handshake stat-card-icon"></i>
                        </div>
                        <div class="stat-card-body">
                            <div class="stat-card-number">
                                <span class="stat-num" data-target="{{ $partnersCount }}">0</span><span class="stat-suffix">+</span>
                            </div>
                            <p class="stat-card-label">Partner Organizations</p>
                        </div>
                        <div class="stat-card-glow"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-card stat-card--4">
                        <div class="stat-card-icon-wrap">
                            <i class="fas fa-star stat-card-icon"></i>
                        </div>
                        <div class="stat-card-body">
                            <div class="stat-card-number">
                                <span class="stat-num" data-target="98">0</span><span class="stat-suffix">%</span>
                            </div>
                            <p class="stat-card-label">Client Satisfaction</p>
                        </div>
                        <div class="stat-card-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        /* ── Stats Cards Section ─────────────────────────────────────────── */
        #stats-section {
            background: #f0f7ff;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        #stats-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 10% 50%, rgba(3,164,252,0.07) 0%, transparent 55%),
                radial-gradient(ellipse at 90% 30%, rgba(2,94,168,0.06) 0%, transparent 50%);
            pointer-events: none;
        }
        #stats-section .stats-section-header {
            margin-bottom: 48px;
        }
        #stats-section .stats-section-subtext {
            color: #64748b;
            font-size: 1rem;
            margin-top: 10px;
            margin-bottom: 0;
        }

        /* Card base */
        #stats-section .stat-card {
            background: #ffffff;
            border-radius: 22px;
            padding: 36px 28px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08), 0 1px 4px rgba(15,23,42,0.04);
            border: 1px solid rgba(3,164,252,0.1);
            transition: transform 0.3s cubic-bezier(.34,1.4,.64,1), box-shadow 0.3s ease, border-color 0.3s ease;
            cursor: default;
        }
        #stats-section .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 48px rgba(3,164,252,0.18), 0 6px 16px rgba(15,23,42,0.1);
            border-color: rgba(3,164,252,0.35);
        }
        #stats-section .stat-card:hover .stat-card-glow {
            opacity: 1;
        }

        /* Radial glow effect behind icon */
        #stats-section .stat-card-glow {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(3,164,252,0.12) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        /* Icon circle */
        #stats-section .stat-card-icon-wrap {
            width: 68px;
            height: 68px;
            border-radius: 18px;
            background: linear-gradient(135deg, #03A4FC 0%, #025ea8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            box-shadow: 0 8px 24px rgba(3,164,252,0.32);
            position: relative;
            z-index: 1;
            transition: transform 0.3s cubic-bezier(.34,1.4,.64,1);
        }
        #stats-section .stat-card:hover .stat-card-icon-wrap {
            transform: scale(1.12) rotate(-4deg);
        }
        /* Per-card accent colours */
        #stats-section .stat-card--2 .stat-card-icon-wrap {
            background: linear-gradient(135deg, #f97316 0%, #c2410c 100%);
            box-shadow: 0 8px 24px rgba(249,115,22,0.32);
        }
        #stats-section .stat-card--3 .stat-card-icon-wrap {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 8px 24px rgba(16,185,129,0.32);
        }
        #stats-section .stat-card--4 .stat-card-icon-wrap {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
            box-shadow: 0 8px 24px rgba(139,92,246,0.32);
        }
        #stats-section .stat-card-icon {
            font-size: 1.55rem;
            color: #ffffff;
        }

        /* Number */
        #stats-section .stat-card-number {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 2px;
            margin-bottom: 8px;
        }
        #stats-section .stat-num {
            font-size: clamp(2.4rem, 5vw, 3rem);
            font-weight: 800;
            line-height: 1;
            color: #0f172a;
        }
        /* Per-card accent colours on number */
        #stats-section .stat-card--2 .stat-num { color: #f97316; }
        #stats-section .stat-card--3 .stat-num { color: #10b981; }
        #stats-section .stat-card--4 .stat-num { color: #8b5cf6; }
        #stats-section .stat-card .stat-num { color: #03A4FC; }

        #stats-section .stat-suffix {
            font-size: clamp(1.5rem, 3vw, 1.9rem);
            font-weight: 800;
            color: inherit;
            line-height: 1;
        }
        #stats-section .stat-card-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin: 0;
        }

        /* Bottom accent line */
        #stats-section .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            width: 60%;
            height: 3px;
            border-radius: 2px 2px 0 0;
            background: linear-gradient(90deg, #03A4FC, #025ea8);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        #stats-section .stat-card--2::after { background: linear-gradient(90deg, #f97316, #c2410c); }
        #stats-section .stat-card--3::after { background: linear-gradient(90deg, #10b981, #059669); }
        #stats-section .stat-card--4::after { background: linear-gradient(90deg, #8b5cf6, #6d28d9); }
        #stats-section .stat-card:hover::after { opacity: 1; }

        /* Responsive */
        @media (max-width: 767.98px) {
            #stats-section { padding: 52px 0; }
            #stats-section .stats-section-header { margin-bottom: 36px; }
            #stats-section .stat-card { padding: 28px 20px 24px; }
            #stats-section .stat-card-icon-wrap { width: 56px; height: 56px; border-radius: 14px; }
            #stats-section .stat-card-icon { font-size: 1.3rem; }
        }
    </style>
    <script>
    (function(){
        function animateCounters() {
            document.querySelectorAll('#stats-section .stat-num').forEach(function(el) {
                var target = parseInt(el.dataset.target, 10);
                var duration = 1800;
                var start = null;
                function step(ts) {
                    if (!start) start = ts;
                    var progress = Math.min((ts - start) / duration, 1);
                    var ease = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(ease * target);
                    if (progress < 1) requestAnimationFrame(step);
                    else el.textContent = target;
                }
                requestAnimationFrame(step);
            });
        }

        var strip = document.getElementById('stats-section');
        if (strip && 'IntersectionObserver' in window) {
            var ran = false;
            new IntersectionObserver(function(entries, obs) {
                if (entries[0].isIntersecting && !ran) {
                    ran = true;
                    animateCounters();
                    obs.disconnect();
                }
            }, { threshold: 0.3 }).observe(strip);
        } else if (strip) {
            animateCounters();
        }
    })();
    </script>
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

    <section class="space-top space-bottom" id="service-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
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
            <div class="row g-4 justify-content-center">
                @if($services)
                    @foreach ($services as $key => $service)
                        <div class="col-xl-3 col-lg-4 col-md-6">
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
                                    <p class="svc-card-text">
                                        {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($service->description)), 120, '...') }}
                                    </p>
                                    <a wire:navigate href="/service/details/{{ $service->slug }}" class="svc-card-link">
                                        Read More <i class="fas fa-arrow-right ms-1"></i>
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
                height: 210px;
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
                padding: 20px 22px 22px;
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }
            #service-sec .svc-card-title {
                font-size: 1.05rem;
                font-weight: 700;
                color: #0f172a;
                margin-bottom: 10px;
                line-height: 1.35;
            }
            #service-sec .svc-card-title a {
                color: inherit;
                text-decoration: none;
                transition: color .2s ease;
            }
            #service-sec .svc-card-title a:hover { color: #03A4FC; }
            #service-sec .svc-card-text {
                color: #475569;
                font-size: .9rem;
                line-height: 1.65;
                flex-grow: 1;
                margin-bottom: 16px;
            }
            #service-sec .svc-card-link {
                display: inline-flex;
                align-items: center;
                color: #03A4FC;
                font-size: .88rem;
                font-weight: 600;
                text-decoration: none;
                gap: 4px;
                transition: gap .2s ease, color .2s ease;
            }
            #service-sec .svc-card-link:hover {
                gap: 8px;
                color: #025ea8;
            }
            @media (max-width: 575.98px) {
                #service-sec .svc-card-img { height: 180px; }
            }
        </style>
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
