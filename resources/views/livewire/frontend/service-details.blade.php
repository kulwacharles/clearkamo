<div>
       <div class="breadcumb-wrapper" data-bg-src="{{asset('assets/img/bg/breadcumb-bg.jpg')}}">
            <div class="breadcumb-shape1"><img src="{{asset('assets/img/shape/breadcrumb-shape1.svg')}}" alt="img">
            </div>
            <div class="breadcumb-shape2">
                <img src="{{asset('assets/img/shape/breadcrumb-shape2.svg')}}" alt="img">
            </div>
            <div class="container">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">Service Details</h1>
                    <ul class="breadcumb-menu">
                        <li><a wire:navigate href="/">Home</a></li>
                        <li>Service Details</li>
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
                            <img src="{{ asset('storage/'.$service->image) }}" alt="Blog Image">
                        </div>
                        <div class="blog-content">
                            {{-- <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <i class="far fa-user">
                                        </i>
                                        Post By Admin
                                </a> 
                                <a href="blog.html">
                                    <i class="fa-light fa-calendar-days"></i>
                                    {{ $service->updated_at->format('d F, Y') }}
                                </a> 
                                <a href="blog-details.html">
                                    <i class="far fa-comments"></i>
                                    Comments 03
                                </a>
                            </div> --}}
                            <h2 class="blog-title">{{ $service->title }}</h2>
                            <p>{!! $service->description !!}</p>

                        

                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-3 col-lg-3">
                    <aside class="sidebar-area">

                        <div class="widget">
                            <h3 class="widget_title">Other Services</h3>
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
                        </div>
                      </aside>
                    </div>
                </div>
            </div>
        </section>
</div>
