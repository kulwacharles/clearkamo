@if($whoWeAre)
<div class="overflow-hidden space" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 mb-50 mb-xl-0">
                <div class="img-box4">
                    <div class="img1">
                        <img src="{{ asset($whoWeAre->image_path ?? 'assets/img/default/about.jpg') }}" alt="About">
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="title-area mb-30">
                    <span class="sub-title">
                        <img class="me-2" src="assets/img/theme-img/title_icon.svg" alt="shape">
                        WHO WE ARE
                        <img class="ms-1" src="assets/img/theme-img/title_icon.svg" alt="img">
                    </span>
                    <h3 class="sec-title">{{ $whoWeAre->title }}</h3>
                    <p class="sec-text">{{ $whoWeAre->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif