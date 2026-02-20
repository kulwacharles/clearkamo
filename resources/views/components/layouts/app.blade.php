
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <link rel="icon" href="{{asset('img/mini_logo.png')}}" type="image/png">
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
        <script>
            (function () {
                try {
                    var savedTheme = localStorage.getItem('admin-theme') || 'light';
                    document.documentElement.setAttribute('data-admin-theme', savedTheme);
                } catch (e) {}
            })();
        </script>
        <style>
            body.crm_body_bg.admin-modern-ui {
                background: var(--admin-bg) !important;
                color: var(--admin-text) !important;
            }

            body.admin-modern-ui {
                --admin-bg: #f3f6fb;
                --admin-surface: #ffffff;
                --admin-surface-soft: #f8fafc;
                --admin-border: #e6ebf3;
                --admin-text: #0f172a;
                --admin-muted: #64748b;
                --admin-accent: #2563eb;
                --admin-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            }

            html[data-admin-theme='dark'] body.admin-modern-ui {
                --admin-bg: #0b1220;
                --admin-surface: #0b0f19;
                --admin-surface-soft: #0f1522;
                --admin-border: #1f2a3d;
                --admin-text: #f1f5f9;
                --admin-muted: #a4b3c8;
                --admin-accent: #60a5fa;
                --admin-shadow: 0 12px 28px rgba(2, 6, 23, 0.45);
            }

            body.admin-modern-ui .main_content {
                background: var(--admin-bg) !important;
            }

            body.admin-modern-ui .main_content .main_content_iner {
                background: transparent !important;
            }

            .admin-sticky-header {
                position: fixed;
                top: 0;
                z-index: 1200;
                background: color-mix(in srgb, var(--admin-surface) 92%, transparent);
                backdrop-filter: blur(8px);
                border-bottom: 1px solid var(--admin-border);
                box-shadow: var(--admin-shadow);
                padding-left: 12px;
                padding-right: 12px;
                margin: 0 !important;
                transform: none !important;
                transition: none !important;
            }

            .main_content .admin-sticky-header {
                left: 270px;
                right: 0;
                width: auto !important;
            }

            .main_content.full_main_content .admin-sticky-header {
                left: 136px;
            }

            .main_content.main_content_padding_hide .admin-sticky-header {
                left: 0;
            }

            @media (max-width: 991px) {
                .main_content .admin-sticky-header {
                    left: 0;
                }
            }

            .admin-header-spacer {
                height: 88px;
            }

            body.admin-modern-ui .sidebar {
                background: var(--admin-surface) !important;
                border-right: 1px solid var(--admin-border);
                box-shadow: var(--admin-shadow);
                padding-top: 88px !important;
            }

            body.admin-modern-ui .sidebar #sidebar_menu {
                padding-top: 8px;
            }

            body.admin-modern-ui .sidebar .logo {
                border-bottom: 1px solid var(--admin-border);
            }

            body.admin-modern-ui .sidebar #sidebar_menu > li > a {
                border-radius: 12px;
                margin: 4px 12px;
                color: var(--admin-muted);
                transition: all .2s ease;
            }

            body.admin-modern-ui .sidebar #sidebar_menu > li > a:hover,
            body.admin-modern-ui .sidebar #sidebar_menu > li > a.active,
            body.admin-modern-ui .sidebar #sidebar_menu > li.mm-active > a {
                background: var(--admin-surface-soft);
                color: var(--admin-text);
            }

            body.admin-modern-ui .sidebar #sidebar_menu > li > a .nav_title span {
                font-weight: 600;
                letter-spacing: .1px;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .sidebar #sidebar_menu > li > a {
                background: #0f1522 !important;
                border: 1px solid #1f2a3d !important;
                color: #d7e1ef !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .sidebar #sidebar_menu > li > a:hover,
            html[data-admin-theme='dark'] body.admin-modern-ui .sidebar #sidebar_menu > li > a.active,
            html[data-admin-theme='dark'] body.admin-modern-ui .sidebar #sidebar_menu > li.mm-active > a {
                background: #141d2c !important;
                color: #f8fafc !important;
                border-color: #2a3a55 !important;
            }

            .admin-sticky-header .header_right .header_notification_warp li {
                list-style: none;
            }

            .admin-theme-toggle {
                height: 38px;
                border: 1px solid var(--admin-border);
                border-radius: 10px;
                background: var(--admin-surface-soft);
                color: var(--admin-text);
                padding: 0 11px;
                display: inline-flex;
                align-items: center;
                gap: 7px;
                font-size: 12px;
                font-weight: 600;
                margin-right: 10px;
                cursor: pointer;
            }

            .admin-theme-toggle i {
                font-size: 13px;
            }

            body.admin-modern-ui .header_iner .serach_field-area .search_inner input {
                background: var(--admin-surface-soft) !important;
                border: 1px solid var(--admin-border) !important;
                color: var(--admin-text) !important;
                border-radius: 10px !important;
            }

            body.admin-modern-ui .header_iner .serach_field-area .search_inner input::placeholder {
                color: var(--admin-muted) !important;
            }

            .admin-chat-pop-wrap {
                position: fixed;
                top: 86px;
                right: 20px;
                z-index: 1080;
                width: 320px;
                max-width: calc(100vw - 30px);
            }

            .admin-chat-pop {
                display: none;
                border-radius: 12px;
                border: 1px solid var(--admin-border);
                background: var(--admin-surface);
                box-shadow: var(--admin-shadow);
                padding: 12px 14px;
            }

            .admin-chat-pop.active {
                display: block;
                animation: adminChatPopIn .2s ease-out;
            }

            .admin-chat-pop .title {
                margin: 0 0 4px;
                font-size: 13px;
                font-weight: 700;
                color: #1d4ed8;
            }

            .admin-chat-pop .meta {
                margin: 0 0 2px;
                font-size: 12px;
                font-weight: 600;
                color: var(--admin-text);
            }

            .admin-chat-pop .text {
                margin: 0;
                font-size: 12px;
                color: var(--admin-muted);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            body.admin-modern-ui .white_card,
            body.admin-modern-ui .modal-content,
            body.admin-modern-ui .white_box,
            body.admin-modern-ui .card,
            body.admin-modern-ui .page_date_button,
            body.admin-modern-ui .white_card_body,
            body.admin-modern-ui .QA_section,
            body.admin-modern-ui .footer_part .footer_iner {
                background: var(--admin-surface) !important;
                border: 1px solid var(--admin-border) !important;
                box-shadow: var(--admin-shadow) !important;
                color: var(--admin-text) !important;
                border-radius: 14px !important;
            }

            body.admin-modern-ui .footer_part {
                background: transparent !important;
            }

            body.admin-modern-ui .white_card_header,
            body.admin-modern-ui .table thead th,
            body.admin-modern-ui .modal-header,
            body.admin-modern-ui .modal-footer {
                border-color: var(--admin-border) !important;
            }

            body.admin-modern-ui .table,
            body.admin-modern-ui .table td,
            body.admin-modern-ui .table th,
            body.admin-modern-ui .table tbody tr,
            body.admin-modern-ui .dataTables_wrapper .dataTables_length,
            body.admin-modern-ui .dataTables_wrapper .dataTables_info,
            body.admin-modern-ui .question_content,
            body.admin-modern-ui .main-title h3,
            body.admin-modern-ui .dark_text,
            body.admin-modern-ui .breadcrumb-item,
            body.admin-modern-ui .breadcrumb-item a,
            body.admin-modern-ui label,
            body.admin-modern-ui .footer_part p {
                color: var(--admin-text) !important;
            }

            body.admin-modern-ui .text-muted,
            body.admin-modern-ui .breadcrumb-item.active {
                color: var(--admin-muted) !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .table,
            html[data-admin-theme='dark'] body.admin-modern-ui .table thead th,
            html[data-admin-theme='dark'] body.admin-modern-ui .table tbody tr,
            html[data-admin-theme='dark'] body.admin-modern-ui .table td,
            html[data-admin-theme='dark'] body.admin-modern-ui .QA_table .table,
            html[data-admin-theme='dark'] body.admin-modern-ui .QA_table,
            html[data-admin-theme='dark'] body.admin-modern-ui .QA_table .dataTables_wrapper,
            html[data-admin-theme='dark'] body.admin-modern-ui .dataTables_scroll,
            html[data-admin-theme='dark'] body.admin-modern-ui .dataTables_scrollBody,
            html[data-admin-theme='dark'] body.admin-modern-ui .dataTables_wrapper .dataTables_paginate .paginate_button,
            html[data-admin-theme='dark'] body.admin-modern-ui .dataTables_wrapper .dataTables_filter input,
            html[data-admin-theme='dark'] body.admin-modern-ui .dataTables_wrapper .dataTables_length select {
                background: #0f1522 !important;
                color: #eef2ff !important;
                border-color: #233149 !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .dataTables_wrapper .dataTables_paginate .paginate_button.current,
            html[data-admin-theme='dark'] body.admin-modern-ui .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                background: #1d4ed8 !important;
                border-color: #1d4ed8 !important;
                color: #fff !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .badge.bg-success,
            html[data-admin-theme='dark'] body.admin-modern-ui .badge.bg-warning,
            html[data-admin-theme='dark'] body.admin-modern-ui .badge.bg-secondary {
                color: #0b1220 !important;
            }

            body.admin-modern-ui .form-control,
            body.admin-modern-ui input[type='text'],
            body.admin-modern-ui input[type='email'],
            body.admin-modern-ui input[type='url'],
            body.admin-modern-ui textarea,
            body.admin-modern-ui select {
                background: var(--admin-surface-soft) !important;
                border: 1px solid var(--admin-border) !important;
                color: var(--admin-text) !important;
                border-radius: 10px !important;
            }

            body.admin-modern-ui .btn-primary,
            body.admin-modern-ui .btn_1 {
                background: var(--admin-accent) !important;
                border-color: var(--admin-accent) !important;
                color: #fff !important;
                border-radius: 10px !important;
            }

            body.admin-modern-ui .btn-secondary {
                border-radius: 10px !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .header_iner .header_right .header_notification_warp li > a span {
                background: #f97316 !important;
                color: #fff !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .profile_info_iner,
            html[data-admin-theme='dark'] body.admin-modern-ui .Menu_NOtification_Wrap,
            html[data-admin-theme='dark'] body.admin-modern-ui .dropdown-menu,
            html[data-admin-theme='dark'] body.admin-modern-ui .modal-body,
            html[data-admin-theme='dark'] body.admin-modern-ui .note-editor.note-frame,
            html[data-admin-theme='dark'] body.admin-modern-ui .note-toolbar,
            html[data-admin-theme='dark'] body.admin-modern-ui .note-editing-area,
            html[data-admin-theme='dark'] body.admin-modern-ui .note-editable {
                background: #0f1522 !important;
                color: #eaf0ff !important;
                border-color: #233149 !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .profile_info_iner a,
            html[data-admin-theme='dark'] body.admin-modern-ui .Menu_NOtification_Wrap h4,
            html[data-admin-theme='dark'] body.admin-modern-ui .Menu_NOtification_Wrap p,
            html[data-admin-theme='dark'] body.admin-modern-ui .Menu_NOtification_Wrap h5,
            html[data-admin-theme='dark'] body.admin-modern-ui .dropdown-item,
            html[data-admin-theme='dark'] body.admin-modern-ui .note-editor * {
                color: #eaf0ff !important;
            }

            html[data-admin-theme='dark'] body.admin-modern-ui .btn-close {
                filter: invert(1) grayscale(1);
            }

            @keyframes adminChatPopIn {
                from { opacity: 0; transform: translateY(-8px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
         
        @livewireStyles
    </head>
    <body  class="crm_body_bg admin-modern-ui">
         <!-- sidebar  -->
         @livewire('sidebar')
        <!--/ sidebar  -->
        @php
            $initialUnreadChats = \App\Models\ChatMessage::where('sender_type', 'user')
                ->where('is_read', false)
                ->distinct('session_id')
                ->count('session_id');

            $initialLatestUserMessageId = \App\Models\ChatMessage::where('sender_type', 'user')
                ->max('id') ?? 0;

            $routeName = request()->route()?->getName();
            $adminRouteLabels = [
                'sliders' => 'Sliders',
                'admin.about' => 'About Us',
                'admin.blogs' => 'News & Updates',
                'admin.publications' => 'Publications',
                'admin.projects' => 'Projects',
                'admin.services' => 'Services',
                'admin.vacancies' => 'Vacancies',
                'admin.team' => 'Team',
                'admin.testimony' => 'Testimony',
                'admin.client' => 'Clients',
                'admin.contacts' => 'Contact Us',
                'admin.chat' => 'Chat Inbox',
            ];

            $currentPageTitle = $adminRouteLabels[$routeName] ?? ucfirst(str_replace(['-', '_'], ' ', request()->segment(2) ?? 'Dashboard'));
            $breadcrumbItems = [
                ['label' => 'Dashboard', 'url' => url('/admin/sliders')],
            ];

            if ($currentPageTitle !== 'Dashboard') {
                $breadcrumbItems[] = ['label' => $currentPageTitle, 'url' => null];
            }
        @endphp
        <div class="admin-chat-pop-wrap">
            <a href="{{ route('admin.chat') }}" id="admin-chat-pop" class="admin-chat-pop">
                <p class="title">New Chat Message</p>
                <p class="meta" id="admin-chat-pop-name">Customer</p>
                <p class="text" id="admin-chat-pop-text">You have a new incoming message.</p>
            </a>
        </div>
        <!-- footer  -->
        <section class="main_content dashboard_part large_header_bg">
              <!-- menu  -->
            <div class="container-fluid g-0">
                <div class="row">
                    <div class="col-lg-12 p-0 ">
                        <div class="header_iner admin-sticky-header d-flex justify-content-between align-items-center">
                            <div class="sidebar_icon d-lg-none">
                                <i class="ti-menu"></i>
                            </div>
                            <div class="line_icon open_miniSide d-none d-lg-block">
                                <img src="{{asset('img/line_img.png')}}" alt="">
                            </div>
                            <div class="serach_field-area d-flex align-items-center">
                                <div class="search_inner">
                                    <form action="#">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search">
                                        </div>
                                        <button type="submit"> <img src="{{asset('img/icon/icon_search.svg')}}" alt=""> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="header_right d-flex justify-content-between align-items-center">
                                <button type="button" id="admin-theme-toggle" class="admin-theme-toggle" title="Toggle dark mode">
                                    <i class="ti-moon"></i>
                                    <span>Dark</span>
                                </button>
                                <div class="header_notification_warp d-flex align-items-center">
                                    <li>
                                        <a class="bell_notification_clicker" href="#"> <img src="{{asset('img/icon/bell.svg')}}" alt="">
                                            <span>2</span>
                                        </a>
                                        <!-- Menu_NOtification_Wrap  -->
                                    <div class="Menu_NOtification_Wrap">
                                        <div class="notification_Header">
                                            <h4>Notifications</h4>
                                        </div>
                                        <div class="Notification_body">
                                            <!-- single_notify  -->
                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="{{asset('img/staf/2.png')}}" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>Cool Marketing </h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                            <!-- single_notify  -->
                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="{{asset('img/staf/4.png')}}" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>Awesome packages</h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                            <!-- single_notify  -->
                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="{{asset('img/staf/3.png')}}" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>what a packages</h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                            <!-- single_notify  -->
                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="{{asset('img/staf/2.png')}}" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>Cool Marketing </h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                            <!-- single_notify  -->
                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="{{asset('img/staf/4.png')}}" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>Awesome packages</h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                            <!-- single_notify  -->
                                            <div class="single_notify d-flex align-items-center">
                                                <div class="notify_thumb">
                                                    <a href="#"><img src="{{asset('img/staf/3.png')}}" alt=""></a>
                                                </div>
                                                <div class="notify_content">
                                                    <a href="#"><h5>what a packages</h5></a>
                                                    <p>Lorem ipsum dolor sit amet</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nofity_footer">
                                            <div class="submit_button text-center pt_20">
                                                <a href="#" class="btn_1">See More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Menu_NOtification_Wrap  -->
                                    </li>
                                    <li>
                                        <a class="CHATBOX_open" href="{{ route('admin.chat') }}" title="Open chat inbox">
                                            <img src="{{asset('img/icon/msg.svg')}}" alt="">
                                            <span id="admin-chat-badge">{{ $initialUnreadChats }}</span>
                                        </a>
                                    </li>
                                </div>
                                <div class="profile_info">
                                    <img src="{{asset('img/client_img.png')}}" alt="#">
                                    <div class="profile_info_iner">
                                        <div class="profile_author_name">
                                            <p>Neurologist </p>
                                            <h5>Dr. Robar Smith</h5>
                                        </div>
                                        <div class="profile_info_details">
                                            <a href="#">My Profile </a>
                                            <a href="#">Settings</a>
                                            
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                               <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="admin-header-spacer" class="admin-header-spacer"></div>
            </div>
            <!--/ menu  -->
            <div class="main_content_iner overly_inner ">
                    <div class="container-fluid p-0 ">
                        <!-- page title  -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="page_title_left d-flex align-items-center">
                                        <h3 class="f_s_25 f_w_700 dark_text mr_30">{{ $currentPageTitle }}</h3>
                                        <ol class="breadcrumb page_bradcam mb-0">
                                            @foreach($breadcrumbItems as $crumb)
                                                @if($crumb['url'])
                                                    <li class="breadcrumb-item"><a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a></li>
                                                @else
                                                    <li class="breadcrumb-item active">{{ $crumb['label'] }}</li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </div>
                                    <div class="page_title_right">
                                        <div class="page_date_button d-flex align-items-center"> 
                                            <img src="{{asset('img/icon/calender_icon.svg')}}" alt="">
                                            August 1, 2020 - August 31, 2020
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


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
        <script src="{{asset('js/metisMenu.js')}}"></script>
        <!-- waypoints js -->
        <script src="{{asset('vendors/count_up/jquery.waypoints.min.js')}}"></script>
        <!-- waypoints js -->
        <script src="{{asset('vendors/chartlist/Chart.min.js')}}"></script>
        <!-- counterup js -->
        <script src="{{asset('vendors/count_up/jquery.counterup.min.js')}}"></script>

        <!-- nice select -->
        <script src="{{asset('vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>
        <!-- owl carousel -->
        <script src="{{asset('vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>

        <!-- responsive table -->
        <script src="{{asset('vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/jszip.min.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('vendors/datatable/js/buttons.print.min.js')}}"></script>

        <!-- datepicker  -->
        <script src="{{asset('vendors/datepicker/datepicker.js')}}"></script>
        <script src="{{asset('vendors/datepicker/datepicker.en.js')}}"></script>
        <script src="{{asset('vendors/datepicker/datepicker.custom.js')}}"></script>

        <script src="{{asset('js/chart.min.js')}}"></script>
        <script src="{{asset('vendors/chartjs/roundedBar.min.js')}}"></script>

        <!-- progressbar js -->
        <script src="{{asset('vendors/progressbar/jquery.barfiller.js')}}"></script>
        <!-- tag input -->
        <script src="{{asset('vendors/tagsinput/tagsinput.js')}}"></script>
        <!-- text editor js -->
        <script src="{{asset('vendors/text_editor/summernote-bs4.js')}}"></script>
        <script src="{{asset('vendors/am_chart/amcharts.js')}}"></script>
        <script src="{{asset('js/ckeditor-classic.js')}}"></script>
        
        <!-- scrollabe  -->
        <script src="{{asset('vendors/scroll/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('vendors/scroll/scrollable-custom.js')}}"></script>

        <!-- vector map  -->
        <script src="{{asset('vendors/vectormap-home/vectormap-2.0.2.min.js')}}"></script>
        <script src="{{asset('vendors/vectormap-home/vectormap-world-mill-en.js')}}"></script>

        <!-- apex chrat  -->
        {{-- <script src="{{asset('vendors/apex_chart/apex-chart2.js')}}"></script>
        <script src="{{asset('vendors/apex_chart/apex_dashboard.js')}}"></script> --}}

        <!-- <script src="{{asset('vendors/echart/echarts.min.js')}}"></script> -->


        <script src="{{asset('vendors/chart_am/core.js')}}"></script>
        <script src="{{asset('vendors/chart_am/charts.js')}}"></script>
        <script src="{{asset('vendors/chart_am/animated.js')}}"></script>
        <script src="{{asset('vendors/chart_am/kelly.js')}}"></script>
        <script src="{{asset('vendors/chart_am/chart-custom.js')}}"></script>
        <!-- custom js -->
        <script src="{{asset('js/dashboard_init.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>
        <script>
            (function () {
                const rootEl = document.documentElement;
                const themeToggleEl = document.getElementById('admin-theme-toggle');

                const applyThemeToggleLabel = () => {
                    if (!themeToggleEl) {
                        return;
                    }

                    const isDark = rootEl.getAttribute('data-admin-theme') === 'dark';
                    const icon = themeToggleEl.querySelector('i');
                    const text = themeToggleEl.querySelector('span');

                    if (icon) {
                        icon.className = isDark ? 'ti-sun' : 'ti-moon';
                    }

                    if (text) {
                        text.textContent = isDark ? 'Light' : 'Dark';
                    }
                };

                if (themeToggleEl) {
                    themeToggleEl.addEventListener('click', function () {
                        const nextTheme = rootEl.getAttribute('data-admin-theme') === 'dark' ? 'light' : 'dark';
                        rootEl.setAttribute('data-admin-theme', nextTheme);
                        try {
                            localStorage.setItem('admin-theme', nextTheme);
                        } catch (e) {}
                        applyThemeToggleLabel();
                    });
                }

                applyThemeToggleLabel();
                document.addEventListener('livewire:navigated', () => {
                    try {
                        const persistedTheme = localStorage.getItem('admin-theme') || 'light';
                        rootEl.setAttribute('data-admin-theme', persistedTheme);
                    } catch (e) {}
                    applyThemeToggleLabel();
                });

                const badgeEl = document.getElementById('admin-chat-badge');
                const popEl = document.getElementById('admin-chat-pop');
                const popNameEl = document.getElementById('admin-chat-pop-name');
                const popTextEl = document.getElementById('admin-chat-pop-text');
                const realtimeUrl = "{{ route('admin.chat.realtime') }}";
                const isOnChatPage = "{{ request()->routeIs('admin.chat') ? '1' : '0' }}" === '1';
                let lastSeenMessageId = Number("{{ $initialLatestUserMessageId }}") || 0;
                let hideTimer = null;

                const showPopup = (name, text) => {
                    if (!popEl || isOnChatPage) {
                        return;
                    }

                    popNameEl.textContent = name || 'Customer';
                    popTextEl.textContent = text || 'You have a new incoming message.';
                    popEl.classList.add('active');

                    if (hideTimer) {
                        clearTimeout(hideTimer);
                    }

                    hideTimer = setTimeout(() => {
                        popEl.classList.remove('active');
                    }, 4500);
                };

                const refreshChatMeta = () => {
                    fetch(realtimeUrl, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        credentials: 'same-origin',
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (badgeEl && typeof data.unread_chats !== 'undefined') {
                                badgeEl.textContent = data.unread_chats;
                            }

                            const latestId = Number(data.latest_user_message_id || 0);
                            if (latestId > lastSeenMessageId) {
                                showPopup(data.latest_user_name, data.latest_user_message);
                                lastSeenMessageId = latestId;
                            }
                        })
                        .catch(() => {});
                };

                refreshChatMeta();
                setInterval(refreshChatMeta, 8000);
            })();
        </script>
        
        @livewireScripts
        @stack('scripts')
        {{-- Modals area --}}
       {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
    </body>
</html>
