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
            <div id="mainSlider" class="main-slider">
                @foreach($slides as $index => $slide)
                    <div class="slider-slide" style="position: relative; height: 600px; background-size: cover; background-position: center;">
                        @if($slide->image)
                            <div class="slider-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('storage/'.$slide->image) }}'); background-size: cover; background-position: center; background-blend-mode: overlay; background-color: rgba(0,0,0,0.4);"></div>
                            <!-- Gradient Overlay -->
                            <div class="gradient-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(59,130,246,0.3) 0%, rgba(147,51,234,0.2) 50%, rgba(0,0,0,0.5) 100%);"></div>
                        @endif
                        <div class="slider-content" style="position: relative; z-index: 2; height: 100%; display: flex; align-items: center; justify-content: center;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 mx-auto text-center">
                                        <div class="slider-text" style="color: white; animation: fadeInUp 1.2s ease-out;">
                                            @if($slide->group)
                                                <div class="slider-meta" style="margin-bottom: 25px;">
                                                    <span class="slider-category" style="display: inline-block; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 12px 30px; border-radius: 30px; font-size: 0.85rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; box-shadow: 0 8px 25px rgba(59,130,246,0.3); transform: translateY(0); transition: all 0.3s ease;">
                                                        {{ $slide->group }}
                                                    </span>
                                                </div>
                                            @endif
                                            <h1 class="slider-title" style="font-size: 3.5rem; font-weight: 800; margin-bottom: 25px; text-shadow: 3px 3px 6px rgba(0,0,0,0.6); line-height: 1.2; letter-spacing: -1px;">
                                                {{ $slide->title }}
                                            </h1>
                                            <div class="slider-description" style="font-size: 1.3rem; line-height: 1.7; max-width: 650px; margin: 0 auto 35px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); font-weight: 300;">
                                                {!! Str::limit(strip_tags($slide->description), 180, '...') !!}
                                            </div>
                                            <div class="slider-cta" style="margin-top: 30px;">
                                                <button class="slider-btn" style="display: inline-block; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 15px 40px; border-radius: 50px; font-size: 1rem; font-weight: 600; border: none; cursor: pointer; box-shadow: 0 10px 30px rgba(59,130,246,0.4); transform: translateY(0); transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;">
                                                    Learn More
                                                    <i class="fas fa-arrow-right ms-2"></i>
                                                </button>
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
                        <!-- Decorative Elements -->
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
                    <div class="btn-wrap style2 mt-50">
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
                                <i class="fa-solid fa-arrow-up-right ms-3">

                                </i>
                            </div>
                        </a>
                    </div>
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

<script>
function toggleCard(card) {
    const expandableContent = card.querySelector('.expandable-content');
    const expandBtn = card.querySelector('.expand-btn');
    const expandText = card.querySelector('.expand-text');
    const chevron = card.querySelector('.fa-chevron-down');
    
    if (expandableContent.style.display === 'none') {
        expandableContent.style.display = 'block';
        expandText.textContent = 'Read Less';
        chevron.classList.remove('fa-chevron-down');
        chevron.classList.add('fa-chevron-up');
    } else {
        expandableContent.style.display = 'none';
        expandText.textContent = 'Read More';
        chevron.classList.remove('fa-chevron-up');
        chevron.classList.add('fa-chevron-down');
    }
}

function scrollFocusAreas(direction) {
    const scrollContainer = document.querySelector('.focus-areas-scroll');
    const scrollAmount = 340; // Card width + gap
    
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
<section class="space overflow-hidden bg-smoke2" id="service-sec">
    <div class="shape-mockup moving" data-top="0" data-left="0">
        <img src="assets/img/shape/service-bg-shape4-1.png" alt="shape">
    </div>
    <div class="shape-mockup movingX" data-bottom="0" data-right="0">
        <img src="assets/img/shape/service-bg-shape4-2.png" alt="shape">
    </div>
    <div class="why-sec-1 overflow-hidden" data-bg-src="assets/img/shape/why-shape-1-1.svg">

</div>
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
                            {{-- <div class="service-card-icon">
                                <img src="assets/img/icon/service_card_4-1.svg" alt="Icon">
                            </div> --}}
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
<!-- <section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="title-area text-center">
                    <span class="sub-title">
                        <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">PORTFOLIO
                        <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                    </span>
                    <h2 class="sec-title">We're proud of the Same works</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="project-filter-btn filter-menu indicator-active filter-menu-active">
                    <button data-filter="*" class="tab-btn active" type="button">All Projects</button>
                     <button data-filter=".cat1" class="tab-btn" type="button">UI/UX</button> 
                     <button data-filter=".cat2" class="tab-btn" type="button">Branding</button> 
                     <button data-filter=".cat3" class="tab-btn" type="button">Web Design</button>
                      <button data-filter=".cat4" class="tab-btn" type="button">Printing</button>
                    </div>
                </div>
            </div>
            <div class="row gy-30 gx-30 filter-active">
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat1">
                    <div class="project-card style4">
                        <div class="project-img">
                            <img src="assets/img/project/project_4_1.png" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <h3 class="project-title">
                                    <a href="project-details.html">Process Optimization</a>
                                </h3>
                                <p class="project-subtitle">Eco Sustain Environmental Services</p>
                            </div>
                            <a href="project-details.html" class="icon-btn">
                                <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat3 cat2">
                    <div class="project-card style4">
                        <div class="project-img">
                            <img src="assets/img/project/project_4_2.png" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <h3 class="project-title">
                                    <a href="project-details.html">Retirement Sail Strategies</a>
                                </h3>
                                <p class="project-subtitle">Financial consultants offer a range</p>
                            </div>
                            <a href="project-details.html" class="icon-btn">
                                <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat4 cat1 cat2">
                    <div class="project-card style4">
                        <div class="project-img">
                            <img src="assets/img/project/project_4_3.png" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <h3 class="project-title">
                                    <a href="project-details.html">Empowering Businesses</a>
                                </h3>
                                <p class="project-subtitle">Business consulting providing expert</p>
                            </div>
                            <a href="project-details.html" class="icon-btn">
                                <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat3">
                    <div class="project-card style4">
                        <div class="project-img">
                            <img src="assets/img/project/project_4_5.png" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <h3 class="project-title">
                                    <a href="project-details.html">Insightful Analytics</a>
                                </h3>
                                <p class="project-subtitle">Financial consultants offer a range</p>
                            </div>
                            <a href="project-details.html" class="icon-btn">
                                <i class="far fa-arrow-right">

                                </i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat2 cat3">
                    <div class="project-card style4">
                        <div class="project-img">
                            <img src="assets/img/project/project_4_4.png" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <h3 class="project-title">
                                    <a href="project-details.html">InsightTech Consulting</a>
                                </h3>
                                <p class="project-subtitle">Navigating Success Together</p>
                            </div>
                            <a href="project-details.html" class="icon-btn">
                                <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section> -->
<section class="space-top team-area-4" data-bg-src="assets/img/bg/team_bg_4_1.png">
    <div class="container z-index-common">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-8">
                <div class="title-area text-center">
                    <span class="sub-title">
                        <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">GREAT TEAM
                        <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                    </span>
                    <h2 class="sec-title text-white">Meet Our Experience Team</h2>
                </div>
            </div>
        </div>
        <div class="slider-area">
            <div class="swiper th-slider" id="teamSlider4" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"}}}'>
                <div class="swiper-wrapper">
                    @if($teams)
                        @foreach ($teams as $team)
                            <div class="swiper-slide">
                                <div class="th-team team-card style2">
                                    <div class="img-wrap">
                                        <div class="team-img">
                                            <img src="{{ asset('storage/'.$team->image) }}" alt="Team">
                                        </div>
                                        <div class="team-social-hover">
                                            <a href="#" class="team-social-hover_btn">
                                                <i class="far fa-plus"></i>
                                            </a>
                                            <div class="th-social">
                                                <a target="_blank" href="https://vimeo.com/">
                                                    <i class="fab fa-vimeo-v"></i>
                                                </a>
                                                <a target="_blank" href="https://linkedin.com/">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                                <a target="_blank" href="https://twitter.com/">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                                <a target="_blank" href="https://facebook.com/">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-card-content">
                                        <div class="team-card-bg" data-bg-src="assets/img/bg/team_card_bg_4.jpg"></div>
                                        <h3 class="box-title">
                                            <a wire:navigate href="/team-details/{{ $team->slug }}">{{$team->name}}</a>
                                        </h3>
                                        <span class="team-desig">{{$team->position}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    @else
                    There is no Team members
                    @endif
                </div>
            </div>
            <button data-slider-prev="#teamSlider4" class="slider-arrow slider-prev">
                <i class="far fa-arrow-left"></i>
            </button>
            <button data-slider-next="#teamSlider4" class="slider-arrow slider-next">
                <i class="far fa-arrow-right"></i>
            </button>
        </div>
    </div>
</section>

<div class="space-top counter-area-2" data-bg-src="assets/img/bg/counter_bg_2.png">
    <div class="container">
        <div class="counter-card-wrap">
            <div class="counter-card">
                <div class="box-icon">
                    <img src="assets/img/icon/counter_card_1.svg" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number">
                        <span class="counter-number">25</span>+
                    </h2>
                    <p class="box-text">Years Of Experience</p>
                </div>
            </div>
            <div class="divider">

            </div>
            <div class="counter-card">
                <div class="box-icon">
                    <img src="assets/img/icon/counter_card_2.svg" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number">
                        <span class="counter-number">105</span>+
                    </h2>
                    <p class="box-text">Awards Received</p>
                </div>
            </div>
            <div class="divider">

            </div>
            <div class="counter-card">
                <div class="box-icon">
                    <img src="assets/img/icon/counter_card_3.svg" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number"><span class="counter-number">160</span>+</h2>
                    <p class="box-text">Project Complete</p>
                </div>
            </div>
            <div class="divider">

            </div>
            <div class="counter-card">
                <div class="box-icon">
                    <img src="assets/img/icon/counter_card_4.svg" alt="Icon">
                </div>
                <div class="media-body">
                    <h2 class="box-number"><span class="counter-number">75</span>K</h2>
                    <p class="box-text">Konsal Complete</p>
                </div>
            </div>
            <div class="divider">

            </div>
        </div>
    </div>
</div>
<div class="client-area-1" data-bg-src="{{asset('assets/img/bg/team_bg_3_1.png')}}" data-overlay="black" data-opacity="9">
    <div class="container-fluid p-0">
        <div class="swiper th-slider client-slider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"400":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"6"}}, "spaceBetween": "0", "loop": "true"}'>
            <div class="swiper-wrapper">
                @if($clients)
                    @foreach ($clients as $client)
                        <div class="swiper-slide">
                             <a href="#" class="client-card"><img src="{{ asset('storage/'.$client->image) }}" alt="Image"></a>
                        </div>
                    @endforeach
                @else
                        <div class="swiper-slide">
                            <a href="#" class="client-card"><img src="{{asset('assets/img/client/client1-1.svg')}}" alt="Image"></a>
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>
<section class="overflow-hidden space-top">
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
<section class="overflow-hidden space" id="blog-sec">
    <div class="container">
        <div class="row justify-content-md-between align-items-end">
            <div class="col-md-auto">
                <div class="title-area">
                    <span class="sub-title">
                        <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">BLOG & NEWS
                    </span>
                        <h2 class="sec-title">Get Update Blog & News</h2>
                    </div>
                </div>
                <div class="col-md-auto">
                    <div class="sec-btn text-start">
                        <div class="icon-box">
                            <button data-slider-prev="#blogSlider3" class="slider-arrow default">
                                <i class="far fa-arrow-left"></i>
                            </button>
                            <button data-slider-next="#blogSlider3" class="slider-arrow default">
                                <i class="far fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-area">
                <div class="swiper th-slider has-shadow" id="blogSlider3" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'>
                    <div class="swiper-wrapper">
                        @if($blogs)
                            @foreach ($blogs as $blog)
                                <div class="swiper-slide">
                                    <div class="blog-card style3">
                                        
                                        <div class="blog-img">
                                            <a  href="/news-and-updates/details/{{ $blog->slug }}">
                                                <img src="{{ asset('storage/'.$blog->image) }}" alt="blog image">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <a  href="/news-and-updates/details/{{ $blog->slug }}">
                                                    <i class="fa-light fa-calendar-days"></i>12 April 2024
                                                </a> 

                                            </div>
                                            <h3 class="box-title">
                                                <a  href="/news-and-updates/details/{{ $blog->slug }}">{{$blog->title}}</a>
                                            </h3>
                                            <p class="blog-text">
                                                {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($blog->description)), 120, '...') }}
                                            </p>
                                            <a href="/news-and-updates/details/{{ $blog->slug }}" class="link-btn style2">
                                                <i class="fas fa-plus-circle me-1"></i>Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        There is no post yet
                        @endif
                    </div>
                </div>
</section>

</div>
</div>

<!-- Hero Slider JavaScript -->
@if($slides && $slides->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainSlider = document.getElementById('mainSlider');
    const slides = mainSlider.querySelectorAll('.slider-slide');
    const prevBtn = document.getElementById('sliderPrev');
    const nextBtn = document.getElementById('sliderNext');
    const indicators = document.querySelectorAll('.slider-indicator');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let isAnimating = false;
    let autoPlayInterval;
    
    // Initialize slider
    function initSlider() {
        showSlide(0);
        updateIndicators();
        startAutoPlay();
    }
    
    // Show specific slide with stunning effects
    function showSlide(index) {
        if (isAnimating) return;
        isAnimating = true;
        
        // Hide all slides with fade out
        slides.forEach((slide, i) => {
            slide.style.opacity = '0';
            slide.style.transform = 'scale(0.9)';
            slide.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        
        // Show current slide with dramatic entrance
        setTimeout(() => {
            slides[index].style.opacity = '1';
            slides[index].style.transform = 'scale(1)';
            slides[index].style.filter = 'brightness(1.1) contrast(1.1)';
            
            // Animate content elements
            const content = slides[index].querySelector('.slider-text');
            if (content) {
                content.style.animation = 'none';
                setTimeout(() => {
                    content.style.animation = 'slideInUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                }, 100);
            }
        }, 300);
        
        currentSlide = index;
        updateIndicators();
        
        setTimeout(() => {
            isAnimating = false;
        }, 900);
    }
    
    // Update indicators with enhanced effects
    function updateIndicators() {
        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.style.background = 'white';
                indicator.style.transform = 'scale(1.5)';
                indicator.style.boxShadow = '0 0 20px rgba(255,255,255,0.8)';
                indicator.style.width = '16px';
                indicator.style.height = '16px';
            } else {
                indicator.style.background = 'transparent';
                indicator.style.transform = 'scale(1)';
                indicator.style.boxShadow = 'none';
                indicator.style.width = '14px';
                indicator.style.height = '14px';
            }
        });
    }
    
    // Next slide
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }
    
    // Previous slide
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }
    
    // Auto-play functionality
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            if (!isAnimating) {
                nextSlide();
            }
        }, 6000);
    }
    
    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }
    
    // Enhanced event listeners
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            stopAutoPlay();
            prevSlide();
            setTimeout(startAutoPlay, 8000);
        });
        
        prevBtn.addEventListener('mouseenter', function() {
            this.style.background = 'linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%)';
            this.style.color = 'white';
            this.style.transform = 'translateY(-50%) scale(1.15) rotate(-5deg)';
            this.style.boxShadow = '0 15px 35px rgba(59,130,246,0.4)';
        });
        
        prevBtn.addEventListener('mouseleave', function() {
            this.style.background = 'rgba(255,255,255,0.95)';
            this.style.color = '#333';
            this.style.transform = 'translateY(-50%) scale(1)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.2)';
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            stopAutoPlay();
            nextSlide();
            setTimeout(startAutoPlay, 8000);
        });
        
        nextBtn.addEventListener('mouseenter', function() {
            this.style.background = 'linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%)';
            this.style.color = 'white';
            this.style.transform = 'translateY(-50%) scale(1.15) rotate(5deg)';
            this.style.boxShadow = '0 15px 35px rgba(59,130,246,0.4)';
        });
        
        nextBtn.addEventListener('mouseleave', function() {
            this.style.background = 'rgba(255,255,255,0.95)';
            this.style.color = '#333';
            this.style.transform = 'translateY(-50%) scale(1)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.2)';
        });
    }
    
    // Enhanced indicator clicks
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            stopAutoPlay();
            showSlide(index);
            setTimeout(startAutoPlay, 8000);
        });
        
        indicator.addEventListener('mouseenter', function() {
            if (index !== currentSlide) {
                this.style.background = 'rgba(255,255,255,0.5)';
                this.style.transform = 'scale(1.3)';
            }
        });
        
        indicator.addEventListener('mouseleave', function() {
            if (index !== currentSlide) {
                this.style.background = 'transparent';
                this.style.transform = 'scale(1)';
            }
        });
    });
    
    // Pause on hover, resume on leave
    mainSlider.addEventListener('mouseenter', stopAutoPlay);
    mainSlider.addEventListener('mouseleave', startAutoPlay);
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            stopAutoPlay();
            prevSlide();
            setTimeout(startAutoPlay, 8000);
        } else if (e.key === 'ArrowRight') {
            stopAutoPlay();
            nextSlide();
            setTimeout(startAutoPlay, 8000);
        }
    });
    
    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    mainSlider.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    mainSlider.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            stopAutoPlay();
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
            setTimeout(startAutoPlay, 8000);
        }
    }
    
    // Initialize
    initSlider();
    
    // Add stunning CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes slideInUp {
            0% {
                opacity: 0;
                transform: translateY(80px) scale(0.7);
            }
            50% {
                opacity: 0.8;
                transform: translateY(20px) scale(1.05);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
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
        
        .slider-slide {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .slider-nav-btn {
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .slider-nav-btn:hover {
            transform: translateY(-50%) scale(1.15);
        }
        
        .slider-indicator {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .slider-indicator:hover {
            transform: scale(1.4);
        }
        
        .slider-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .slider-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(59,130,246,0.5);
        }
        
        .slider-category {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .slider-category:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(59,130,246,0.4);
        }
    `;
    document.head.appendChild(style);
});
</script>
@endif
