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
                        <div class="about-since">Since 1990</div>
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
                  <div class="col-xl-6 col-md-6">
                    <div class="service-card">
                        <div class="box-img">
                            <img src="{{asset('assets/img/bg/service_card_bg_1.jpg')}}" alt="Service">
                        </div>
                        <div class="service-card-icon">
                            <div class="icon"><img src="{{asset('assets/img/icon/service_card_2.svg')}}" alt="Icon"></div>
                            <div class="service-card-num"><span>01</span></div>
                        </div>
                       
                        <div class="box-content">
                            <h3 class="box-title"><a href="service-details.html">Life Changing Result</a></h3>
                            <p class="box-text">Working in partnership with Tanzanian’s Ministry of Health, Project CLEAR designed, developed, and executed ‘Nyumba Ni Choo’, Tanzania’s national sanitation programme which has increased access to improved sanitation for millions of people between 2017 and 2022.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="service-card">
                         <div class="box-img"><img src="{{asset('assets/img/bg/service_card_bg_1.jpg')}}" alt="Service"></div>
                         <div class="service-card-icon">
                            <div class="icon"><img src="{{asset('assets/img/icon/service_card_1.svg')}}" alt="Icon"></div>
                            <div class="service-card-num"><span>02</span></div>
                         </div>
                        <div class="box-content">
                            <h3 class="box-title"><a href="service-details.html">Evidence Led</a></h3>
                            <p class="box-text">Drawing on our diverse expertise and world class advisory network—which includes academics from the London School of Hygiene and Tropical Medicine—we design and deliver local and national initiatives that are changing the paradigm of international development..</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                        <div class="service-card">
                            <div class="box-img"><img src="{{asset('assets/img/bg/service_card_bg_1.jpg')}}" alt="Service"></div>
                            <div class="service-card-icon">
                                <div class="icon"><img src="{{asset('assets/img/icon/service_card_3.svg')}}" alt="Icon"></div>
                                <div class="service-card-num"><span>03</span></div>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title"><a href="service-details.html">Cost Efficient Delivery</a></h3>
                                <p class="box-text">Our model, which combines data capture and multi-disciplinary expertise gets to the root of development challenges, effecting large scale change with measurable impact and maximum cost efficiency.</p>
                              
                            </div>
                        </div>
                </div>
                   <div class="col-xl-4 col-md-6">
                <div class="service-card">
                    <div class="box-img"><img src="{{asset('assets/img/bg/service_card_bg_1.jpg')}}" alt="Service"></div>
                    <div class="service-card-icon">
                        <div class="icon"><img src="{{asset('assets/img/icon/service_card_4.svg')}}" alt="Icon"></div>
                        <div class="service-card-num"><span>04</span></div>
                    </div>
                    <div class="box-content">
                        <h3 class="box-title"><a href="service-details.html">Agile</a></h3>
                        <p class="box-text">We use proprietary data and insights at all stages of a programme’s execution to constantly adapt and evolve, helping to de-risk the programme while delivering results closer to its anticipated outcome.</p>
                       
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="service-card">
                    <div class="box-img">
                        <img src="{{asset('assets/img/bg/service_card_bg_1.jpg')}}" alt="Service">
                    </div>
                    <div class="service-card-icon">
                        <div class="icon">
                            <img src="{{asset('assets/img/icon/service_card_5.svg')}}" alt="Icon">
                        </div>
                        <div class="service-card-num">
                            <span>05</span>
                        </div>
                    </div>
                    <div class="box-content">
                        <h3 class="box-title"><a href="service-details.html">Replicable at Scale</a>
                        </h3>
                        <p class="box-text">We have an agile, asset-light business model, calling on the expertise of multidisciplinary partners from around the world, to effectively launch national development programmes at scale.</p>
                       
                    </div>
                </div>
            </div>
              
            
        
         
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
<section  id="service-sec" class="mt-50 mb-50">
    <div class="container">
        <div class="row justify-content-between flex-row-reverse">
                <div class="col-xxl-6 col-xl-5"><div class="why-img-box">
                        <div class="img1"><img src="{{asset('assets/img/normal/why_1_1.png')}}" alt="Why">
                        </div>
                        <div class="about-grid jump">
                            <img class="about-grid_thumb" src="{{asset('assets/img/normal/why_1_2.png')}}" alt="about">
                            <p class="about-grid_text">We have <span class="counter-number">2563</span>+ Global Active Clients</p>
                        </div>
                    </div>
                </div>
        <div class="col-xxl-6 col-xl-7">
            <div class="why-feature-wrap ">
                <div class="title-area mb-30">
                    
                    <span class="sub-title">
                        <img class="me-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">OUR APPROACH
                        <img class="ms-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">
                    </span>
                    <h6 class="sec-title">We bring to light the solutions to specific problems</h6>
                    <p class="sec-text">We’re in the business of change at a national scale. Our unique approach helps governments, corporates, and NGOs bridge the strategy-execution gap and achieve measurable impact against development challenges. From improving sanitation and hygiene to empowering women entrepreneurs, successful changemaking requires two things: robust foundations and adaptive delivery.</p>
                </div>
                <ul class="why-feature-list">
                    <li class="why-feature-list-wrap">
                        <div class="icon">
                            <i class="fas fa-square-check"></i>
                        </div>
                        <div class="why-feature-list-details">
                            <h4 class="feature-title">Robust Foundations</h4>
                            <p >By exploring individual needs, wants, and daily behaviours Project CLEAR gets to the root of development challenges. Using proprietary data, the expertise of our world-class advisory network, and careful analysis of local contexts, we put robust insights at the foundation of our campaign design and development.</p>
                        </div>
                    </li>
                    <li class="why-feature-list-wrap">
                        <div class="icon"><i class="fas fa-square-check"></i></div>
                        <div class="why-feature-list-details">
                            <h4 class="feature-title">Adaptive Delivery</h4>
                            <p >Project CLEAR is driving a paradigm shift in the development sector by applying adaptive programming to the robust foundations we set at the start of our projects. What does this mean?<br>
                                From the outset, we use all channels to achieve our development goals—from TV, radio, and social media, to sporting platforms, celebrity influencers, and political pledges. We then constantly collect data on the campaign through on-the-ground polling and local surveys, giving us a clear picture of what is working and how public perceptions have changed. From this, we’re able to evolve our tactics, maximizing the efficacy of our approach and reacting to shifts in both local and national contexts.
                            <br>
                                The result is measurable impact delivered with maximum cost efficiency, helping catalyze large-scale change with an optimized return on investment.</p>
                        </div>
                    </li>
           
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>

</div>
