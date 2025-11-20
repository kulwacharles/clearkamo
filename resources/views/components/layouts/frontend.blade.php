<!doctype html><html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ClearKamo </title>
    <meta name="author" content="Konsal"><meta name="description" content="ClearKamo"><meta name="keywords" content="ClearKamo">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/img/favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/img/favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/img/favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/img/favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/img/favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/img/favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/img/favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/img/favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/favicons/manifest.json')}}"> --}}
   
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/favicons/site.webmanifest')}}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/img/favicons/ms-icon-144x144.png')}}"><meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

     @livewireStyles
</head>
<body>
    {{-- <div class="preloader">
        <button class="th-btn preloaderCls">Cancel Preloader</button>
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div> --}}

@livewire('frontend.layouts.navigation')


{{ $slot }}


  <div class="cta-area-1">
    <div class="container z-index-common">
        <div class="cta-wrap bg-theme">
            <div class="cta-thumb">
                <img src="{{asset('assets/img/bg/cta_bg_1.jpg')}}" alt="icon">
            </div>
            <div class="cta-content">
                <h5 class="cta-subtitle">WE ARE HERE</h5>
                <h4 class="cta-title">Tell us about your business we are ready to solve.</h4>
            </div>
            <a wire:navigate href="/contact-us" class="th-btn style7">Read More
                <div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i>
                </div>
            </a>
        </div>
    </div>
</div>
    @livewire('frontend.layouts.footer')
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>
<script src="{{asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
@livewireScripts
</body>

</html>