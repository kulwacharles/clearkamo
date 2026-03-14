
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
                <li><a wire:navigate href="/">Home</a></li> 
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

    <section class="space-top space-bottom" id="core-values-sec">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">
                    <img class="me-2" src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="shape">
                    OUR CORE VALUES
                    <img class="ms-2" src="{{ asset('assets/img/theme-img/title_icon.svg') }}" alt="shape">
                </span>
            </div>

            @if($coreValues && $coreValues->count())
            <div class="row g-4">
                @foreach($coreValues as $index => $value)
                    <div class="col-xl-4 col-md-6">
                        <article class="cv-card h-100">
                            @if($value->image)
                                <div class="cv-card-img">
                                    <img src="{{ asset('storage/'.$value->image) }}" alt="{{ $value->title }}">
                                    <span class="cv-card-number-overlay">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            @else
                                <div class="cv-card-top">
                                    <span class="cv-card-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="cv-card-icon">
                                        <i class="fas {{ $value->icon ?? 'fa-star' }}"></i>
                                    </span>
                                </div>
                            @endif
                            <h3 class="cv-card-title">{{ $value->title }}</h3>
                            <p class="cv-card-summary">{{ $value->summary }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
            @else
                <div class="col-12 text-center text-muted">No core values published yet.</div>
            @endif
        </div>

        <style>
            #core-values-sec .cv-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 12px 26px rgba(15, 23, 42, 0.08);
                transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
                display: flex;
                flex-direction: column;
            }

            #core-values-sec .cv-card:hover {
                transform: translateY(-4px);
                border-color: rgba(3, 164, 252, 0.45);
                box-shadow: 0 16px 30px rgba(3, 164, 252, 0.18);
            }

            /* Photo banner */
            #core-values-sec .cv-card-img {
                position: relative;
                width: 100%;
                height: 200px;
                overflow: hidden;
            }

            #core-values-sec .cv-card-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            #core-values-sec .cv-card-number-overlay {
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
            #core-values-sec .cv-card-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 14px;
                padding: 22px 22px 0;
            }

            #core-values-sec .cv-card-number {
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

            #core-values-sec .cv-card-icon {
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

            #core-values-sec .cv-card-title {
                font-size: 1.1rem;
                line-height: 1.3;
                margin-bottom: 10px;
                color: #0f172a;
                padding: 16px 22px 0;
                font-weight: 700;
            }

            /* When there's no image the top-padding is already set by .cv-card-top */
            #core-values-sec .cv-card:has(.cv-card-top) .cv-card-title {
                padding-top: 0;
            }

            #core-values-sec .cv-card-summary {
                color: #334155;
                margin-bottom: 20px;
                padding: 0 22px 22px;
                flex-grow: 1;
            }

            @media (max-width: 575.98px) {
                #core-values-sec .cv-card-img {
                    height: 180px;
                }
                #core-values-sec .cv-card-title {
                    font-size: 1rem;
                }
            }
        </style>
    </section>

    <style>
        .approach-check-icon {
            color: #03A4FC;
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
