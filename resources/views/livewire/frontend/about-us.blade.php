
<div>
     <div class="breadcumb-wrapper" data-bg-src="{{asset('assets/img/bg/breadcumb-bg.jpg')}}">
    <div class="breadcumb-shape1">
        <img src="{{asset('assets/img/shape/breadcrumb-shape1.svg')}}" alt="img">
    </div>
    <div class="breadcumb-shape2">
        <img src="{{asset('assets/img/shape/breadcrumb-shape2.svg')}}" alt="img">
    </div>
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">About Us</h1>
            <ul class="breadcumb-menu">
                <li><a href="index-2.html">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-50" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 mb-50 mb-xl-0">
                <div class="img-box2">
                    <div class="shape1"><img src="{{ url('/storage/'.$about1) }}" alt="About"></div>
                    <div class="img1"><img src="{{ url('/storage/'.$about1) }}" alt="About">
                        <div class="year-counter bg-title" data-bg-src="{{asset('assets/img/normal/about_shape2_2.png')}}">
                            <div class="year-counter_number"><span class="counter-number">{{$years_of_experience}}</span></div>
                            <p class="year-counter_text">Year Of Experience</p>
                        </div>
                    </div>
                    <div class="img2"><img src="{{ url('/storage/'.$about2) }}" alt="Image">
                    </div>
                    <div class="about-since-wrap jump">
                        <div class="about-since">Since {{date('Y')-$years_of_experience}}</div>
                    </div>
                </div>
            </div>
    <div class="col-xl-7">
        <div class="title-area mb-0">
            <span class="sub-title">
                <img class="me-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">ABOUT OUR COMPANY
                <img class="ms-1" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="img">
            </span>
            <h3 class="sec-title">{{$title}}</h3>
            <p>
                {!! $description !!}
            </p>
        </div>
        <!-- <div class="about-feature-wrap2">
            <div class="about-feature">
                <div class="box-icon">
                    <img src="{{asset('assets/img/icon/about_feature_2-1.svg')}}" alt="Icon">
                </div>
                <div class="about-feature-content">
                    <h3 class="box-title">Market Research Analysis</h3>
                    
                    <p class="about-feature-text">Business consulting involves providing expert advice and guidance businesses to help them improve their operations</p>
                </div>
            </div>
            <div class="about-feature">
                <div class="box-icon">
                    <img src="{{asset('assets/img/icon/about_feature_2-2.svg')}}" alt="Icon">
                </div>
                <div class="about-feature-content">
                    <h3 class="box-title">Financial Advisory Services</h3>
                    <p class="about-feature-text">Consulting services can provide insights, strategies, and solutions tailored to your specific challenges, leading</p>
                </div>
            </div>
        </div> -->
        <!-- <div class="btn-wrap mt-50">
            <a href="about.html" class="th-btn">Read More
                <div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i>
                </div>
            </a>
        </div> -->
    </div>
</div>
</div>
</div>

   <section  id="service-sec" class="mt-50 mb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="title-area text-center">
                     <span class="sub-title">
                        <img class="me-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">OUR CORE VALUES
                        <img class="ms-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">
                    </span>
                     <!-- <h3 class="sec-title">Our Core Values</h3> -->
                    </div>
                </div>
            </div>
            <div class="row gy-30 gx-30 justify-content-center">
                @php
                    $coreValues = [
                        [
                            'title' => 'Community/Customer-centred',
                            'description' => 'We design and deliver solutions around the lived realities of the people and organizations we serve.',
                            'icon' => 'fa-users',
                        ],
                        [
                            'title' => 'Local Relevance with Global Reach',
                            'description' => 'We ground our work in local context while applying proven global standards and multidisciplinary expertise.',
                            'icon' => 'fa-earth-africa',
                        ],
                        [
                            'title' => 'Evidence-based Practice',
                            'description' => 'We use data, diagnostics, and measurable signals to guide decisions and continuously improve outcomes.',
                            'icon' => 'fa-chart-line',
                        ],
                        [
                            'title' => 'Accountable Results',
                            'description' => 'We focus on clear commitments, transparent delivery, and measurable impact from strategy to execution.',
                            'icon' => 'fa-bullseye-arrow',
                        ],
                        [
                            'title' => 'Responsible Innovation',
                            'description' => 'We innovate pragmatically, balancing speed and creativity with ethics, quality, and long-term sustainability.',
                            'icon' => 'fa-lightbulb-on',
                        ],
                    ];
                @endphp

                @foreach($coreValues as $index => $value)
                    <div class="col-xl-4 col-md-6">
                        <div class="service-card">
                            <div class="box-img">
                                <img src="{{ asset('assets/img/bg/service_card_bg_1.jpg') }}" alt="Core Value">
                            </div>
                            <div class="service-card-icon">
                                <div class="icon d-inline-flex align-items-center justify-content-center core-value-icon">
                                    <i class="fa-solid {{ $value['icon'] }}"></i>
                                </div>
                                <div class="service-card-num"><span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span></div>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">{{ $value['title'] }}</h3>
                                <p class="box-text">{{ $value['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
              
            
        
            <!-- <div class="col-xl-4 col-md-6">
                <div class="service-card">
                    <div class="box-img"><img src="{{asset('assets/img/bg/service_card_bg_1.jpg')}}" alt="Service"></div>
                    <div class="service-card-icon">
                        <div class="icon"><img src="{{asset('assets/img/icon/service_card_6.svg')}}" alt="Icon"></div>
                        <div class="service-card-num"><span>06</span></div>
                    </div>
                    <div class="box-content"><h3 class="box-title"><a href="service-details.html">Prowess Peak Advisory</a></h3>
                        <p class="box-text">Business consulting firms provide a range of services including strategic planning, financial analysis, market research</p>
                        <a href="service-details.html" class="link-btn">Read More
                            <div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div>
                        </a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<style>
    .core-value-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        font-size: 22px;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
    }

    .approach-check-icon {
        color: #2563eb;
    }
</style>
<section  id="service-sec" class="mt-50 mb-50">
    <div class="container">
        <div class="row justify-content-between flex-row-reverse">
                <div class="col-xxl-6 col-xl-5"><div class="why-img-box">
                        <div class="img1"><img src="{{asset('assets/img/normal/why_1_1.png')}}" alt="Why">
                        </div>
                        {{-- <div class="about-grid jump">
                            <img class="about-grid_thumb" src="{{asset('assets/img/normal/why_1_2.png')}}" alt="about">
                            <p class="about-grid_text">We have <span class="counter-number">2563</span>+ Global Active Clients</p>
                        </div> --}}
                    </div>
                </div>
        <div class="col-xxl-6 col-xl-7">
            <div class="why-feature-wrap ">
                <div class="title-area mb-30">
                    
                    <span class="sub-title">
                        <img class="me-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">OUR APPROACH
                        <img class="ms-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">
                    </span>
                    <h6 class="sec-title">A Disciplined, Results-Focused Approach</h6>
                    <p class="sec-text">Our delivery model is intentionally high-level in public communication. We focus on outcomes, accountability, and sustained value while tailoring execution to each client context.</p>
                </div>
                <ul class="why-feature-list">
                    <li class="why-feature-list-wrap">
                        <div class="icon">
                            <i class="fas fa-square-check approach-check-icon"></i>
                        </div>
                        <div class="why-feature-list-details">
                            <h4 class="feature-title">1. Context-Aligned Execution</h4>
                            <p>Every engagement is adapted to client priorities, operating environment, and implementation realities.</p>
                        </div>
                    </li>
                    <li class="why-feature-list-wrap">
                        <div class="icon"><i class="fas fa-square-check approach-check-icon"></i></div>
                        <div class="why-feature-list-details">
                            <h4 class="feature-title">2. Outcome and Accountability Focus</h4>
                            <p>We prioritize clear targets, measurable progress, and responsible stewardship of resources.</p>
                        </div>
                    </li>
                    <li class="why-feature-list-wrap">
                        <div class="icon"><i class="fas fa-square-check approach-check-icon"></i></div>
                        <div class="why-feature-list-details">
                            <h4 class="feature-title">3. Continuous Improvement</h4>
                            <p>We refine delivery as programs evolve to maintain quality, reduce risk, and protect long-term impact.</p>
                        </div>
                    </li>
           
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>

</div>
