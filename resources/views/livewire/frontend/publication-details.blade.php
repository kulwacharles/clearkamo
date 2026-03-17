
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
                        <li><a wire:navigate href="/">Home</a></li>
                        <li>Publication Details</li>
                    </ul>
                </div>
            </div>
       </div>
    <section class="th-blog-wrapper blog-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-10">
                <div class="col-xxl-8 col-md-12 col-lg-8">
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
                            @if(!empty($publication->link))
                                <a href="{{ $publication->link }}" target="_blank" rel="noopener noreferrer" class="th-btn style3 mt-2">
                                    Open Publication <i class="fas fa-arrow-up-right-from-square ms-2"></i>
                                </a>
                            @endif

                        

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-12 col-lg-4">
                    <aside class="sidebar-area">

                        <div class="widget">
                            <h3 class="widget_title">Other Publications</h3>
                            <div class="recent-post-wrap">
                                @forelse($otherPublications as $otherPublication)
                                    <div class="recent-post">
                                        <div class="media-img">
                                            <a wire:navigate href="/publication/details/{{ $otherPublication->slug }}">
                                                <img src="{{ asset('storage/'.$otherPublication->image) }}" alt="{{ $otherPublication->title }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="recent-post-meta">
                                                <a wire:navigate href="/publication/details/{{ $otherPublication->slug }}">
                                                    <i class="fa-light fa-calendar-days"></i>{{ $otherPublication->updated_at->format('d F, Y') }}
                                                </a>
                                            </div>
                                            <h4 class="post-title">
                                                <a class="text-inherit" wire:navigate href="/publication/details/{{ $otherPublication->slug }}">
                                                    {{ $otherPublication->title }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                @empty
                                    <p class="mb-0">No other publications found.</p>
                                @endforelse
                            </div>
                        </div>
                      </aside>
                    </div>
                </div>
            </div>
        </section>
</div>
