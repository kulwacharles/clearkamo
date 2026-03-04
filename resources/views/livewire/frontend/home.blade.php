{{-- @section('title',$title)
@section('description',$seodescription)
@section('keywords',$keywords) --}}
<div>
    <!-- Hero Slider Section -->
    @if($slides && $slides->count() > 0)
    <section class="hero-slider-section" style="position: relative; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
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
                            <div class="gradient-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(59,130,246,0.3) 0%, rgba(147,51,234,0.2) 50%, rgba(0,0,0,0.5) 100%);"></div>
                        @endif
                        <div class="slider-content" style="position: relative; z-index: 2; height: 100%; display: flex; align-items: flex-end; justify-content: center; padding-bottom: 120px;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 mx-auto text-center">
                                        <div class="slider-text" style="color: white; animation: fadeInUp 1.2s ease-out;">
                                            <div class="slider-cta" style="margin-top: 30px;">
                                                <a href="{{ route('services') }}" class="slider-btn" style="display: inline-block; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 15px 40px; border-radius: 50px; font-size: 1rem; font-weight: 600; text-decoration: none; box-shadow: 0 10px 30px rgba(59,130,246,0.4); transform: translateY(0); transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;">
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
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%) !important;
            color: white !important;
            transform: translateY(-50%) scale(1.1);
        }
        
        .slider-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(59,130,246,0.6);
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
    <div class="space" id="about-sec" style="overflow: visible;">
        <div class="container" style="overflow: visible;">
            <div class="row align-items-center" style="overflow: visible;">
                <div class="col-xl-6 mb-50 mb-xl-0" style="overflow: visible;">
                    <div class="img-box4 position-relative" style="overflow: visible;">
                        <div class="img1">
                            <img src="{{ asset('storage/'.$about->image) }}" alt="About" class="img-fluid rounded-3 shadow-lg border-4 border-white">
                        </div>
                        <div class="img2 jump-reverse position-absolute" style="top: 20%; left: 70%; transform: translate(-10%, -15%); width: 90%; z-index: 2;">
                            <img src="{{ asset('storage/'.$about->image2) }}" alt="About" class="img-fluid rounded-3 shadow-lg border-4 border-white">
                        </div>
                        <div class="shape-mockup jump d-none d-xl-block position-absolute" style="top: 0px; left: -50px; z-index: 1;">
                            <div class="border-primary border-4" style="height: 180px; width: 3px;"></div>
                            <div class="bg-primary rounded-circle mx-auto" style="width: 12px; height: 12px; margin-top: 10px;"></div>
                            <div class="border-primary border-4" style="height: 180px; width: 3px;"></div>
                        </div>
                        <div class="shape-mockup jump-reverse d-none d-xl-block position-absolute" style="top: 20%; right: -100px; z-index: 3;">
                            <div class="d-flex flex-wrap" style="width: 60px;">
                                @for ($i = 0; $i < 24; $i++)
                                    <div class="bg-primary rounded-circle m-1" style="width: 4px; height: 4px;"></div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
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
                            <div class="mission-vision-core-values" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 30px; border-radius: 15px; border-left: 4px solid #3b82f6;">
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
                        <div class="col-lg-4">
                            <div class="year-counter style2" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); padding: 40px 30px; border-radius: 15px; text-align: center; color: white;">
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
            <p>
                At CLEARKAMO, we focus on strengthening execution performance in complex systems. We help organizations move from strategic intent to reliable, measurable results by designing decision environments that support consistent follow-through.
            </p>
        </div>
        <div class="focus-areas-container" style="position: relative;">
        <div class="focus-areas-scroll" style="overflow-x: auto; padding: 20px 60px;">
            <div class="d-flex flex-row" style="gap: 20px; min-width: max-content;">
                <div class="process-card" style="height: auto; min-height: 280px; width: 320px; flex-shrink: 0; cursor: pointer; text-align: left;" onclick="toggleCard(this)">
                    <p class="box-number">01</p>
                    <div class="box-content">
                        <div class="box-icon">
                            <i class="fas fa-tasks" style="font-size: 48px; color: #3b82f6;"></i>
                        </div>
                        <h3 class="box-title">Execution Performance & Delivery Reliability</h3>
                        <div class="box-text" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 10px;">Strategies often fail not because they are wrong, but because execution breaks down. We strengthen the systems, management routines, and decision clarity required to ensure strategies perform under real-world conditions.</p>
                            <div class="expandable-content" style="display: none;">
                                <p style="margin-bottom: 5px;"><strong>We focus on:</strong></p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">Reducing variance in delivery performance</li>
                                    <li style="margin-bottom: 5px;">Improving value for money</li>
                                    <li style="margin-bottom: 5px;">Protecting results during scale</li>
                                    <li style="margin-bottom: 0;">Strengthening coordination across actors</li>
                                </ul>
                            </div>
                            <button class="expand-btn" style="color: #3b82f6; font-weight: 600; border: none; background: none; padding: 5px 0; cursor: pointer;">
                                <span class="expand-text">Read More</span> <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="process-card" style="height: auto; min-height: 280px; width: 320px; flex-shrink: 0; cursor: pointer; text-align: left;" onclick="toggleCard(this)">
                    <p class="box-number">02</p>
                    <div class="box-content">
                        <div class="box-icon">
                            <i class="fas fa-brain" style="font-size: 48px; color: #3b82f6;"></i>
                        </div>
                        <h3 class="box-title">Agency & Decision Environment Design</h3>
                        <div class="box-text" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 10px;">We operationalize the "agency" side of human capital — motivation, perseverance, follow-through, and management quality.</p>
                            <div class="expandable-content" style="display: none;">
                                <p style="margin-bottom: 5px;"><strong>Through diagnostics and systems redesign, we:</strong></p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">Map critical decision points across delivery chains</li>
                                    <li style="margin-bottom: 5px;">Align incentives and governance structures</li>
                                    <li style="margin-bottom: 5px;">Simplify workflows and user journeys</li>
                                    <li style="margin-bottom: 5px;">Install lightweight management routines</li>
                                    <li style="margin-bottom: 5px;">Design practical execution telemetry</li>
                                </ul>
                                <p style="margin-bottom: 0; margin-top: 10px;">This ensures people can consistently apply their skills and deliver results.</p>
                            </div>
                            <button class="expand-btn" style="color: #3b82f6; font-weight: 600; border: none; background: none; padding: 5px 0; cursor: pointer;">
                                <span class="expand-text">Read More</span> <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="process-card" style="height: auto; min-height: 280px; width: 320px; flex-shrink: 0; cursor: pointer; text-align: left;" onclick="toggleCard(this)">
                    <p class="box-number">03</p>
                    <div class="box-content">
                        <div class="box-icon">
                            <i class="fas fa-lightbulb" style="font-size: 48px; color: #3b82f6;"></i>
                        </div>
                        <h3 class="box-title">Think–Do Integrated Strategy Architecture</h3>
                        <div class="box-text" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 10px;">We operate through an integrated Think–Do model for execution-ready strategies.</p>
                            <div class="expandable-content" style="display: none;">
                                <p style="margin-bottom: 5px;"><strong>THINK: Agency & Systems Design</strong></p>
                                <p style="margin-bottom: 5px;">We design execution-ready strategies by:</p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">Conducting stakeholder and decision diagnostics</li>
                                    <li style="margin-bottom: 5px;">Identifying bottlenecks and system frictions</li>
                                    <li style="margin-bottom: 5px;">Redesigning governance and accountability structures</li>
                                    <li style="margin-bottom: 5px;">Validating feasibility before scale</li>
                                </ul>
                                <p style="margin-bottom: 5px; margin-top: 10px;"><strong>DO: Implementation Support</strong></p>
                                <p style="margin-bottom: 5px;">We protect results during rollout through:</p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">Delivery stabilization frameworks</li>
                                    <li style="margin-bottom: 5px;">Adaptive management support</li>
                                    <li style="margin-bottom: 5px;">Partner coordination mechanisms</li>
                                    <li style="margin-bottom: 0;">Rapid bottleneck resolution</li>
                                </ul>
                                <p style="margin-bottom: 0; margin-top: 10px;">Strategy and execution are treated as one continuum.</p>
                            </div>
                            <button class="expand-btn" style="color: #3b82f6; font-weight: 600; border: none; background: none; padding: 5px 0; cursor: pointer;">
                                <span class="expand-text">Read More</span> <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="process-card" style="height: auto; min-height: 280px; width: 320px; flex-shrink: 0; cursor: pointer; text-align: left;" onclick="toggleCard(this)">
                    <p class="box-number">04</p>
                    <div class="box-content">
                        <div class="box-icon">
                            <i class="fas fa-users-cog" style="font-size: 48px; color: #3b82f6;"></i>
                        </div>
                        <h3 class="box-title">Behavioural & Choice Architecture at Scale</h3>
                        <div class="box-text" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 10px;">We apply decision science and behavioural design to improve follow-through in large systems.</p>
                            <div class="expandable-content" style="display: none;">
                                <p style="margin-bottom: 5px;"><strong>Our behavioural work includes:</strong></p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">Identity-driven nudges</li>
                                    <li style="margin-bottom: 5px;">Social norm activation</li>
                                    <li style="margin-bottom: 5px;">Incentive framing</li>
                                    <li style="margin-bottom: 5px;">Emotionally intelligent communication platforms</li>
                                    <li style="margin-bottom: 0;">Behaviour adoption models that scale nationally</li>
                                </ul>
                                <p style="margin-bottom: 0; margin-top: 10px;">We focus on turning awareness into sustained action.</p>
                            </div>
                            <button class="expand-btn" style="color: #3b82f6; font-weight: 600; border: none; background: none; padding: 5px 0; cursor: pointer;">
                                <span class="expand-text">Read More</span> <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="process-card" style="height: auto; min-height: 280px; width: 320px; flex-shrink: 0; cursor: pointer; text-align: left;" onclick="toggleCard(this)">
                    <p class="box-number">05</p>
                    <div class="box-content">
                        <div class="box-icon">
                            <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #3b82f6;"></i>
                        </div>
                        <h3 class="box-title">High-Execution-Risk Sectors</h3>
                        <div class="box-text" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 10px;">We work primarily in sectors where delivery complexity is high and accountability for results is increasing.</p>
                            <div class="expandable-content" style="display: none;">
                                <p style="margin-bottom: 5px;"><strong>Key sectors include:</strong></p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">WASH Systems Strengthening</li>
                                    <li style="margin-bottom: 5px;">Public Health & Behaviour Change</li>
                                    <li style="margin-bottom: 5px;">Emergency Risk Communication</li>
                                    <li style="margin-bottom: 5px;">Sanitation Marketing & Access</li>
                                    <li style="margin-bottom: 5px;">Menstrual Health Innovation</li>
                                    <li style="margin-bottom: 5px;">Youth Health & Vaccination Uptake</li>
                                    <li style="margin-bottom: 5px;">Sector Coordination & Governance Reform</li>
                                    <li style="margin-bottom: 0;">Women's Enterprise & Economic Empowerment</li>
                                </ul>
                            </div>
                            <button class="expand-btn" style="color: #3b82f6; font-weight: 600; border: none; background: none; padding: 5px 0; cursor: pointer;">
                                <span class="expand-text">Read More</span> <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="process-card" style="height: auto; min-height: 280px; width: 320px; flex-shrink: 0; cursor: pointer; text-align: left;" onclick="toggleCard(this)">
                    <p class="box-number">06</p>
                    <div class="box-content">
                        <div class="box-icon">
                            <i class="fas fa-handshake" style="font-size: 48px; color: #3b82f6;"></i>
                        </div>
                        <h3 class="box-title">Government & Multi-Actor Delivery Systems</h3>
                        <div class="box-text" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 10px;">We specialize in strengthening coordination, accountability, and execution reliability across fragmented systems.</p>
                            <div class="expandable-content" style="display: none;">
                                <p style="margin-bottom: 5px;"><strong>Our primary partners include:</strong></p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">National and sub-national governments</li>
                                    <li style="margin-bottom: 5px;">Multilateral agencies</li>
                                    <li style="margin-bottom: 5px;">Development partners</li>
                                    <li style="margin-bottom: 5px;">NGOs</li>
                                    <li style="margin-bottom: 0;">Corporates operating in complex delivery environments</li>
                                </ul>
                            </div>
                            <button class="expand-btn" style="color: #3b82f6; font-weight: 600; border: none; background: none; padding: 5px 0; cursor: pointer;">
                                <span class="expand-text">Read More</span> <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="process-card" style="height: auto; min-height: 280px; width: 320px; flex-shrink: 0; cursor: pointer; text-align: left;" onclick="toggleCard(this)">
                    <p class="box-number">07</p>
                    <div class="box-content">
                        <div class="box-icon">
                            <i class="fas fa-shield-alt" style="font-size: 48px; color: #3b82f6;"></i>
                        </div>
                        <h3 class="box-title">Execution Risk Management & Adaptive Delivery</h3>
                        <div class="box-text" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 10px;">We manage execution risk through early diagnostics and continuous adaptation.</p>
                            <div class="expandable-content" style="display: none;">
                                <p style="margin-bottom: 5px;"><strong>Our approach includes:</strong></p>
                                <ul class="box-list" style="margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">Early diagnostics</li>
                                    <li style="margin-bottom: 5px;">Staged validation before rollout</li>
                                    <li style="margin-bottom: 5px;">Continuous adaptation</li>
                                    <li style="margin-bottom: 5px;">Rapid learning cycles</li>
                                    <li style="margin-bottom: 0;">Clear escalation pathways</li>
                                </ul>
                                <p style="margin-bottom: 0; margin-top: 10px;">This ensures strategies remain resilient under real-world constraints.</p>
                            </div>
                            <button class="expand-btn" style="color: #3b82f6; font-weight: 600; border: none; background: none; padding: 5px 0; cursor: pointer;">
                                <span class="expand-text">Read More</span> <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Arrows -->
        <button class="scroll-arrow scroll-left" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: #3b82f6; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center;" onclick="scrollFocusAreas('left')">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="scroll-arrow scroll-right" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: #3b82f6; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center;" onclick="scrollFocusAreas('right')">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    </div>
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
                                <p class="mb-2" style="color: #2563eb; font-weight: 600;">{{ $team->position }}</p>
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

    <script>
    function toggleCard(card) {
        const expandableContent = card.querySelector('.expandable-content');
        const expandBtn = card.querySelector('.expand-btn');
        const expandText = card.querySelector('.expand-text');
        const chevron = card.querySelector('.fa-chevron-down, .fa-chevron-up');
        
        if (expandableContent.style.display === 'none' || !expandableContent.style.display) {
            expandableContent.style.display = 'block';
            expandText.textContent = 'Read Less';
            if (chevron) {
                chevron.classList.remove('fa-chevron-down');
                chevron.classList.add('fa-chevron-up');
            }
        } else {
            expandableContent.style.display = 'none';
            expandText.textContent = 'Read More';
            if (chevron) {
                chevron.classList.remove('fa-chevron-up');
                chevron.classList.add('fa-chevron-down');
            }
        }
    }

    function scrollFocusAreas(direction) {
        const scrollContainer = document.querySelector('.focus-areas-scroll');
        const scrollAmount = 340;
        
        if (direction === 'left') {
            scrollContainer.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        } else {
            scrollContainer.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
    }
    </script>
</div>
