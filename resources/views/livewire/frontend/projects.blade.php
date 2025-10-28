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
                <h1 class="breadcumb-title">Portfolio</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index-2.html">Home</a></li>
                    <li>Portfolio</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="title-area text-center">
                        <span class="sub-title">
                            <img class="me-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">
                            PORTFOLIO
                            <img class="ms-2" src="{{asset('assets/img/theme-img/title_icon.svg')}}" alt="shape">
                        </span>
                        <h2 class="sec-title">We're proud of the Same works</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="project-filter-btn filter-menu indicator-active filter-menu-active">
                        <button data-filter="*" class="tab-btn active" type="button">All Projects</button> 
                        <button data-filter=".cat1" class="tab-btn" type="button">BCC Experience and Expertise</button> 
                        <button data-filter=".cat2" class="tab-btn" type="button">Information & Communication</button> 
                        <button data-filter=".cat3" class="tab-btn" type="button">Infrustructure Development</button> 
                        <button data-filter=".cat4" class="tab-btn" type="button">Institutional Development</button>
                    </div>
                </div>
            </div>
            <div class="row gy-30 gx-30 filter-active">
                @if($projects)
                    @foreach ($projects as $project)
                            <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item @if($project->category=='BCC Experience and Expertise') cat1 @elseif($project->category=='Information & Communication') cat2 @elseif($project->categroy=='Infrustructure Development') cat3 @elseif($project->category='Institutional Development') cat4 @endif">
                            <div class="project-card style3">
                                <div class="project-img">
                                    <img src="{{ asset('storage/'.$project->image) }}" alt="project image">
                                </div>
                                <div class="project-content">
                                    <div class="project-details">
                                        <span class="left-angle-shape"></span> 
                                        <span class="right-angle-shape"></span>
                                        <h3 class="project-title">
                                            <a wire:navigate href="/project-details/{{ $project->id }}">{{ $project->title }}</a>
                                        </h3>
                                        <p class="project-subtitle">{{$project->category}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                @else
                There is no project
                @endif
                
                {{-- <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat3 cat2">
                    <div class="project-card style3">
                        <div class="project-img">
                            <img src="{{asset('assets/img/project/project_3_2.png')}}" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <span class="left-angle-shape"></span> 
                                <span class="right-angle-shape"></span>
                                <h3 class="project-title">
                                    <a href="project-details.html">Retirement Sail Strategies</a>
                                </h3>
                                <p class="project-subtitle">Financial consultants offer a range</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat4 cat1 cat2">
                    <div class="project-card style3">
                        <div class="project-img">
                            <img src="{{asset('assets/img/project/project_3_3.png')}}" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <span class="left-angle-shape"></span> 
                                <span class="right-angle-shape"></span>
                                <h3 class="project-title">
                                    <a href="project-details.html">Empowering Businesses</a>
                                </h3>
                                <p class="project-subtitle">Business consulting providing expert</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat3">
                    <div class="project-card style3">
                        <div class="project-img">
                            <img src="{{asset('assets/img/project/project_3_4.png')}}" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <span class="left-angle-shape"></span> 
                                <span class="right-angle-shape"></span>
                                <h3 class="project-title">
                                    <a href="project-details.html">Insightful Analytics</a>
                                </h3>
                                <p class="project-subtitle">Financial consultants offer a range</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat2 cat3">
                    <div class="project-card style3">
                        <div class="project-img">
                            <img src="{{asset('assets/img/project/project_3_6.png')}}" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <span class="left-angle-shape"></span> 
                                <span class="right-angle-shape"></span>
                                <h3 class="project-title">
                                    <a href="project-details.html">InsightTech Consulting</a>
                                </h3>
                                <p class="project-subtitle">Navigating Success Together</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-xl-4 col-lg-6 filter-item cat2 cat1 cat4">
                    <div class="project-card style3">
                        <div class="project-img">
                            <img src="{{asset('assets/img/project/project_3_5.png')}}" alt="project image">
                        </div>
                        <div class="project-content">
                            <div class="project-details">
                                <span class="left-angle-shape"></span> 
                                <span class="right-angle-shape"></span>
                                <h3 class="project-title">
                                    <a href="project-details.html">Core Strive Solutions</a>
                                </h3>
                                <p class="project-subtitle">Business consulting providing expert</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
</div>
