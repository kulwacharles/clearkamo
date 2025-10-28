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
                <h1 class="breadcumb-title">Work With Us</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Vacancies</li>
                </ul>
            </div>
        </div>
    </div>
    
    <section class="th-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-40">
                 @if($vacancies)
                <div class="col-xxl-8 col-lg-7">
                     @foreach ($vacancies as $vacancie)
                    <div class="th-blog blog-single has-post-thumbnail">
                        <div class="blog-img">
                            <a href="blog-details.html">
                                <img src="{{ asset('storage/'.$vacancie->image) }}" alt="Blog Image">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <i class="far fa-user"></i>Publicated by Admin
                                </a>
                                 <a href="blog.html">
                                    <i class="fa-light fa-calendar-days"></i>{{$vacancie->created_at->format('d F, Y')}}
                                </a>
                               
                             </div>
                            <h2 class="blog-title">
                                <a href="/vacancy/details/{{ $vacancie->id }}">{{$vacancie->title}}</a>
                            </h2>
                            <p class="blog-text">
                                 {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($vacancie->description)), 350, '...') }}
                            </p>
                            <a href="/vacancy/details/{{ $vacancie->id }}" class="th-btn">Read More
                                <div class="icon">
                                    <i class="fa-solid fa-arrow-up-right ms-3"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="th-pagination">
                        {{ $vacancies->links() }}
                    </div>
                </div>
                @else
                <div class="col-xxl-8 col-lg-7">
                    There is no Vacancies
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
                         </div>
                        

                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>
