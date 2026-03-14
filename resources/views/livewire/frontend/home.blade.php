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
            <div class="row align-items-center gy-5">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-media-stack">
                        <div class="about-media-main">
                            <img src="{{ asset('storage/'.$about->image) }}" alt="About ClearKamo">
                        </div>
                        @if(!empty($about->image2))
                            <div class="about-media-secondary d-none d-lg-block">
                                <img src="{{ asset('storage/'.$about->image2) }}" alt="ClearKamo team">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="title-area mb-4">
                        <span class="sub-title text-primary">
                            <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                            WHO WE ARE
                            <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                        </span>
                        <h3 class="sec-title">{{ $about->title }}</h3>
                        <div class="sec-text about-description-text">{!! $about->description !!}</div>
                    </div>
                    {{-- YouTube video --}}
                    @if($aboutVideoEmbedUrl)
                        <div class="about-video-wrap">
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
                        <div class="about-video-wrap about-video-placeholder d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <i class="fas fa-play-circle about-video-placeholder-icon"></i>
                                <p class="mt-3 mb-0">Add a YouTube URL in the admin <strong>About Us</strong> panel to display a video here.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── Row 2: Mission & Vision cards ─────────────────────────────── --}}
            <div class="row gy-4 about-mv-row">
                <div class="col-md-6">
                    <div class="about-mv-card">
                        <div class="about-mv-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4 class="about-mv-title">Our Mission</h4>
                        <p class="about-mv-text">To apply decision science and systems design to help organizations define long-term strategies and translate them into clear, executable decisions that deliver reliable results under real-world conditions.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-mv-card about-mv-card--vision">
                        <div class="about-mv-icon about-mv-icon--vision">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="about-mv-title">Our Vision</h4>
                        <p class="about-mv-text">To be the partner of choice for organizations seeking dependable execution and sustained results across Africa and beyond.</p>
                    </div>
                </div>
            </div>

            {{-- ── Row 3: Core Values ──────────────────────────────────────────── --}}
            <div class="about-cv-section">
                <div class="text-center about-cv-header">
                    <span class="sub-title text-primary">
                        <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                        Our Core Values
                        <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                    </span>
                </div>
                <div class="row gy-4 justify-content-center">
                    @if($coreValues && $coreValues->count())
                        @foreach($coreValues as $cv)
                        <div class="col-xl-4 col-md-6">
                            <div class="about-cv-card">
                                <div class="about-cv-icon">
                                    <i class="fas {{ $cv->icon ?? 'fa-star' }}"></i>
                                </div>
                                <h5 class="about-cv-title">{{ $cv->title }}</h5>
                                <p class="about-cv-text">{{ $cv->summary }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-xl-4 col-md-6">
                            <div class="about-cv-card">
                                <div class="about-cv-icon"><i class="fas fa-users"></i></div>
                                <h5 class="about-cv-title">Community-Centred</h5>
                                <p class="about-cv-text">We put community and customer needs at the heart of every solution we design and deliver.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="about-cv-card">
                                <div class="about-cv-icon"><i class="fas fa-microscope"></i></div>
                                <h5 class="about-cv-title">Evidence-Based Practice</h5>
                                <p class="about-cv-text">Our decisions and recommendations are grounded in data, research, and proven methodologies.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="about-cv-card">
                                <div class="about-cv-icon"><i class="fas fa-shield-alt"></i></div>
                                <h5 class="about-cv-title">Accountable Results</h5>
                                <p class="about-cv-text">We take full ownership of our commitments and measure success by tangible, lasting outcomes.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="about-cv-card">
                                <div class="about-cv-icon"><i class="fas fa-globe-africa"></i></div>
                                <h5 class="about-cv-title">Local Relevance, Global Reach</h5>
                                <p class="about-cv-text">We ground our work in African realities while applying internationally recognised standards of practice.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="about-cv-card">
                                <div class="about-cv-icon"><i class="fas fa-lightbulb"></i></div>
                                <h5 class="about-cv-title">Responsible Innovation</h5>
                                <p class="about-cv-text">We embrace creative solutions that are ethical, sustainable, and appropriate to context.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <style>
            /* ── About Section ───────────────────────────────────────────────── */
            #about-sec {
                background: #f8fafc;
                padding-top: 80px;
                padding-bottom: 80px;
            }

            /* Image stack */
            #about-sec .about-media-stack {
                position: relative;
                max-width: 520px;
                margin: 0 auto;
                padding-bottom: 30px;
            }
            #about-sec .about-media-main img {
                width: 100%;
                height: 420px;
                object-fit: cover;
                border-radius: 18px;
                box-shadow: 0 20px 48px rgba(15, 23, 42, 0.16);
            }
            #about-sec .about-media-secondary {
                position: absolute;
                right: -24px;
                bottom: 0;
                width: 55%;
                z-index: 2;
                animation: aboutFloat 5s ease-in-out infinite;
            }
            #about-sec .about-media-secondary img {
                width: 100%;
                height: 190px;
                object-fit: cover;
                border-radius: 14px;
                box-shadow: 0 12px 28px rgba(15, 23, 42, 0.18);
                border: 4px solid #fff;
            }

            /* Description text */
            #about-sec .about-description-text {
                color: #475569;
                line-height: 1.8;
                font-size: 1rem;
            }
            #about-sec .about-description-text p { margin-bottom: 0.6rem; }
            #about-sec .about-description-text p:last-child { margin-bottom: 0; }

            /* Video */
            #about-sec .about-video-wrap {
                width: 100%;
                aspect-ratio: 16 / 9;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 16px 44px rgba(15, 23, 42, 0.18);
                background: #0f172a;
                margin-top: 4px;
            }
            #about-sec .about-video-wrap iframe {
                width: 100%;
                height: 100%;
                border: 0;
                display: block;
            }
            #about-sec .about-video-placeholder {
                color: #64748b;
                font-size: 0.95rem;
                background: #e2e8f0;
                min-height: 240px;
                border-radius: 16px;
            }
            #about-sec .about-video-placeholder-icon {
                font-size: 3.5rem;
                color: #94a3b8;
            }

            /* ── Mission / Vision cards ──────────────────────────────────────── */
            #about-sec .about-mv-row {
                margin-top: 56px;
            }
            #about-sec .about-mv-card {
                background: #fff;
                border-radius: 18px;
                padding: 38px 34px;
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

            /* ── Responsive ──────────────────────────────────────────────────── */
            @media (max-width: 1199.98px) {
                #about-sec .about-media-stack  { max-width: 460px; }
                #about-sec .about-media-main img { height: 360px; }
            }
            @media (max-width: 991.98px) {
                #about-sec .about-media-stack  { max-width: 100%; padding-bottom: 28px; }
                #about-sec .about-media-main img { height: 280px; }
                #about-sec .about-media-secondary { right: 0; bottom: 0; }
            }
            @media (max-width: 575.98px) {
                #about-sec { padding-top: 52px; padding-bottom: 52px; }
                #about-sec .about-media-main img { height: 220px; }
                #about-sec .about-mv-row { margin-top: 40px; }
                #about-sec .about-cv-section { margin-top: 40px; }
                #about-sec .about-mv-card,
                #about-sec .about-cv-card { padding: 26px 22px; }
            }
        </style>
    </div>
    @endif

    {{-- ── Impact Stats Strip ──────────────────────────────────── --}}
    @if($about)
    <div id="stats-strip">
        <div class="container">
            <div class="row gy-3 justify-content-center text-center">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num" data-target="{{ $about->ex_years ?? 25 }}">0</span><span class="stat-suffix">+</span>
                        <p class="stat-label">Years of Experience</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num" data-target="{{ $projectsCount }}">0</span><span class="stat-suffix">+</span>
                        <p class="stat-label">Projects Delivered</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num" data-target="{{ $partnersCount }}">0</span><span class="stat-suffix">+</span>
                        <p class="stat-label">Partner Organizations</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num" data-target="98">0</span><span class="stat-suffix">%</span>
                        <p class="stat-label">Client Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #stats-strip {
            background: linear-gradient(135deg, #03A4FC 0%, #025ea8 100%);
            padding: 52px 0;
        }
        #stats-strip .stat-item {
            color: #fff;
            padding: 0 12px;
        }
        #stats-strip .stat-num {
            font-size: clamp(2.4rem, 5vw, 3.4rem);
            font-weight: 800;
            line-height: 1;
            display: inline;
        }
        #stats-strip .stat-suffix {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            line-height: 1;
            margin-left: 2px;
        }
        #stats-strip .stat-label {
            margin: 8px 0 0;
            font-size: .88rem;
            font-weight: 500;
            color: rgba(255,255,255,.82);
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        /* Vertical dividers on desktop */
        #stats-strip .col-md-3:not(:last-child) .stat-item {
            border-right: 1px solid rgba(255,255,255,.25);
        }
        @media (max-width: 767.98px) {
            #stats-strip .col-md-3:not(:last-child) .stat-item {
                border-right: none;
            }
            #stats-strip { padding: 36px 0; }
        }
    </style>
    <script>
    (function(){
        function animateCounters() {
            document.querySelectorAll('#stats-strip .stat-num').forEach(function(el) {
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

        var strip = document.getElementById('stats-strip');
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
