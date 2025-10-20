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
                <h1 class="breadcumb-title">Team Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index-2.html">Home</a></li>
                    <li>Team Details</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="space">
        <div class="container">
            <div class="row mb-60">
                <div class="col-xl-6">
                    <div class="about-card-img mb-xl-0 mb-30">
                        <img src="{{ asset('storage/'.$member->image) }}" alt="team image">
                        <div class="th-social">
                            <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a> 
                            <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a> 
                            <a target="_blank" href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a> 
                            <a target="_blank" href="https://pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-card">
                        <h2 class="about-card_title h3">{{ $member->name }}</h2>
                        <p class="about-card_desig">{{ $member->position }}</p>
                        <p class="about-card_text">
                            {!! $member->description !!}
                        </p>
                        {{-- <h4 class="box-title">Areas of Expertise:</h4>
                        <div class="checklist mb-30">
                            <ul>
                                <li>Transforming Visions into Ventures</li>
                                <li>Proident sunt culpa sed ipsum tempor sed</li>
                                <li>Ut enim ad minim veniam</li>
                            </ul>
                        </div>
                        <h4 class="box-title">Education History:</h4>
                        <div class="checklist">
                            <ul>
                                <li>MBA, Rotterdam School of Management, Erasmus University</li>
                                <li>BS, engineering, Technical University of Denmark</li>
                                <li>BS, engineering, Technical University of Denmark</li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-md-auto">
                    <h2 class="sec-title text-center">Other Team Member</h2>
                </div>
                <div class="col-md d-none d-md-block">
                    <hr class="title-line">
                </div>
                <div class="col-md-auto d-none d-md-block">
                    <div class="sec-btn">
                        <div class="icon-box">
                            <button data-slider-prev="#teamSlider1" class="slider-arrow default">
                                <i class="far fa-arrow-left"></i>
                            </button> 
                            <button data-slider-next="#teamSlider1" class="slider-arrow default">
                                <i class="far fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper th-slider has-shadow" id="teamSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}}}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="th-team team-card">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="{{asset('assets/img/team/team_1_1.png')}}" alt="Team">
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
                                <h3 class="box-title">
                                    <a href="team-details.html">Brooklyn Simmons</a>
                                </h3>
                                <span class="team-desig">Founder & CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="{{asset('assets/img/team/team_1_2.png')}}" alt="Team">
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
                                <h3 class="box-title">
                                    <a href="team-details.html">Savannah Nguyen</a>
                                </h3>
                                <span class="team-desig">Senior Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="{{asset('assets/img/team/team_1_3.png')}}" alt="Team">
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
                                <h3 class="box-title">
                                    <a href="team-details.html">Marvin McKinney</a>
                                </h3>
                                <span class="team-desig">Junior Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="{{asset('assets/img/team/team_1_1.png')}}" alt="Team">
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
                                <h3 class="box-title">
                                    <a href="team-details.html">Brooklyn Simmons</a>
                                </h3>
                                <span class="team-desig">Founder & CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="{{asset('assets/img/team/team_1_2.png')}}" alt="Team">
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
                                <h3 class="box-title">
                                    <a href="team-details.html">Savannah Nguyen</a>
                                </h3>
                                <span class="team-desig">Senior Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="th-team team-card">
                            <div class="img-wrap">
                                <div class="team-img">
                                    <img src="{{asset('assets/img/team/team_1_3.png')}}" alt="Team">
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
                                <h3 class="box-title">
                                    <a href="team-details.html">Marvin McKinney</a>
                                </h3>
                                <span class="team-desig">Junior Manager</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-block d-md-none mt-40 text-center">
                <div class="icon-box">
                    <button data-slider-prev="#teamSlider1" class="slider-arrow default">
                        <i class="far fa-arrow-left"></i>
                    </button> 
                    <button data-slider-next="#teamSlider1" class="slider-arrow default">
                        <i class="far fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
