<div>
<div class="sidemenu-wrapper sidemenu-info d-none d-lg-block">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i>
        </button>
        <div class="widget">
            <div class="th-widget-about">
                <div class="about-logo">
                    <a wire:navigate href="/">
                        <img src="{{ url('/storage/'.$logo) }}" alt="ClearKamo Logo">
                    </a>
                </div>
                <p class="about-text">Consulting services can provide valuable insights, strategic guidance, specialized

                </p>
                <div class="info-box">
                    <div class="info-box_icon">
                        <i class="far fa-phone"></i>
                    </div>
                    <p class="info-box_text">
                        <a href="tel:{{ $contact->phone }}" class="info-box_link">{{ $contact->phone }}</a>
                    </p>
                </div>
                <div class="info-box">
                    <div class="info-box_icon">
                        <i class="far fa-envelope-open"></i>
                    </div>
                    <p class="info-box_text">
                        <a href="mailto:{{ $contact->email }}" class="info-box_link">{{ $contact->email }}</a>
                    </p>
                </div>
                <div class="info-box">
                    <div class="info-box_icon">
                        <i class="far fa-location-dot"></i>
                    </div>
                    <p class="info-box_text">{{ $contact->physical_address }}</p>
                </div>
            </div>
        </div>
        <div class="widget">
            <h3 class="widget_title">Recent News & Updates</h3>
            <div class="recent-post-wrap">
                 @if($blogs)
                    @foreach ($blogs as $blog)
                        <div class="recent-post">
                            <div class="media-img">
                                <a wire:navigate href="/news-and-updates/details/{{ $blog->id }}">
                                    <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="recent-post-meta">
                                    <a  wire:navigate href="/news-and-updates/details/{{ $blog->id }}"><i class="fa-light fa-calendar-days"></i>{{$blog->updated_at->format('d F, Y')}}</a>
                                </div>
                                <h4 class="post-title"><a class="text-inherit"  wire:navigate href="/news-and-updates/details/{{ $blog->id }}">{{$blog->title}}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                @endif
    </div>
</div>
<div class="widget newsletter-widget">
    <h3 class="widget_title">Subscribe Now</h3>
    <form class="newsletter-form">
        <div class="form-group">
            <input class="form-control" type="email" placeholder="Email Address" required=""> 
            <button type="submit" class="th-btn">
                <i class="far fa-paper-plane"></i> Subscribe
            </button>
        </div>
    </form>
    <div class="th-social style2">
        <a href="https://www.facebook.com/">
            <i class="fab fa-facebook-f"></i>
        </a> 
        <a href="https://www.twitter.com/">
            <i class="fab fa-twitter"></i>
        </a>
         <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i>
        </a> 
        <a href="https://www.behance.com/">
            <i class="fab fa-behance"></i>
        </a>
         <a href="https://www.vimeo.com/"><i class="fab fa-vimeo-v"></i>
        </a>
    </div>
</div>
</div>
</div>
<div class="popup-search-box d-none d-lg-block">
    <button class="searchClose"><i class="fal fa-times"></i>
    </button>
    <form action="{{ route('search.results') }}" method="GET"><input type="text" name="q" placeholder="What are you looking for?"> 
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div>
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a wire:navigate href="/">
                @if($logo)
                <img src="{{ url('/storage/'.$logo) }}" alt="ClearKamo Logo">
                
                @else
                <!-- <img src="assets/img/ProjectClear-Logo.png" alt="assets/img/ProjectClear-Logo"> -->
                <img src="assets/img/clearkamo.png" alt="ClearKamo Logo">
                @endif
            </a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                <li >
                    <a wire:navigate  href="/">Home</a>
                </li>
                <li>
                    <a wire:navigate  href="/about-us">About Us</a>
                </li>
                <li >
                    <a wire:navigate  href="/services">Services</a>
                </li>
                <li >
                    <a wire:navigate  href="/projects">Projects</a>
                </li>
                <li >
                    <a wire:navigate  href="/news-and-updates">News & Updates</a>
                </li>
                 <li>
                    <a wire:navigate  href="/publications">Publications</a>

                </li>
                <li>
                    <a wire:navigate  href="/contact-us">Contact Us</a>
                </li>
                <li >
                    <a wire:navigate href="/vacancies">Vacancies</a>
                </li>
            </ul>
        </div>
    </div>
</div>
 <header class="th-header header-layout7">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                <div class="col-auto d-none d-lg-block">
                    <div class="header-links">
                        <ul class="header-left-wrap">
                            <li><i class="fa-regular fa-phone"></i><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></li>
                            <li><i class="fa-regular fa-envelope-open"></i><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul class="header-right-wrap">
         
                                <li>
                                    <div class="social-links">
                                        <a href="{{ $contact->facebook }}"><i class="fab fa-facebook-f"></i></a> 
                                        <a href="{{ $contact->twitter }}"><i class="fab fa-twitter"></i></a> 
                                        <a href="{{ $contact->instagram }}"><i class="fab fa-instagram"></i></a>
                                        <a href="{{ $contact->youtube }}"><i class="fab fa-youtube"></i></a>
                                        <a href="{{ $contact->linkedin }}"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                <a wire:navigate href="/">
                                @if($logo)
                                <img src="{{ url('/storage/'.$logo) }}" alt="ClearKamo Logo">
                                
                                @else
                                <!-- <img src="assets/img/ProjectClear-Logo.png" alt="assets/img/ProjectClear-Logo"> -->
                                <img src="assets/img/clearkamo.png" alt="ClearKamo Logo">
                                @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-auto me-xl-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li >
                                        <a wire:navigate  href="/">Home</a>
                                      
                                    </li>
                                    <li>
                                        <a wire:navigate href="/about-us">About Us</a>
                                    </li>
                                    <li >
                                        <a wire:navigate href="/services">Services</a>
                                        
                                    </li>
                                    <li >
                                        <a wire:navigate href="/projects">Projects</a>
                                        
                                    </li>
                                    <li >
                                        <a wire:navigate href="/news-and-updates">News & Updates</a>
                                        
                                    </li>
                                    <li >
                                        <a wire:navigate href="/publications">Publications</a>
                                    </li>
                                    <li >
                                        <a wire:navigate href="/vacancies">Vacancies</a>
                                    </li>
                                    <li>
                                        <a wire:navigate  href="/contact-us">Contact Us</a>
                                    </li>  
                                    {{-- <li>
                                        <a wire:navigate  href="/contact-us">Contact Us</a>
                                    </li> --}}
                                </ul>
                            </nav>
                            <div class="header-button d-flex d-lg-none">
                                 <button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto d-none d-xl-block">
                            <div class="header-search-wrap">
                                <button type="button" class="simple-icon header-search-trigger" id="header-search-trigger" aria-label="Open search">
                                    <i class="far fa-search"></i>
                                </button>
                                <div class="header-search-popover" id="header-search-popover">
                                    @livewire('frontend.search-box')
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-auto d-none d-xl-block">
                            <div class="header-button">
                                <button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i>
                                </button> 
                                     <button type="button" class="simple-icon sideMenuInfo"><i class="fa-solid fa-bars"></i>
                                    </button>
                                    <div class="d-xxl-block d-none">
                                        <a wire:navigate href="/contact-us" class="th-btn">
                                            Contact us <span class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
         </div>
</header>
<style>
    .header-search-wrap {
        position: relative;
        display: flex;
        justify-content: flex-end;
        margin-left: 14px;
    }

    .header-search-trigger {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        border: 1px solid #dbe4ff;
        background: #ffffff;
        color: #03A4FC;
        transition: all .2s ease;
    }

    .header-search-trigger:hover {
        background: #eef4ff;
        border-color: #c7d7ff;
    }

    .header-search-popover {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 390px;
        max-width: min(390px, 72vw);
        background: #ffffff;
        border: 1px solid #dbe4ff;
        border-radius: 14px;
        box-shadow: 0 18px 38px rgba(15, 23, 42, 0.16);
        padding: 10px;
        display: none;
        z-index: 1200;
    }

    .header-search-wrap.open .header-search-popover {
        display: block;
    }
</style>
<script>
    (function () {
        const bindHeaderSearch = () => {
            const wrap = document.querySelector('.header-search-wrap');
            const trigger = document.getElementById('header-search-trigger');

            if (!wrap || !trigger) {
                return;
            }

            trigger.onclick = function (e) {
                e.preventDefault();
                wrap.classList.toggle('open');
            };
        };

        if (!window.__headerSearchBound) {
            window.__headerSearchBound = true;

            document.addEventListener('click', function (e) {
                const wrap = document.querySelector('.header-search-wrap');
                if (wrap && !wrap.contains(e.target)) {
                    wrap.classList.remove('open');
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    const wrap = document.querySelector('.header-search-wrap');
                    if (wrap) {
                        wrap.classList.remove('open');
                    }
                }
            });
        }

        document.addEventListener('livewire:navigated', bindHeaderSearch);
        bindHeaderSearch();
    })();
</script>
</div>
