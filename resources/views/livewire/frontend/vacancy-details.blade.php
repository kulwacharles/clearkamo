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
                <h1 class="breadcumb-title" style="font-size:40px">{{$vacancy->title}}</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Job Details</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-8">
                    <div class="page-single mb-0">
                        <img src="{{ asset('storage/'.$vacancy->image) }}" alt="img">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4">
                    <aside class="sidebar-area">
                        <div class="widget widget_info"><h3 class="widget_title">Job Details</h3>
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <div>
                                            <span class="text">Title  :</span> 
                                            <strong class="title">{{$vacancy->title}}</strong>
                                        </div>
                                    </li>
                                     <li>
                                        <div>
                                            <span class="text">Department  :</span> 
                                            <strong class="title">{{$vacancy->department}}</strong>
                                        </div>
                                    </li>
                                     <li>
                                        <div>
                                            <span class="text">Reporting To  :</span> 
                                            <strong class="title">{{$vacancy->report_to}}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <span class="text">Number of Position(S) :</span> 
                                            <strong class="title">{{$vacancy->positions}}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <span class="text">Due Date :</span> 
                                            <strong class="title">{{date('d F, Y', strtotime($vacancy->due_date))}}</strong>
                                        </div>
                                    </li>
                                       <li>
                                        <div>
                                            <span class="text">Contract Type :</span> 
                                            <strong class="title">{{$vacancy->contract}}</strong>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-12">
                    <div class="page-single mb-40 mt-15">
                        <div class="page-content">
                            <h2 class="sec-title page-title h3">Project Overview</h2>
                            <p class="">
                                {!! $vacancy->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
