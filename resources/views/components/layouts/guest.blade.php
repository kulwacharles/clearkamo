
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            $adminAuthLogo = \App\Models\About::query()->value('logo');
            $adminAuthLogoUrl = $adminAuthLogo ? url('/storage/' . $adminAuthLogo) : asset('img/mini_logo.png');
        @endphp
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <link rel="icon" href="{{ $adminAuthLogoUrl }}" type="image/png">
            <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap1.min.css')}}" />
        <!-- themefy CSS -->
        <link rel="stylesheet" href="{{asset('vendors/themefy_icon/themify-icons.css')}}" />
        <!-- select2 CSS -->
        <link rel="stylesheet" href="{{asset('vendors/niceselect/css/nice-select.css')}}" />
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="{{asset('vendors/owl_carousel/css/owl.carousel.css')}}" />
        <!-- gijgo css -->
        <link rel="stylesheet" href="{{asset('vendors/gijgo/gijgo.min.css')}}" />
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="{{asset('vendors/font_awesome/css/all.min.css')}}" />
        <link rel="stylesheet" href="{{asset('vendors/tagsinput/tagsinput.css')}}" />

        <!-- date picker -->
        <link rel="stylesheet" href="{{asset('vendors/datepicker/date-picker.css')}}" />

        <link rel="stylesheet" href="{{asset('vendors/vectormap-home/vectormap-2.0.2.css')}}" />
        
        <!-- scrollabe  -->
        <link rel="stylesheet" href="{{asset('vendors/scroll/scrollable.css')}}" />
        <!-- datatable CSS -->
        <link rel="stylesheet" href="{{asset('vendors/datatable/css/jquery.dataTables.min.css')}}" />
        <link rel="stylesheet" href="{{asset('vendors/datatable/css/responsive.dataTables.min.css')}}" />
        <link rel="stylesheet" href="{{asset('vendors/datatable/css/buttons.dataTables.min.css')}}" />
        <!-- text editor css -->
        <link rel="stylesheet" href="{{asset('vendors/text_editor/summernote-bs4.css')}}" />
        <!-- morris css -->
        <link rel="stylesheet" href="{{asset('vendors/morris/morris.css')}}">
        <!-- metarial icon css -->
        <link rel="stylesheet" href="{{asset('vendors/material_icon/material-icons.css')}}" />

        <!-- menu css  -->
        <link rel="stylesheet" href="{{asset('css/metisMenu.css')}}">
        <!-- style CSS -->
        <link rel="stylesheet" href="{{asset('css/style1.css')}}" />
        <link rel="stylesheet" href="{{asset('css/colors/default.css')}}" id="colorSkinCSS">
        <script src="{{asset('js/jquery1-3.4.1.min.js')}}"></script> 
        <style>
            body.crm_body_bg {
                min-height: 100vh;
                background:
                    radial-gradient(circle at top left, rgba(3, 164, 252, 0.22), transparent 34%),
                    radial-gradient(circle at bottom right, rgba(163, 163, 163, 0.18), transparent 28%),
                    linear-gradient(135deg, #f7fbff 0%, #eef5fb 52%, #f9fbfd 100%);
            }

            .admin-auth-shell {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 32px 16px;
            }

            .admin-auth-panel {
                width: min(1120px, 100%);
                display: grid;
                grid-template-columns: minmax(320px, 440px) minmax(0, 1fr);
                background: rgba(255, 255, 255, 0.82);
                border: 1px solid rgba(255, 255, 255, 0.8);
                border-radius: 28px;
                overflow: hidden;
                box-shadow: 0 24px 80px rgba(15, 23, 42, 0.12);
                backdrop-filter: blur(16px);
            }

            .admin-auth-aside {
                position: relative;
                padding: 42px 34px;
                color: #fff;
                background:
                    linear-gradient(160deg, rgba(3, 164, 252, 0.96) 0%, rgba(8, 68, 125, 0.9) 100%);
            }

            .admin-auth-aside::after {
                content: "";
                position: absolute;
                inset: auto -70px -70px auto;
                width: 220px;
                height: 220px;
                border-radius: 50%;
                background: rgba(255,255,255,.14);
                filter: blur(10px);
            }

            .admin-auth-brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 34px;
            }

            .admin-auth-brand img {
                height: 42px;
                width: auto;
                object-fit: contain;
                filter: brightness(0) invert(1);
            }

            .admin-auth-brand span {
                font-size: 26px;
                font-weight: 800;
                letter-spacing: .02em;
            }

            .admin-auth-kicker {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: .22em;
                text-transform: uppercase;
                margin-bottom: 18px;
                opacity: .88;
            }

            .admin-auth-kicker::before {
                content: "";
                width: 26px;
                height: 2px;
                border-radius: 999px;
                background: rgba(255,255,255,.8);
            }

            .admin-auth-aside h1 {
                margin: 0 0 14px;
                font-size: clamp(2rem, 1.4rem + 1.6vw, 3rem);
                line-height: 1.05;
                font-weight: 800;
            }

            .admin-auth-aside p {
                margin: 0;
                font-size: 15px;
                line-height: 1.85;
                color: rgba(255,255,255,.88);
                max-width: 30ch;
            }

            .admin-auth-points {
                margin: 34px 0 0;
                padding: 0;
                list-style: none;
                display: grid;
                gap: 12px;
            }

            .admin-auth-points li {
                display: flex;
                gap: 12px;
                align-items: flex-start;
                padding: 12px 14px;
                border-radius: 16px;
                background: rgba(255,255,255,.1);
                font-size: 14px;
                line-height: 1.55;
            }

            .admin-auth-points i {
                margin-top: 3px;
                color: #fff;
            }

            .admin-auth-main {
                padding: 42px 42px 36px;
                background: rgba(255, 255, 255, 0.92);
            }

            .admin-auth-card {
                max-width: 470px;
                margin: 0 auto;
            }

            .admin-auth-title {
                margin: 0 0 8px;
                color: #0f172a;
                font-size: 32px;
                font-weight: 800;
                letter-spacing: -.02em;
            }

            .admin-auth-subtitle {
                margin: 0 0 28px;
                color: #64748b;
                font-size: 15px;
                line-height: 1.7;
            }

            .admin-auth-label {
                display: block;
                font-size: 13px;
                font-weight: 700;
                color: #334155;
                margin-bottom: 8px;
            }

            .admin-auth-control {
                min-height: 54px;
                border: 1px solid #d9e3f0;
                border-radius: 16px;
                background: #fff;
                padding: 0 16px;
                color: #0f172a;
                box-shadow: none !important;
            }

            .admin-auth-control:focus {
                border-color: #03a4fc;
                box-shadow: 0 0 0 4px rgba(3, 164, 252, 0.14) !important;
            }

            .admin-auth-btn {
                width: 100%;
                min-height: 54px;
                border: 0;
                border-radius: 16px;
                background: linear-gradient(135deg, #03a4fc 0%, #0b7dd6 100%);
                color: #fff;
                font-size: 15px;
                font-weight: 700;
                box-shadow: 0 18px 36px rgba(3, 164, 252, 0.24);
            }

            .admin-auth-btn:hover {
                color: #fff;
            }

            .admin-auth-links {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-top: 18px;
                font-size: 14px;
            }

            .admin-auth-link {
                color: #0284c7;
                font-weight: 600;
                text-decoration: none;
            }

            .admin-auth-link:hover {
                color: #0369a1;
                text-decoration: none;
            }

            .admin-auth-alert {
                border-radius: 16px;
                border: 1px solid transparent;
                padding: 14px 16px;
                margin-bottom: 20px;
                font-size: 14px;
            }

            .admin-auth-alert.success {
                color: #166534;
                background: #effdf5;
                border-color: #bbf7d0;
            }

            .admin-auth-alert.error {
                color: #b91c1c;
                background: #fef2f2;
                border-color: #fecaca;
            }

            @media (max-width: 991.98px) {
                .admin-auth-panel {
                    grid-template-columns: 1fr;
                }

                .admin-auth-main,
                .admin-auth-aside {
                    padding: 30px 22px;
                }
            }
        </style>
         
        @livewireStyles
    </head>
    <body  class="crm_body_bg">
         <!-- sidebar  -->

        <!--/ sidebar  -->
        <!-- footer  -->
        <section class="main_content dashboard_part large_header_bg">

            <div class="main_content_iner overly_inner ">
                    <div class="container-fluid p-0 ">
                        <!-- page title  -->



                        <div class="row ">
                         {{ $slot }}
                        </div>
                    </div>
            </div>
            
            <!-- footer part -->
            @livewire('footer')
        </section>
            <!-- main content part end -->
        <div id="back-top" style="display: none;">
            <a title="Go to Top" href="#">
                <i class="ti-angle-up"></i>
            </a>
        </div>
         @stack('modals')
        <!-- popper js -->
        <script src="{{asset('js/popper1.min.js')}}"></script>
        <!-- bootstarp js -->
        <script src="{{asset('js/bootstrap1.min.js')}}"></script>
        <!-- sidebar menu  -->
     
        
        @livewireScripts
      
        {{-- Modals area --}}
       {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
    </body>
</html>
