<div>
    <div class="breadcumb-wrapper" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="breadcumb-shape1">
            <img src="assets/img/shape/breadcrumb-shape1.svg" alt="img">
        </div>
        <div class="breadcumb-shape2">
            <img src="assets/img/shape/breadcrumb-shape2.svg" alt="img">
        </div>
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">News & Updates</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>News & updates</li>
                </ul>
            </div>
        </div>
    </div>
    
    <section class="th-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-40"> 
                @if($blogs)
                <div class="col-xxl-8 col-lg-7">
                   @foreach ($blogs as $blog)
                        <div class="th-blog blog-single has-post-thumbnail">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <i class="far fa-user"></i>By Konsal
                                </a>
                                 <a href="blog.html">
                                    <i class="fa-light fa-calendar-days"></i>{{$blog->created_at}}
                                </a>
                               
                             </div>
                            <h2 class="blog-title">
                                <a href="blog-details.html">{{$blog->title}}</a>
                            </h2>
                            <p class="blog-text">
                               {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($blog->description)), 350, '...') }}

                            </p>
                            <a href="blog-details.html" class="th-btn">Read More
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-up-right ms-3"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                   @endforeach
                   

                    <div class="th-pagination">
                        {{-- <ul>
                             <li>
                                <a href="blog.html">
                                    <i class="far fa-arrow-left"></i>
                                </a>
                            </li>
                            <li>
                                <a href="blog.html">1</a>
                            </li>
                            <li>
                                <a href="blog.html">2</a>
                            </li>
                            <li>
                                <a href="blog.html">3</a>
                            </li>
                            <li>
                                <a href="blog.html">
                                    <i class="far fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul> --}}
                        {{ $blogs->links() }}
                    </div>
                </div>
                @else
                <div class="col-xxl-8 col-lg-7">
                    There is no post
                </div>
                @endif
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        {{-- <div class="widget widget_search">
                            <form class="search-form">
                                <input type="text" placeholder="Enter Keyword"> 
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div> --}}
                         {{-- <div class="widget widget_categories">
                            <h3 class="widget_title">Post Categories</h3>
                            <ul>
                                <li>
                                    <a href="blog.html">Compliance Audits</a> 
                                    <span>(8)</span>
                                </li>
                                <li>
                                    <a href="blog.html">Employee Relations</a> <span>(10)</span>
                                </li>
                                <li>
                                    <a href="blog.html">HR Consulting</a> <span>(12)</span>
                                </li>
                                <li>
                                    <a href="blog.html">Legal Contract</a> <span>(6)</span>
                                </li>
                                <li>
                                    <a href="blog.html">Small Business HR</a> <span>(8)</span>
                                </li>
                                <li>
                                    <a href="blog.html">Business Management</a> <span>(11)</span>
                                </li>
                            </ul>
                         </div> --}}
                        <div class="widget">
                            
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                            <a href="blog.html">
                                                <i class="fa-light fa-calendar-days"></i>
                                                21 June, 2024
                                            </a>
                                        </div>
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="blog-details.html">Guiding Businesses to Success</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/recent-post-1-2.jpg" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                            <a href="blog.html">
                                                <i class="fa-light fa-calendar-days"></i>22 June, 2024
                                            </a>
                                        </div>
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="blog-details.html">Fueling Your Business Forward</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/recent-post-1-3.jpg" alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                            <a href="blog.html"><i class="fa-light fa-calendar-days"></i>23 June, 2024
                                            </a>
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
