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

    @if($whoWeAre)
    <div class="space" id="about-sec">
        <div class="container">

            {{-- ── Row 1: Background image with foreground text card ── --}}
            <div class="row">
                <div class="col-12">
                    @php
                        $aboutDescriptionHtml = html_entity_decode($whoWeAre->description ?? '');
                    @endphp
                    <section class="about-hero-stage mb-4" style="--about-hero-bg: url('{{ $whoWeAre->image_path ? asset('storage/'.$whoWeAre->image_path) : asset('assets/img/default/about.jpg') }}');">
                        <div class="about-hero-overlay"></div>

                        @if(!empty($whoWeAre->secondary_image_path))
                            <div class="about-hero-secondary d-none d-lg-block">
                                <img src="{{ asset('storage/'.$whoWeAre->secondary_image_path) }}" alt="ClearKamo team">
                            </div>
                        @endif

                        <div class="about-hero-content">
                            <span class="sub-title text-primary">
                                <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                                WHO WE ARE
                                <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                            </span>

                            <div class="about-description-text about-typing-wrap mt-2">
                                <div class="about-description-source d-none">{!! $aboutDescriptionHtml !!}</div>
                                <div class="about-typewriter" data-type-speed="14" aria-live="polite"></div>
                                <noscript>
                                    <div class="about-description-fallback">{!! $aboutDescriptionHtml !!}</div>
                                </noscript>
                            </div>

                            <div class="about-hero-footer">
                                <a wire:navigate href="{{ route('about-us') }}" class="about-readmore-link">
                                    Learn More About Us <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                                <div class="about-exp-badge">
                                    <span class="about-exp-num">{{ $whoWeAre->years_of_experience ?? 25 }}+</span>
                                    <span class="about-exp-label">Years of<br>Experience</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            {{-- ── Row 2: Mission/Vision/Core (left) + Video (right) ── --}}
            <div class="row gy-4 mt-2" id="media-row">
                <div class="col-lg-6">
                    <div class="mission-vision-core-values h-100">
                        <div class="mb-4">
                            <h4 class="text-primary mb-3" style="font-weight: 700; font-size: 1.15rem;">
                                <i class="fas fa-bullseye me-2"></i>Mission
                            </h4>
                            <p style="color: #475569; line-height: 1.75; margin-bottom: 0;">
                                To apply decision science and systems design to help organizations define long-term strategies and translate them into clear, executable decisions that deliver reliable results under real-world conditions.
                            </p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-primary mb-3" style="font-weight: 700; font-size: 1.15rem;">
                                <i class="fas fa-eye me-2"></i>Vision
                            </h4>
                            <p style="color: #475569; line-height: 1.75; margin-bottom: 0;">
                                To be partner of choice for organizations seeking dependable execution and sustained results.
                            </p>
                        </div>
                        <div>
                            <h4 class="text-primary mb-3" style="font-weight: 700; font-size: 1.15rem;">
                                <i class="fas fa-gem me-2"></i>Core Values
                            </h4>
                            <p style="color: #475569; line-height: 1.75; margin-bottom: 0;">
                                Community/Customer-centred; Local relevance with global reach; Evidence-based practice; Accountable results; Responsible innovation.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    @if($whoWeAreVideoEmbedUrl)
                        <div class="about-video-cinema h-100">
                            <div class="about-video-cinema-inner h-100">
                                <div class="about-video-cinema-label">
                                    <span class="about-video-dot"></span>
                                    Watch Our Story
                                </div>
                                <div class="about-video-frame">
                                    <iframe
                                        src="{{ $whoWeAreVideoEmbedUrl }}"
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
                                        <p class="mt-3 mb-0 opacity-75">Add a YouTube URL in the admin <strong>Who We Are</strong> panel to display a video here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <style>
            #about-sec {
                background: #f8fafc;
                padding-top: 40px;
                padding-bottom: 40px;
            }

            #about-sec .about-hero-stage {
                position: relative;
                min-height: 520px;
                border-radius: 26px;
                overflow: hidden;
                padding: 34px;
                display: flex;
                align-items: center;
                box-shadow: 0 24px 50px rgba(15, 23, 42, 0.2);
                background-image:
                    linear-gradient(120deg, rgba(8, 14, 26, 0.9) 0%, rgba(12, 22, 38, 0.7) 56%, rgba(12, 22, 38, 0.35) 100%),
                    var(--about-hero-bg);
                background-size: cover;
                background-position: center;
            }
            #about-sec .about-hero-overlay {
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at 12% 20%, rgba(3, 164, 252, 0.16), transparent 42%);
                pointer-events: none;
            }
            #about-sec .about-hero-content {
                position: relative;
                z-index: 2;
                width: clamp(320px, 33%, 460px);
                max-width: 34%;
                background: transparent;
                border: 0;
                border-radius: 0;
                padding: 8px 0 0;
                backdrop-filter: none;
                box-shadow: none;
            }
            #about-sec .about-description-text {
                color: rgba(241, 245, 249, 0.95);
                font-size: 1.02rem;
                line-height: 1.85;
                text-shadow: 0 1px 2px rgba(2, 6, 23, 0.55);
            }
            #about-sec .about-description-text p {
                margin-bottom: 1rem;
            }
            #about-sec .about-description-text p:last-child {
                margin-bottom: 0;
            }
            #about-sec .about-typewriter {
                white-space: pre-line;
            }
            #about-sec .about-typing-wrap.is-typing .about-typewriter::after {
                content: '|';
                margin-left: 2px;
                color: #03A4FC;
                font-weight: 700;
                animation: aboutTypingCursor 0.75s steps(1) infinite;
            }
            #about-sec .about-typing-wrap.is-typed .about-typewriter::after {
                display: none;
            }
            @keyframes aboutTypingCursor {
                0%, 49% { opacity: 1; }
                50%, 100% { opacity: 0; }
            }
            #about-sec .about-hero-secondary {
                position: absolute;
                right: 24px;
                bottom: 24px;
                width: 240px;
                border-radius: 16px;
                overflow: hidden;
                border: 3px solid rgba(255, 255, 255, 0.9);
                box-shadow: 0 14px 30px rgba(15, 23, 42, 0.32);
                z-index: 3;
                animation: aboutSecondaryFloat 6s ease-in-out infinite;
            }
            #about-sec .about-hero-secondary img {
                width: 100%;
                height: 140px;
                object-fit: cover;
                display: block;
            }
            @keyframes aboutSecondaryFloat {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-8px); }
            }

            #about-sec .about-hero-footer {
                margin-top: 16px;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 16px;
                flex-wrap: wrap;
            }
            #about-sec .about-exp-badge {
                background: linear-gradient(135deg, #03A4FC, #0284c7);
                color: #fff;
                border-radius: 16px;
                padding: 12px 16px;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 12px 24px rgba(3, 164, 252, 0.28);
            }
            #about-sec .about-exp-num {
                font-size: 1.8rem;
                font-weight: 800;
                line-height: 1;
                letter-spacing: -0.02em;
                color: #fff;
            }
            #about-sec .about-exp-label {
                font-size: 0.74rem;
                font-weight: 700;
                line-height: 1.25;
                letter-spacing: 0.03em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.95);
            }

            #about-sec .about-readmore-link {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 0.98rem;
                font-weight: 700;
                color: #7fd0ff;
                text-decoration: none;
                transition: gap 0.2s ease, color 0.2s ease;
                text-shadow: 0 1px 2px rgba(2, 6, 23, 0.55);
            }
            #about-sec .about-readmore-link:hover {
                gap: 12px;
                color: #03A4FC;
            }

            #about-sec #media-row {
                margin-top: 36px;
            }
            #about-sec .mission-vision-core-values {
                background: rgba(226, 232, 240, 0.45);
                border-left: 4px solid #03A4FC;
                border-radius: 20px;
                padding: 28px 28px 26px;
            }
            #about-sec .mission-vision-core-values p {
                color: #475569 !important;
            }

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
                50% { box-shadow: 0 0 0 6px rgba(3,164,252,0.14); }
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

            @media (max-width: 1199.98px) {
                #about-sec .about-hero-stage {
                    min-height: 480px;
                    padding: 28px;
                }
                #about-sec .about-hero-content {
                    width: clamp(300px, 42%, 430px);
                    max-width: 45%;
                }
            }
            @media (max-width: 991.98px) {
                #about-sec .about-hero-stage {
                    min-height: 440px;
                    padding: 22px;
                    border-radius: 20px;
                }
                #about-sec .about-hero-content {
                    width: 100%;
                    max-width: 100%;
                    padding: 4px 0 0;
                }
                #about-sec .about-hero-secondary {
                    width: 190px;
                    right: 14px;
                    bottom: 14px;
                }
                #about-sec .about-hero-secondary img {
                    height: 116px;
                }
                #about-sec .mission-vision-core-values {
                    padding: 24px 22px;
                }
            }
            @media (max-width: 575.98px) {
                #about-sec {
                    padding-top: 22px;
                    padding-bottom: 22px;
                }
                #about-sec .about-description-text {
                    font-size: 0.98rem;
                    line-height: 1.78;
                }
                #about-sec .about-hero-stage {
                    min-height: auto;
                    padding: 14px;
                    border-radius: 16px;
                }
                #about-sec .about-hero-content {
                    padding: 0;
                    border-radius: 0;
                }
                #about-sec .about-hero-secondary {
                    display: none !important;
                }
                #about-sec .about-hero-footer {
                    gap: 12px;
                }
                #about-sec .about-exp-badge {
                    padding: 10px 14px;
                    border-radius: 14px;
                    gap: 6px;
                }
                #about-sec .about-exp-num {
                    font-size: 1.4rem;
                }
                #about-sec .about-exp-label {
                    font-size: 0.64rem;
                }
                #about-sec .mission-vision-core-values {
                    border-radius: 16px;
                    padding: 18px 16px;
                }
            }
        </style>

        <script>
            (function () {
                function extractWhoWeAreText(source) {
                    const paragraphs = Array.from(source.querySelectorAll('p'))
                        .map((p) => p.textContent.trim())
                        .filter(Boolean);

                    if (paragraphs.length) {
                        return paragraphs.join('\n\n');
                    }

                    return (source.textContent || '').trim();
                }

                function initWhoWeAreTyping() {
                    const wraps = document.querySelectorAll('#about-sec .about-typing-wrap');
                    if (!wraps.length) {
                        return;
                    }

                    wraps.forEach((wrap) => {
                        if (wrap.dataset.typingReady === '1') {
                            return;
                        }

                        wrap.dataset.typingReady = '1';
                        const source = wrap.querySelector('.about-description-source');
                        const target = wrap.querySelector('.about-typewriter');
                        if (!source || !target) {
                            return;
                        }

                        const fullText = extractWhoWeAreText(source);
                        if (!fullText) {
                            return;
                        }

                        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                        if (prefersReducedMotion) {
                            target.textContent = fullText;
                            wrap.classList.add('is-typed');
                            return;
                        }

                        const startTyping = () => {
                            if (wrap.dataset.typed === '1') {
                                return;
                            }
                            wrap.dataset.typed = '1';
                            wrap.classList.add('is-typing');

                            let index = 0;
                            const speed = parseInt(target.dataset.typeSpeed || '14', 10);

                            const tick = () => {
                                index += 1;
                                target.textContent = fullText.slice(0, index);

                                if (index < fullText.length) {
                                    window.setTimeout(tick, speed);
                                } else {
                                    wrap.classList.remove('is-typing');
                                    wrap.classList.add('is-typed');
                                }
                            };

                            tick();
                        };

                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach((entry) => {
                                if (entry.isIntersecting) {
                                    startTyping();
                                    observer.disconnect();
                                }
                            });
                        }, { threshold: 0.35 });

                        observer.observe(wrap);
                    });
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initWhoWeAreTyping);
                } else {
                    initWhoWeAreTyping();
                }

                document.addEventListener('livewire:navigated', initWhoWeAreTyping);
            })();
        </script>
    </div>
    @endif


    <section class="space-top space-bottom" id="service-sec">
        <div class="container">
            @php
                $serviceCount = $services ? $services->count() : 0;
            @endphp
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
            <div class="row g-4 justify-content-center svc-row svc-row-{{ $serviceCount }}">
                @if($services)
                    @foreach ($services as $key => $service)
                        @php
                            $serviceColClass = match (true) {
                                $serviceCount <= 1 => 'col-12 col-md-10 col-lg-8',
                                $serviceCount === 2 => 'col-12 col-md-6 col-lg-6',
                                default => 'col-xl-4 col-lg-6 col-md-6',
                            };
                        @endphp
                        <div class="{{ $serviceColClass }}">
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
            #service-sec .svc-row {
                margin-left: auto;
                margin-right: auto;
            }
            #service-sec .svc-row-1 {
                max-width: 860px;
            }
            #service-sec .svc-row-2 {
                max-width: 1260px;
            }
            #service-sec .svc-row-2 .svc-card-img {
                height: 340px;
            }
            #service-sec .svc-row-1 .svc-card-img {
                height: 360px;
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

    {{-- ── Gallery Section (moved before team) ─────────────────── --}}
    @if($galleryProjects && $galleryProjects->count())
    <section class="space-top space-bottom" id="home-gallery-sec">
        @php
            $galleryItems = $galleryProjects->flatMap(function ($project) {
                return $project->galleryPhotos->map(function ($photo) use ($project) {
                    return [
                        'image' => $photo->image,
                        'caption' => $photo->caption,
                        'project' => $project->title,
                    ];
                });
            })->values();
            $galleryScrollDuration = max(42, $galleryItems->count() * 5);
        @endphp
        <div class="container">
            <div class="title-area text-center mb-4 sr-fade-up">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">OUR GALLERY
                    <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                </span>
            </div>
            @if($galleryItems->count())
                <div class="gallery-train" style="--gallery-train-duration: {{ $galleryScrollDuration }}s;">
                    <div class="gallery-train-track">
                        @foreach($galleryItems as $item)
                            <article class="gallery-train-item">
                                <img src="{{ asset('storage/'.$item['image']) }}"
                                     alt="{{ $item['caption'] ?: $item['project'] }}"
                                     loading="lazy">
                            </article>
                        @endforeach
                        @foreach($galleryItems as $item)
                            <article class="gallery-train-item" aria-hidden="true">
                                <img src="{{ asset('storage/'.$item['image']) }}"
                                     alt="{{ $item['caption'] ?: $item['project'] }}"
                                     loading="lazy">
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <style>
            #home-gallery-sec {
                padding-top: 46px;
                padding-bottom: 46px;
                background: #f8fafc;
            }
            #home-gallery-sec .gallery-train {
                position: relative;
                overflow: hidden;
                border-radius: 20px;
                padding: 8px 0;
            }
            #home-gallery-sec .gallery-train::before,
            #home-gallery-sec .gallery-train::after {
                content: "";
                position: absolute;
                top: 0;
                width: 90px;
                height: 100%;
                z-index: 3;
                pointer-events: none;
            }
            #home-gallery-sec .gallery-train::before {
                left: 0;
                background: linear-gradient(to right, #f8fafc 28%, rgba(248, 250, 252, 0));
            }
            #home-gallery-sec .gallery-train::after {
                right: 0;
                background: linear-gradient(to left, #f8fafc 28%, rgba(248, 250, 252, 0));
            }
            #home-gallery-sec .gallery-train-track {
                display: flex;
                gap: 16px;
                width: max-content;
                animation: galleryTrainScroll var(--gallery-train-duration) linear infinite;
            }
            #home-gallery-sec .gallery-train:hover .gallery-train-track {
                animation-play-state: paused;
            }
            #home-gallery-sec .gallery-train-item {
                flex: 0 0 300px;
                height: 190px;
                border-radius: 16px;
                overflow: hidden;
                position: relative;
                box-shadow: 0 12px 24px rgba(15, 23, 42, 0.15);
                border: 1px solid rgba(3, 164, 252, 0.25);
                background: #0f172a;
            }
            #home-gallery-sec .gallery-train-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .35s ease;
            }
            #home-gallery-sec .gallery-train-item:hover img {
                transform: scale(1.06);
            }
            #home-gallery-sec .gallery-train-overlay {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                padding: 12px 14px 10px;
                background: linear-gradient(to top, rgba(12, 29, 53, 0.92) 0%, rgba(12, 29, 53, 0.1) 100%);
            }
            #home-gallery-sec .gallery-train-project {
                display: inline-block;
                font-size: .7rem;
                font-weight: 700;
                color: #7dd3fc;
                text-transform: uppercase;
                letter-spacing: .08em;
                margin-bottom: 4px;
            }
            #home-gallery-sec .gallery-train-caption {
                margin: 0;
                font-size: .82rem;
                line-height: 1.35;
                color: #f8fafc;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            @keyframes galleryTrainScroll {
                from { transform: translateX(0); }
                to { transform: translateX(calc(-50% - 8px)); }
            }
            @media (max-width: 991.98px) {
                #home-gallery-sec .gallery-train-item {
                    flex-basis: 250px;
                    height: 168px;
                }
            }
            @media (max-width: 575.98px) {
                #home-gallery-sec {
                    padding-top: 34px;
                    padding-bottom: 34px;
                }
                #home-gallery-sec .gallery-train::before,
                #home-gallery-sec .gallery-train::after {
                    width: 36px;
                }
                #home-gallery-sec .gallery-train-item {
                    flex-basis: 210px;
                    height: 146px;
                    border-radius: 12px;
                }
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
    var AUTO_HIDE_MS = 2 * 60 * 1000; // 2 minutes
    var trigger = {{ (int)$ceoMessage->scroll_trigger_percent }};
    var popup   = document.getElementById('ceo-popup');
    var closeBtn = document.getElementById('ceo-popup-close-btn');
    var shown   = false;
    var dismissed = sessionStorage.getItem('ceo_popup_dismissed') === '1';
    var autoHideTimer = null;

    if (dismissed || !popup) return;

    function dismissPopup() {
        if (dismissed || !popup) return;
        popup.classList.remove('ceo-popup-visible');
        dismissed = true;
        sessionStorage.setItem('ceo_popup_dismissed', '1');
        if (autoHideTimer) {
            clearTimeout(autoHideTimer);
            autoHideTimer = null;
        }
        window.removeEventListener('scroll', checkScroll);
    }

    function startAutoHideCountdown() {
        if (autoHideTimer) {
            clearTimeout(autoHideTimer);
        }
        autoHideTimer = setTimeout(function () {
            dismissPopup();
        }, AUTO_HIDE_MS);
    }

    function checkScroll() {
        if (shown || dismissed) return;
        var totalScrollable = document.documentElement.scrollHeight - window.innerHeight;
        if (totalScrollable <= 0) return;
        var scrolled = (window.scrollY / totalScrollable) * 100;
        if (scrolled >= trigger) {
            popup.classList.add('ceo-popup-visible');
            shown = true;
            startAutoHideCountdown();
        }
    }

    window.addEventListener('scroll', checkScroll, { passive: true });
    checkScroll();

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            dismissPopup();
        });
    }
})();
</script>
@endif

</div>
