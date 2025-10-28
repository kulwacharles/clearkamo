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
                <h1 class="breadcumb-title" style="font-size:40px">{{$project->title}}</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Project Details</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-8">
                    <div class="page-single mb-0">
                        <img src="{{ asset('storage/'.$project->image) }}" alt="img">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4">
                    <aside class="sidebar-area">
                        <div class="widget widget_info"><h3 class="widget_title">Project Details</h3>
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <div>
                                            <span class="text">Project Name  :</span> 
                                            <strong class="title">{{$project->title}}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <span class="text">Amount Funded :</span> 
                                            <strong class="title">{{$project->amount_funded}}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <span class="text">Start Date & End Date :</span> 
                                            <strong class="title">{{date('Y', strtotime($project->start_date))}} - {{date('Y', strtotime($project->end_date))}}</strong>
                                        </div>
                                    </li>
                                       <li>
                                        <div>
                                            <span class="text">Category :</span> 
                                            <strong class="title">{{$project->category}}</strong>
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
                                {!! $project->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
