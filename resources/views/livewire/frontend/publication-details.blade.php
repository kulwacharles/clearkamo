<div>
       <div class="breadcumb-wrapper" data-bg-src="{{asset('assets/img/bg/breadcumb-bg.jpg')}}">
            <div class="breadcumb-shape1"><img src="{{asset('assets/img/shape/breadcrumb-shape1.svg')}}" alt="img">
            </div>
            <div class="breadcumb-shape2">
                <img src="{{asset('assets/img/shape/breadcrumb-shape2.svg')}}" alt="img">
            </div>
            <div class="container">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">Publication Details</h1>
                    <ul class="breadcumb-menu">
                        <li><a href="index-2.html">Home</a></li>
                        <li>Publication Details</li>
                    </ul>
                </div>
            </div>
       </div>
    <section class="th-blog-wrapper blog-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-10">
                <div class="col-xxl-8 col-md-8 col-lg-8">
                    <div class="th-blog blog-single">
                        <div class="blog-img">
                            <img src="{{ asset('storage/'.$publication->image) }}" alt="Blog Image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <i class="far fa-user">
                                        </i>
                                        Post By Admin
                                </a> 
                                <a href="blog.html">
                                    <i class="fa-light fa-calendar-days"></i>
                                    {{ $publication->updated_at->format('d F, Y') }}
                                </a> 
                                <a href="blog-details.html">
                                    <i class="far fa-comments"></i>
                                    Comments 03
                                </a>
                            </div>
                            <h2 class="blog-title">{{ $publication->title }}</h2>
                            <p>{!! $publication->description !!}</p>

                        

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4 col-lg-4">
                    <aside class="sidebar-area">

                        <div class="widget">
                            <h3 class="widget_title">Recent Publications</h3>
                            <div class="recent-post-wrap">
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="blog-details.html">
                                            <img src="{{asset('assets/img/blog/recent-post-1-1.jpg')}}" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                            <a href="blog.html"><i class="fa-light fa-calendar-days"></i>21 June, 2024</a>
                                        </div>
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="blog-details.html">Guiding Businesses to Success</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="blog-details.html">
                                            <img src="{{asset('assets/img/blog/recent-post-1-2.jpg')}}" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                            <a href="blog.html">
                                                <i class="fa-light fa-calendar-days"></i>22 June, 2024
                                            </a>
                                        </div>
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="blog-details.html">
                                                Fueling Your Business Forward
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="blog-details.html">
                                            <img src="{{asset('assets/img/blog/recent-post-1-3.jpg')}}" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                            <a href="blog.html"><i class="fa-light fa-calendar-days"></i>23 June, 2024</a>
                                        </div>
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="blog-details.html">Improve Your Health By Organic Eating</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-auto">
                                <div class="widget newsletter-widget footer-widget">
                                    <h3 class="widget_title">Subscribe Now</h3>
                                    <form class="newsletter-form">
                                        <div class="form-group">
                                            <input class="form-control" type="email" placeholder="Email Address" required=""> 
                                            <button type="submit" class="th-btn"><i class="far fa-paper-plane"></i> Subscribe</button>
                                        </div>
                                        <div class="check-group">
                                            <input type="checkbox" id="privacyPolicy">
                                            <label for="privacyPolicy">I agree to the privacy policy</label>
                                        </div>
                                    </form>
                                    {{-- <div class="th-social style2">
                                            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a> 
                                            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a> 
                                            <a href="https://www.behance.com/"><i class="fab fa-behance"></i></a>
                                            <a href="https://www.vimeo.com/"><i class="fab fa-vimeo-v"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                      </aside>
                    </div>
                </div>
            </div>
        </section>
</div>
