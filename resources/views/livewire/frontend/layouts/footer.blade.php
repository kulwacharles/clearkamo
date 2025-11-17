    <footer class="footer-wrapper footer-layout1" data-bg-src="{{asset('assets/img/bg/footer_bg_1.jpg')}}">
        <div class="widget-area">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget footer-widget">
                            <div class="th-widget-about">
                                @if($logo)
                                  <div class="about-logo">
                                        <a wire:navigate href="/">
                                            <img src="{{ url('/storage/'.$logo) }}" alt="ProjectClear-Logo">
                                        </a>
                                    </div>
                                @else
                                    <div class="about-logo">
                                        <a wire:navigate href="/">
                                            <img src="{{asset('assets/img/ProjectClear.png')}}" alt="ProjectClear-Logo">
                                        </a>
                                    </div>
                                @endif
                                <p class="about-text">Consulting services can provide valuable insights, strategic guidance, pecialized</p>
                                <div class="info-box">
                                    <div class="info-box_icon"><i class="far fa-phone"></i>
                                    </div>
                                    <p class="info-box_text">
                                        <a href="tel:+11278956825" class="info-box_link">{{ $contact->phone }}</a>
                                    </p>
                                </div>
                                <div class="info-box">
                                    <div class="info-box_icon"><i class="far fa-envelope-open"></i>
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
                    </div>
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">Our Services</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    @foreach ($services as $service)
                                        <li><a wire:navigate href="/service/details/{{ $service->id }}">{{ $service->title }}</a></li>                                
                                    @endforeach
                                    

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget footer-widget">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                @if($blogs)
                                    @foreach ($blogs as $blog)
                                        <div class="recent-post">
                                            <div class="media-img">
                                                <a wire:navigate href="/news-and-updates/details/{{ $blog->id }}"><img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image"></a>
                                            </div>
                                            <div class="media-body">
                                                <div class="recent-post-meta">
                                                    <a wire:navigate href="/news-and-updates/details/{{ $blog->id }}"><i class="fal fa-calendar-days"></i>{{$blog->updated_at->format('d F, Y')}}</a>
                                                </div>
                                                <h4 class="post-title"><a class="text-inherit" wire:navigate href="/news-and-updates/details/{{ $blog->id }}">{{$blog->title}}</a></h4>
                                            </div>
                                        </div>
                                     @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">Useful Links</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li>
                                         <a href="http://www.tanzania.go.tz/">Government of Tanzania</a>
                                    </li> 
                                    <li>
                                         <a href="http://www.moh.go.tz/en/">Ministry of Health</a>
                                    </li>                               
                                    <li>
                                        <a href="http://www.maji.go.tz/">Ministry of Water</a>
                                    </li>
                                    <li>
                                        <a href="https://dhis.moh.go.tz/dhis-web-commons/security/login.action">Tanzania HMIS</a>
                                    </li>
                                    <li>
                                        <a href="https://nyumbanichoo.com/">Nyumba ni Choo</a>
                                    </li>
                                    <li>
                                        <a href="https://innovexdc.com/">Innovex</a>
                                    </li>
                                    <li>
                                        <a href="https://www.gov.uk/world/organisations/dfid-tanzania">DFID Tanzania</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap bg-theme">
                <div class="container">
                    <div class="row gy-2 align-items-center">
                        <div class="col-lg-6">
                            <p class="copyright-text">
                                <i class="fal fa-copyright"></i> 2025 All Rights Reserved By 
                                <a href="index-2.html">ClearKamo</a>
                            </p>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end">
                            <div class="footer-links">
                                <ul>
                                    <li>
                                        <a href="about.html">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="about.html">Terms & Condition</a>
                                    </li>
                                    <li>
                                        <a href="about.html">Support policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </footer>