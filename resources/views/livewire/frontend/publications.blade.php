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
                <h1 class="breadcumb-title">Our Publications</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Publications</li>
                </ul>
            </div>
        </div>
    </div>
    
    <section class="th-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-40">
                 @if($publications)
                <div class="col-xxl-8 col-lg-7">
                     @foreach ($publications as $publication)
                    <div class="th-blog blog-single has-post-thumbnail">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="{{ asset('storage/'.$publication->image) }}" alt="Blog Image">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <i class="far fa-user"></i>Publicated by Admin
                                </a>
                                 <a href="blog.html">
                                    <i class="fa-light fa-calendar-days"></i>{{$publication->created_at->format('d F, Y')}}
                                </a>
                               
                             </div>
                            <h2 class="blog-title">
                                <a href="/publication/details/{{ $publication->id }}">{{$publication->title}}</a>
                            </h2>
                            <p class="blog-text">
                                 {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($publication->description)), 350, '...') }}
                            </p>
                            <a href="/publication/details/{{ $publication->id }}" class="th-btn">Read More
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-up-right ms-3"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="th-pagination">
                        {{ $publications->links() }}
                    </div>
                </div>
                @else
                <div class="col-xxl-8 col-lg-7">
                    There is no Publications
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
                         <div class="widget widget_categories">
                            <h3 class="widget_title">Publication Categories</h3>
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

                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>
