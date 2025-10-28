<div>
       <div class="breadcumb-wrapper" data-bg-src="{{asset('assets/img/bg/breadcumb-bg.jpg')}}">
            <div class="breadcumb-shape1"><img src="{{asset('assets/img/shape/breadcrumb-shape1.svg')}}" alt="img">
            </div>
            <div class="breadcumb-shape2">
                <img src="{{asset('assets/img/shape/breadcrumb-shape2.svg')}}" alt="img">
            </div>
            <div class="container">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">{{$blog->title}}</h1>
                    <ul class="breadcumb-menu">
                        <li><a wire:navigate href="/">Home</a></li>
                        <li>Blog Details</li>
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
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="#">
                                    <i class="far fa-user">
                                        </i>
                                        Post By Admin
                                </a> 
                                <a href="#">
                                    <i class="fa-light fa-calendar-days"></i>
                                    {{ $blog->updated_at->format('d F, Y') }}
                                </a> 
                                {{-- <a href="/news-and-updates/details/{{ $blog->id }}">
                                    <i class="far fa-comments"></i>
                                    Comments 03
                                </a> --}}
                            </div>
                            <h2 class="blog-title">{{ $blog->title }}</h2>
                            <p>{!! $blog->description !!}</p>

                        

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4 col-lg-4">
                    <aside class="sidebar-area">

                        <div class="widget">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                @if($others)
                                    @foreach ($others as $other)
                                        <div class="recent-post">
                                        <div class="media-img">
                                            <a wire:navigate href="/news-and-updates/details/{{ $other->id }}">
                                                <img src="{{ asset('storage/'.$other->image) }}" alt="Blog Image">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="recent-post-meta">
                                                <a wire:navigate href="news-and-updates/details/{{ $other->id }}"><i class="fa-light fa-calendar-days"></i>{{ $other->updated_at->format('d F, Y') }}</a>
                                            </div>
                                            <h4 class="post-title">
                                                <a wire:navigate class="text-inherit" href="/news-and-updates/details/{{ $other->id }}">{{ $other->title }}g</a>
                                            </h4>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                @else
                                    No other Post
                                @endif
                            </div>
                        </div>
                      </aside>
                    </div>
                </div>
            </div>
        </section>
</div>
