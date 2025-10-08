<div>
    <div class="th-hero-wrapper hero-4" id="hero" data-bg-src="assets/img/hero/hero_bg_4_1.jpg">
    <div class="swiper th-slider" id="heroSlider4" data-slider-options='{"effect":"fade"}'>
        <div class="swiper-wrapper">
            @if($slides !=null)
                @foreach ($slides as $slide)
                    <div class="swiper-slide">
                        <div class="hero-inner">
                            <div class="hero-img">
                                <img src="{{ url('/storage/'.$slide->image) }}" alt="Image">
                            </div>
                            <div class="container">
                                <div class="row justify-content-end">
                                    <div class="col-lg-6">
                                        <div class="hero-style4">
                                            <span class="sub-title" data-ani="slideinup" data-ani-delay="0.2s">
                                                {{ $slide->group }}
                                            </span>
                                            <h1 class="hero-title">
                                                <span class="title1" data-ani="slideinup" data-ani-delay="0.4s">
                                                    {{ $slide->title }}
                                                </span> 
                                              
                                            </h1>
                                            <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.6s">
                                                <i style="color:white">
                                                    {!! $slide->description !!}
                                                </i>
                                            </p>
                                            <div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">
                                                <a href="contact.html" class="th-btn style3">
                                                    GET START
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
                            <div class="hero-shape1">
                                <img src="assets/img/hero/hero_bg_shape4_1.jpg" alt="img">
                            </div>
                        </div>
                    </div>                    
                @endforeach

            @endif
        </div>
        <div class="icon-box">
            <button data-slider-prev="#heroSlider4" class="slider-arrow default">
                <i class="far fa-arrow-left"></i>
            </button> 
            <button data-slider-next="#heroSlider4" class="slider-arrow default">
                <i class="far fa-arrow-right"></i>
            </button>
        </div>
    </div>
</div>
<div class="overflow-hidden space" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 mb-50 mb-xl-0">
                <div class="img-box4">
                    <div class="img1">
                        <img src="assets/img/normal/about_4_1.png" alt="About">
                    </div>
                    <div class="img2 jump-reverse">
                        <img src="assets/img/normal/about_shape4_1.png" alt="img">
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="title-area mb-30">
                    <span class="sub-title">
                        <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                        WHO WE ARE
                        <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                    </span>
                    <h3 class="sec-title">AN IMPACT DRIVEN BUSINESS </h3>
                    <p class="sec-text">Founded in 2017, PCL is headquartered in Dar es Salaam, Tanzania, with an office in London, UK. Drawing on the expertise of a network of multidisciplinary partners and advisors, PCL explores needs and wants to derive insights and effect large scale change with measurable impact and maximum efficiency. Its management team has decades of experience, working with large private, government and non-government organisations like the World Bank, WaterAid, CIDRZ, Unilever, Tanzanian and Zambian national governments, across five continents.</p>
                </div>
                <div class="row gy-40">
                    <div class="col-md-6">
                        <div class="checklist style3">
                            <ul>
                                <li>
                                    <i class="fas fa-square-check"></i> Catalyzing Growth, Together
                                </li>
                                <li>
                                    <i class="fas fa-square-check"></i> Driving Excellence Every Day
                                </li>
                                <li>
                                    <i class="fas fa-square-check"></i> Innovate. Implement. Inspire
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="year-counter style2">
                            <div class="icon">
                                <img src="assets/img/icon/about_counter_icon_1.svg" alt="img">
                            </div>
                            <div class="year-counter_number">
                                <span class="counter-number">25</span>
                            </div>
                            <p class="year-counter_text">Year Of Experience</p>
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
                    <a href="about.html" class="th-btn">Read More
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
                        Our Area of Focus
                        <img class="ms-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                    </span>
                    <h2 class="sec-title">Beyond Boundaries Into Success</h2>
                </div>
            </div>
        </div>
        <div class="row gy-30 gx-30 justify-content-center">
            <div class="col-xl-3 col-md-6">
                <div class="service-card4">
                    <div class="service-card-thumb">
                        <img src="assets/img/service/service_card_4_1.png" alt="img">
                        <div class="service-card-icon">
                            <img src="assets/img/icon/service_card_4-1.svg" alt="Icon">
                        </div>
                    </div>
                    <div class="box-content">
                        <h3 class="box-title">
                            <a href="service-details.html">Research & Situation Analysis</a>
                        </h3>
                        <p class="box-text">
                            Project CLEAR balances analytics with implementation through multi-disciplinary inputs to change the paradigm of organizational and international development. Contrasting with traditional rigid implementation frameworks, we take an adaptive approach to projects which enables us to achieve results far closer to the anticipated outcomes. We do this by focusing on:
                        </p>
                        <div class="btn-wrap">
                            <a href="service-details.html" class="link-btn style2">
                                <i class="fas fa-plus-circle me-1"></i>Read More
                            </a>
                            <div class="service-card-num">
                                <span>01</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="service-card4">
                    <div class="service-card-thumb">
                        <img src="assets/img/service/service_card_4_2.png" alt="img">
                        <div class="service-card-icon">
                            <img src="assets/img/icon/service_card_4-2.svg" alt="Icon">
                        </div>
                    </div>
                    <div class="box-content">
                        <h3 class="box-title">
                            <a href="service-details.html">
							Insight & Concept Generation and Testing.
                        </a>
                        </h3>
                        <p class="box-text">We utilize evidence and expert and beneficiary consultations to find insights and ideas to solve problems and build consensus in multi-stakeholder settings.</p>
                        <div class="btn-wrap">
                            <a href="service-details.html" class="link-btn style2">
                                <i class="fas fa-plus-circle me-1"></i>Read More
                            </a>
                            <div class="service-card-num">
                                <span>02</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="service-card4">
                    <div class="service-card-thumb">
                        <img src="assets/img/service/service_card_4_3.png" alt="img">
                        <div class="service-card-icon">
                            <img src="assets/img/icon/service_card_4-3.svg" alt="Icon">
                        </div>
                    </div>
                    <div class="box-content">
                        <h3 class="box-title">
                            <a href="service-details.html">Your Bridge to Excellence</a>
                        </h3>
                        <p class="box-text">
                            We support initiative design and restructuring and support delivery of projects through multiple channels and efficient project management processes tailored to context.
                        </p>
                        <div class="btn-wrap">
                            <a href="service-details.html" class="link-btn style2">
                                <i class="fas fa-plus-circle me-1"></i>Read More
                            </a>
                            <div class="service-card-num"><span>03</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="service-card4">
                    <div class="service-card-thumb">
                        <img src="assets/img/service/service_card_4_3.png" alt="img">
                        <div class="service-card-icon">
                            <img src="assets/img/icon/service_card_4-3.svg" alt="Icon">
                        </div>
                    </div>
                    <div class="box-content">
                        <h3 class="box-title">
                            <a href="service-details.html">Your Bridge to Excellence</a>
                        </h3>
                        <p class="box-text">
                            We develop results frameworks, monitoring, and evaluation systems based to client needs to ensure value for money, learning, informed decision and adaptive programming
                        </p>
                        <div class="btn-wrap">
                            <a href="service-details.html" class="link-btn style2">
                                <i class="fas fa-plus-circle me-1"></i>Read More
                            </a>
                            <div class="service-card-num"><span>04</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="swiper th-slider" id="teamSlider4" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_1.png" alt="Team">
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
                                    <a href="team-details.html">Leslie Alexander</a>
                                </h3>
                                <span class="team-desig">Founder & CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_2.png" alt="Team">
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
                                    <a href="team-details.html">Jenny Wilson</a>
                                </h3>
                                <span class="team-desig">Senior Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_3.png" alt="Team">
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
                                    <a href="team-details.html">Kristin Watson</a>
                                </h3>
                                <span class="team-desig">Junior Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_4.png" alt="Team">
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
                                <div class="team-card-bg" data-bg-src="assets/img/bg/team_card_bg_4.jpg">
                                </div>
                                <h3 class="box-title">
                                    <a href="team-details.html">Ralph Edwards</a>
                                </h3>
                                <span class="team-desig">Senior Worker</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_1.png" alt="Team">
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
                                <div class="team-card-bg" data-bg-src="assets/img/bg/team_card_bg_4.jpg">

                                </div>
                                <h3 class="box-title">
                                    <a href="team-details.html">Leslie Alexander</a>
                                </h3>
                                <span class="team-desig">Founder & CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_2.png" alt="Team">
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
                                <div class="team-card-bg" data-bg-src="assets/img/bg/team_card_bg_4.jpg">

                                </div>
                                <h3 class="box-title">
                                    <a href="team-details.html">Jenny Wilson</a>
                                </h3>
                                <span class="team-desig">Senior Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_3.png" alt="Team">
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
                                <div class="team-card-bg" data-bg-src="assets/img/bg/team_card_bg_4.jpg">

                                </div>
                                <h3 class="box-title">
                                    <a href="team-details.html">Kristin Watson</a>
                                </h3>
                                <span class="team-desig">Junior Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card style4">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="assets/img/team/team_4_4.png" alt="Team">
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
                                <div class="team-card-bg" data-bg-src="assets/img/bg/team_card_bg_4.jpg">

                                </div>
                                <h3 class="box-title">
                                    <a href="team-details.html">Ralph Edwards</a>
                                </h3>
                                <span class="team-desig">Senior Worker</span>
                            </div>
                        </div>
                    </div>
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
<section class="why-sec4">
    <div class="shape-mockup why-bg-shape4-1 bg-smoke d-xl-block d-none" data-top="0" data-right="0" data-bg-src="assets/img/bg/why_bg_4_1.png">

    </div>
    <div class="container">
        <div class="why-wrap4">
            <div class="why-img-box3 mb-xl-0 mb-50">
                <img src="assets/img/normal/why_4_1.png" alt="Why"> 
                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn style4 popup-video">
                    <i class="fa-sharp fa-solid fa-play"></i>
                </a>
            </div>
            <div class="title-area mb-0">
                <span class="sub-title">
                    <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">WHY CHOOSE US
                </span>
                <h2 class="sec-title">Elevate Your Business Elevate Your Life</h2>
                <p class="sec-text mt-30">Business consulting involves providing expert advice guidance man or organizations to help them improve their performance, operations, and profitability plan typically includes an executive summary</p>
                <div class="progress-grid-wrap mt-40">
                    <div class="feature-circle">
                        <div class="progressbar">
                            <div class="circle" data-percent="65">
                                <div class="circle-num">65%</div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-wrap-content">
                        <h3 class="box-title">Talent Thrive HR Solutions</h3>
                        <p class="text">Business consulting involves providing expert advice to businesses to help them improve</p>
                    </div>
                </div>
                <div class="progress-grid-wrap">
                    <div class="feature-circle">
                        <div class="progressbar">
                            <div class="circle" data-percent="46">
                                <div class="circle-num">46%</div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-wrap-content">
                        <h3 class="box-title">Growth Forge Consulting</h3>
                        <p class="text">Market research helps businesses understand their target audience, competition, industry trends</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                    <div class="swiper-slide">
                        <div class="testi-card-3">
                            <div class="testi-card-thumb">
                                <img class="avatar" src="assets/img/testimonial/testi_3_1.png" alt="img">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote2.svg" alt="icon">
                                </div>
                            </div>
                            <div class="testi-card-details">
                                <p class="testi-card_text">Successful project management requires clear goals, effective planning communication skilled team members, regular monitoring, and adaptability to changes. It's also important to manage resources efficiently and stay within budget and timeline</p>
                                <div class="testi-card_profile">
                                    <div class="testi-card_content">
                                        <h3 class="testi-card_name">Brooklyn Simmons</h3>
                                        <span class="testi-card_desig">UI/UX Designer</span>
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
                    <div class="swiper-slide">
                        <div class="testi-card-3">
                            <div class="testi-card-thumb">
                                <img class="avatar" src="assets/img/testimonial/testi_3_2.png" alt="img">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote2.svg" alt="icon">
                                </div>
                            </div>
                            <div class="testi-card-details">
                                <p class="testi-card_text">A business plan is a written document that outlines a company's goals and the strategy for achieving them. It's crucial as it provides a roadmap for the business, helps in obtaining funding, and serves as a reference point for decision-making.</p>
                                <div class="testi-card_profile">
                                    <div class="testi-card_content">
                                        <h3 class="testi-card_name">Leslie Alexander</h3>
                                        <span class="testi-card_desig">Software Development</span>
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
                    <div class="swiper-slide">
                        <div class="testi-card-3">
                            <div class="testi-card-thumb">
                                <img class="avatar" src="assets/img/testimonial/testi_3_3.png" alt="img">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote2.svg" alt="icon">
                                </div>
                            </div>
                            <div class="testi-card-details">
                                <p class="testi-card_text">Market research helps businesses understand their target audience, identify competition, and evaluate market trends. It provides valuable insights for making informed decisions about products, services, and marketing strategies. crowdfunding, and traditional</p>
                                <div class="testi-card_profile">
                                    <div class="testi-card_content">
                                        <h3 class="testi-card_name">Savannah Nguyen</h3>
                                        <span class="testi-card_desig">E-commerce Solutions</span>
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
                    <div class="swiper-slide">
                        <div class="testi-card-3">
                            <div class="testi-card-thumb">
                                <img class="avatar" src="assets/img/testimonial/testi_3_1.png" alt="img">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote2.svg" alt="icon">
                                </div>
                            </div>
                            <div class="testi-card-details">
                                <p class="testi-card_text">Successful project management requires clear goals, effective planning communication skilled team members, regular monitoring, and adaptability to changes. It's also important to manage resources efficiently and stay within budget and timeline</p>
                                <div class="testi-card_profile">
                                    <div class="testi-card_content">
                                        <h3 class="testi-card_name">Brooklyn Simmons</h3>
                                        <span class="testi-card_desig">UI/UX Designer</span>
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
                    <div class="swiper-slide">
                        <div class="testi-card-3">
                            <div class="testi-card-thumb">
                                <img class="avatar" src="assets/img/testimonial/testi_3_2.png" alt="img">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote2.svg" alt="icon">
                                </div>
                            </div>
                            <div class="testi-card-details">
                                <p class="testi-card_text">A business plan is a written document that outlines a company's goals and the strategy for achieving them. It's crucial as it provides a roadmap for the business, helps in obtaining funding, and serves as a reference point for decision-making.</p>
                                <div class="testi-card_profile">
                                    <div class="testi-card_content">
                                        <h3 class="testi-card_name">Leslie Alexander</h3>
                                        <span class="testi-card_desig">Software Development</span>
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
                    <div class="swiper-slide">
                        <div class="testi-card-3">
                            <div class="testi-card-thumb">
                                <img class="avatar" src="assets/img/testimonial/testi_3_3.png" alt="img">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote2.svg" alt="icon">
                                </div>
                            </div>
                            <div class="testi-card-details">
                                <p class="testi-card_text">Market research helps businesses understand their target audience, identify competition, and evaluate market trends. It provides valuable insights for making informed decisions about products, services, and marketing strategies. crowdfunding, and traditional</p>
                                <div class="testi-card_profile">
                                    <div class="testi-card_content">
                                        <h3 class="testi-card_name">Savannah Nguyen</h3>
                                        <span class="testi-card_desig">E-commerce Solutions</span>
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
                        <div class="swiper-slide">
                            <div class="blog-card style3">
                                
                                <div class="blog-img">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog_3_1.jpg" alt="blog image">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a href="blog.html">
                                            <i class="fa-light fa-calendar-days"></i>12 April 2024
                                        </a> 
                                        <a href="blog-details.html">
                                            <i class="far fa-comments"></i>2 Comments
                                        </a>
                                    </div>
                                    <h3 class="box-title">
                                        <a href="blog-details.html">Business consulting involves providing expert advice</a>
                                    </h3>
                                    <p class="blog-text">This can include areas like strategy, operations in marketing, finance, and more business</p>
                                    <a href="blog-details.html" class="link-btn style2">
                                        <i class="fas fa-plus-circle me-1"></i>Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card style3">
                                <div class="blog-img">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog_3_2.jpg" alt="blog image">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a href="blog.html">
                                            <i class="fa-light fa-calendar-days"></i>16 March 2024
                                        </a>
                                        <a href="blog-details.html">
                                            <i class="far fa-comments"></i>3 Comments
                                        </a>
                                    </div>
                                    <h3 class="box-title">
                                        <a href="blog-details.html">Common financial strategies for businesses budgeting</a>
                                    </h3>
                                    <p class="blog-text">Business consulting services can benefit your is company by providing specialized</p>
                                    <a href="blog-details.html" class="link-btn style2">
                                        <i class="fas fa-plus-circle me-1"></i>Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="blog-card style3">
                                <div class="blog-img">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog_3_3.jpg" alt="blog image">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a href="blog.html">
                                            <i class="fa-light fa-calendar-days">

                                            </i>17 June 2024</a>
                                            <a href="blog-details.html">
                                                <i class="far fa-comments"></i>2 Comments
                                            </a>
                                        </div>
                                        <h3 class="box-title">
                                            <a href="blog-details.html">Improving satisfaction and retention involves offering</a>
                                        </h3>
                                        <p class="blog-text">Some projects may be short-term, lasting a few weeks, while others may be long-term</p>
                                        <a href="blog-details.html" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="blog-card style3">
                                    <div class="blog-img">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog_3_1.jpg" alt="blog image">
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <a href="blog.html">
                                                <i class="fa-light fa-calendar-days"></i>12 April 2024
                                            </a> 
                                            <a href="blog-details.html"><i class="far fa-comments"></i>4 Comments</a>
                                        </div>
                                        <h3 class="box-title">
                                            <a href="blog-details.html">Business consulting involves providing expert advice</a>
                                        </h3>
                                        <p class="blog-text">This can include areas like strategy, operations in marketing, finance, and more business</p>
                                        <a href="blog-details.html" class="link-btn style2">
                                            <i class="fas fa-plus-circle me-1"></i>Read More
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="blog-card style3">
                                        <div class="blog-img">
                                            <a href="blog-details.html">
                                                <img src="assets/img/blog/blog_3_2.jpg" alt="blog image">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <a href="blog.html">
                                                    <i class="fa-light fa-calendar-days"></i>16 March 2024
                                                </a>
                                                <a href="blog-details.html">
                                                    <i class="far fa-comments"></i>2 Comments
                                                </a>
                                            </div>
                                            <h3 class="box-title">
                                                <a href="blog-details.html">Common financial strategies for businesses budgeting</a>
                                            </h3>
                                            <p class="blog-text">Business consulting services can benefit your is company by providing specialized</p>
                                            <a href="blog-details.html" class="link-btn style2">
                                                <i class="fas fa-plus-circle me-1"></i>Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="blog-card style3">
                                        <div class="blog-img">
                                            <a href="blog-details.html">
                                                <img src="assets/img/blog/blog_3_3.jpg" alt="blog image">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <a href="blog.html">
                                                    <i class="fa-light fa-calendar-days"></i>17 June 2024
                                                </a> 
                                                <a href="blog-details.html">
                                                    <i class="far fa-comments"></i>3 Comments
                                                </a>
                                            </div>
                                            <h3 class="box-title">
                                                <a href="blog-details.html">Improving satisfaction and retention involves offering</a>
                                            </h3>
                                            <p class="blog-text">Some projects may be short-term, lasting a few weeks, while others may be long-term</p>
                                            <a href="blog-details.html" class="link-btn style2">
                                                <i class="fas fa-plus-circle me-1"></i>Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</section>

</div>
