@php
    $phone = $contact->phone ?? '+255710343530';
    $email = $contact->email ?? 'info@clearkamo.com';
    $address = $contact->physical_address ?? 'Bahari Beach, Madaba Street, Dar es Salaam 14122';

    $socialLinks = [
        'facebook' => $contact->facebook ?? null,
        'twitter' => $contact->twitter ?? null,
        'instagram' => $contact->instagram ?? null,
        'youtube' => $contact->youtube ?? null,
        'linkedin' => $contact->linkedin ?? null,
    ];
@endphp

<div id="ck-header-root" class="ck-header-root">
    <div id="ck-header-wrap" class="ck-header-wrap">
        <div class="ck-header-glow d-none d-lg-block" aria-hidden="true"></div>

        <div class="ck-topbar-shell d-none d-lg-block">
            <div class="container">
                <div class="ck-topbar d-flex align-items-center justify-content-between">
                    <div class="ck-topbar-left d-flex align-items-center">
                        <a href="tel:{{ $phone }}" class="ck-contact-pill" aria-label="Call us">
                            <i class="fa-regular fa-phone"></i>
                            <span>{{ $phone }}</span>
                        </a>
                        <a href="mailto:{{ $email }}" class="ck-contact-pill" aria-label="Email us">
                            <i class="fa-regular fa-envelope"></i>
                            <span>{{ $email }}</span>
                        </a>
                        <span class="ck-contact-pill ck-contact-pill-location" aria-label="Office location">
                            <i class="fa-regular fa-location-dot"></i>
                            <span>{{ $address }}</span>
                        </span>
                    </div>

                    <div class="ck-topbar-right">
                        @if (filled($socialLinks['facebook']))
                            <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if (filled($socialLinks['twitter']))
                            <a href="{{ $socialLinks['twitter'] }}" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if (filled($socialLinks['instagram']))
                            <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if (filled($socialLinks['youtube']))
                            <a href="{{ $socialLinks['youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if (filled($socialLinks['linkedin']))
                            <a href="{{ $socialLinks['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <nav class="ck-navbar navbar navbar-expand-lg" id="ck-navbar" aria-label="Main navigation">
            <div class="container">
                <div class="ck-nav-shell d-flex align-items-center w-100">
                    <a class="navbar-brand ck-nav-brand" wire:navigate href="/" aria-label="ClearKamo Home">
                        @if($logo)
                            <img src="{{ url('/storage/'.$logo) }}" alt="ClearKamo Logo" class="ck-logo-img">
                        @else
                            <img src="{{ asset('assets/img/clearkamo.png') }}" alt="ClearKamo Logo" class="ck-logo-img">
                        @endif
                        <span class="ck-logo-tagline d-none d-xxl-inline">THE PATH TO RELIABLE RESULTS</span>
                    </a>

                    <button class="navbar-toggler ck-toggler ms-auto" type="button"
                            data-bs-toggle="collapse" data-bs-target="#ckNavCollapse"
                            aria-controls="ckNavCollapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <i class="far fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="ckNavCollapse">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" wire:navigate href="/about-us">Who We Are</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" wire:navigate href="/services">Our Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" wire:navigate href="/projects">Our Projects</a>
                            </li>
                            <li class="nav-item dropdown ck-resources-nav">
                                <a class="nav-link dropdown-toggle" href="#" id="ckResourcesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Resources
                                </a>
                                <ul class="dropdown-menu ck-resources-menu" aria-labelledby="ckResourcesDropdown">
                                    <li><a class="dropdown-item ck-resource-link" wire:navigate href="/publications">Publications</a></li>
                                    <li><a class="dropdown-item ck-resource-link" wire:navigate href="/news-and-updates">Reports</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="d-flex align-items-center gap-2 ck-nav-actions">
                            <div class="ck-search-wrap position-relative">
                                <button type="button" class="ck-search-trigger" id="ck-search-trigger" aria-label="Open search">
                                    <i class="far fa-search"></i>
                                </button>
                                <div class="ck-search-popover" id="ck-search-popover">
                                    @livewire('frontend.search-box')
                                </div>
                            </div>

                            <a wire:navigate href="/contact-us" class="ck-contact-btn d-none d-xl-inline-flex align-items-center gap-2">
                                Contact Us <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                        </div>

                        <div class="d-flex d-lg-none flex-column gap-2 mt-3 pb-2 ck-mobile-extras">
                            <form action="{{ route('search.results') }}" method="GET" class="d-flex">
                                <input type="text" name="q" class="form-control form-control-sm" placeholder="Search...">
                                <button type="submit" class="btn btn-sm ck-mobile-search-btn ms-2">
                                    <i class="far fa-search"></i>
                                </button>
                            </form>
                            <a wire:navigate href="/contact-us" class="ck-contact-btn w-100 text-center">
                                Contact Us <i class="fa-solid fa-arrow-up-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <style>
        .ck-header-root {
            position: sticky;
            top: 0;
            z-index: 1050;
            width: 100%;
        }

        .ck-header-wrap {
            position: relative;
            background: linear-gradient(135deg, #080809 0%, #080e1c 100%);
            transition: box-shadow .25s ease;
            overflow: visible;
        }

        .ck-header-wrap.scrolled {
            box-shadow: 0 10px 28px rgba(0, 0, 0, .38);
        }

        .ck-header-glow {
            position: absolute;
            inset: -40% auto auto -120px;
            width: 420px;
            height: 420px;
            border-radius: 999px;
            background: radial-gradient(circle at center, rgba(3, 164, 252, .28), rgba(3, 164, 252, 0));
            pointer-events: none;
        }

        .ck-topbar-shell {
            position: relative;
            z-index: 1;
            border-bottom: 1px solid rgba(255, 255, 255, .14);
            max-height: 84px;
            overflow: hidden;
            transition: max-height .35s ease, opacity .28s ease, border-color .28s ease;
        }

        .ck-topbar {
            min-height: 54px;
            gap: 12px;
            padding: 8px 0;
            background: linear-gradient(90deg, rgba(255,255,255,.08) 0%, rgba(255,255,255,.02) 100%);
            transition: max-height .35s ease, opacity .25s ease, padding .35s ease, transform .35s ease;
            max-height: 72px;
            opacity: 1;
            overflow: hidden;
        }

        .ck-topbar-left {
            gap: 10px;
            flex-wrap: nowrap;
            min-width: 0;
            overflow: hidden;
        }

        .ck-contact-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #e3f3ff;
            font-size: .80rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, .14);
            background: rgba(255, 255, 255, .06);
            border-radius: 999px;
            padding: 8px 12px;
            transition: border-color .2s ease, background .2s ease, color .2s ease;
            white-space: nowrap;
        }

        .ck-contact-pill i {
            color: #03a4fc;
        }

        .ck-contact-pill:hover {
            color: #ffffff;
            border-color: rgba(3, 164, 252, .55);
            background: rgba(3, 164, 252, .18);
        }

        .ck-contact-pill-location {
            max-width: 360px;
            cursor: default;
        }

        .ck-contact-pill-location span {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ck-topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .ck-topbar-right a {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .16);
            background: rgba(255, 255, 255, .07);
            color: #d8eeff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform .2s ease, background .2s ease, color .2s ease, border-color .2s ease;
        }

        .ck-topbar-right a:hover {
            color: #ffffff;
            background: rgba(3, 164, 252, .30);
            border-color: rgba(3, 164, 252, .65);
            transform: translateY(-1px);
        }

        .ck-header-wrap.scrolled .ck-topbar-shell {
            max-height: 0;
            opacity: 0;
            border-color: transparent;
        }

        .ck-header-wrap.scrolled .ck-topbar {
            max-height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
            transform: translateY(-10px);
        }

        .ck-navbar {
            position: relative;
            background: transparent;
            border-bottom: none;
            padding: 8px 0 12px;
            z-index: 2;
            transition: padding .35s ease;
            overflow: visible;
        }

        .ck-header-wrap.scrolled .ck-navbar {
            padding: 0 0 10px;
        }

        .ck-nav-shell {
            position: relative;
            background: rgba(255, 255, 255, .96);
            border: 1px solid rgba(255, 255, 255, .56);
            box-shadow: 0 18px 38px rgba(2, 20, 43, .22);
            border-radius: 16px;
            padding: 10px 16px;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            transition: box-shadow .35s ease, border-radius .35s ease, background .35s ease;
        }

        .ck-header-wrap.scrolled .ck-nav-shell {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            box-shadow: 0 14px 28px rgba(0, 0, 0, .28);
            background: rgba(255, 255, 255, .98);
        }

        .ck-nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-right: 26px;
            padding: 0;
            flex-shrink: 0;
            text-decoration: none;
        }

        .ck-logo-img {
            width: 150px;
            max-width: 100%;
            height: auto;
            display: block;
        }

        .ck-logo-tagline {
            color: #4b5d78;
            font-size: .74rem;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            border-left: 1px solid #d9e6f5;
            padding-left: 12px;
            margin-left: 2px;
            white-space: nowrap;
        }

        .ck-navbar .nav-link {
            position: relative;
            color: #0f172a;
            font-size: .92rem;
            font-weight: 700;
            padding: 10px 12px;
            border-radius: 10px;
            white-space: nowrap;
            transition: color .2s ease, background .2s ease;
        }

        .ck-navbar .nav-link::after {
            content: '';
            position: absolute;
            left: 12px;
            right: 12px;
            bottom: 6px;
            height: 2px;
            border-radius: 999px;
            background: #03a4fc;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform .2s ease;
        }

        .ck-navbar .nav-link:hover,
        .ck-navbar .nav-link.active {
            color: #03a4fc;
            background: rgba(3, 164, 252, .08);
        }

        .ck-navbar .nav-link:hover::after,
        .ck-navbar .nav-link.active::after {
            transform: scaleX(1);
        }

        .ck-resources-menu {
            margin-top: 8px;
            border: 1px solid #dbe4ff;
            border-radius: 12px;
            box-shadow: 0 18px 34px rgba(15, 23, 42, .14);
            padding: 8px;
            min-width: 220px;
            z-index: 1400;
        }

        .ck-resource-link {
            border-radius: 8px;
            font-size: .88rem;
            font-weight: 600;
            color: #0f172a;
            padding: 8px 10px;
        }

        .ck-resource-link:hover,
        .ck-resource-link.active {
            color: #03a4fc;
            background: #eef7ff;
        }

        @media (min-width: 992px) {
            .ck-resources-nav:hover > .ck-resources-menu {
                display: block;
            }
        }

        .ck-nav-actions {
            padding-left: 8px;
        }

        .ck-search-trigger {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            border: 1px solid #d8e3f3;
            background: #f7fbff;
            color: #03a4fc;
            transition: background .2s ease, border-color .2s ease, transform .15s ease;
            cursor: pointer;
        }

        .ck-search-trigger:hover {
            background: #eef7ff;
            border-color: #b6d8f5;
            transform: translateY(-1px);
        }

        .ck-search-popover {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 390px;
            max-width: min(390px, 92vw);
            background: #ffffff;
            border: 1px solid #dbe4ff;
            border-radius: 14px;
            box-shadow: 0 18px 38px rgba(15, 23, 42, .16);
            padding: 10px;
            display: none;
            z-index: 1500;
        }

        .ck-search-wrap.open .ck-search-popover {
            display: block;
        }

        .ck-contact-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: linear-gradient(135deg, #03a4fc 0%, #0f85de 100%);
            color: #ffffff;
            font-size: .87rem;
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            white-space: nowrap;
            box-shadow: 0 10px 20px rgba(3, 164, 252, .25);
            transition: transform .16s ease, box-shadow .2s ease;
        }

        .ck-contact-btn:hover {
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 14px 24px rgba(3, 164, 252, .30);
        }

        .ck-toggler {
            border: 1.5px solid #03a4fc;
            border-radius: 10px;
            padding: 6px 10px;
            color: #03a4fc;
            background: rgba(3, 164, 252, .06);
        }

        .ck-toggler:hover {
            background: rgba(3, 164, 252, .12);
        }

        .ck-toggler:focus {
            box-shadow: 0 0 0 3px rgba(3, 164, 252, .2);
            outline: none;
        }

        .ck-mobile-extras .form-control {
            border-radius: 9px;
            font-size: .9rem;
        }

        .ck-mobile-search-btn {
            background: #03a4fc;
            color: #fff;
            border-radius: 9px;
            padding: 6px 12px;
        }

        .ck-mobile-search-btn:hover {
            background: #028de0;
            color: #fff;
        }

        @media (max-width: 1399.98px) {
            .ck-contact-pill-location {
                max-width: 260px;
            }
        }

        @media (max-width: 1279.98px) {
            .ck-contact-pill-location {
                display: none;
            }
        }

        @media (max-width: 1199.98px) {
            .ck-topbar-left {
                gap: 8px;
            }

            .ck-contact-pill {
                font-size: .75rem;
                padding: 7px 10px;
            }

            .ck-logo-img {
                width: 136px;
            }

            .ck-nav-shell {
                padding: 8px 12px;
            }

            .ck-navbar .nav-link {
                font-size: .89rem;
                padding: 8px 10px;
            }
        }

        @media (max-width: 991.98px) {
            .ck-navbar {
                padding: 6px 0 8px;
            }

            .ck-nav-shell {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                border-radius: 12px;
                padding: 10px 12px;
                box-shadow: 0 12px 24px rgba(2, 20, 43, .16);
                row-gap: 8px;
            }

            .ck-nav-brand {
                margin-right: auto;
            }

            .ck-logo-img {
                width: 126px;
            }

            #ckNavCollapse {
                flex: 0 0 100%;
                width: 100%;
                background: #fff;
                border-top: 1px solid #e6eef8;
                margin-top: 10px;
                border-radius: 10px;
                padding: 12px 6px 8px;
                max-height: calc(100vh - 120px);
                overflow-y: auto;
                overscroll-behavior: contain;
                -webkit-overflow-scrolling: touch;
            }

            .ck-navbar .nav-link {
                padding: 10px 12px;
                border-radius: 8px;
                font-size: .94rem;
            }

            .ck-resources-menu {
                border: 0;
                box-shadow: none;
                padding: 4px 0 4px 14px;
                margin-top: 2px;
            }

            .ck-resources-nav .dropdown-menu {
                position: static;
                float: none;
                transform: none !important;
                width: 100%;
            }

            .ck-nav-actions {
                display: none !important;
            }
        }

        @media (max-width: 767.98px) {
            .ck-nav-shell {
                padding: 8px 10px;
            }

            .ck-navbar .nav-link {
                font-size: .91rem;
                padding: 9px 11px;
            }

            .ck-mobile-extras .form-control {
                height: 42px;
                min-height: 42px;
                padding: 0 12px;
                font-size: .88rem;
            }

            .ck-mobile-search-btn {
                min-width: 44px;
                padding: 6px 10px;
            }
        }

        @media (max-width: 575.98px) {
            .ck-logo-img {
                width: 114px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .ck-header-wrap,
            .ck-topbar-shell,
            .ck-topbar,
            .ck-navbar,
            .ck-nav-shell,
            .ck-navbar .nav-link,
            .ck-navbar .nav-link::after,
            .ck-contact-pill,
            .ck-topbar-right a,
            .ck-search-trigger,
            .ck-contact-btn {
                transition: none !important;
            }
        }
    </style>

    <script>
        (function () {
            const applyScrollClass = () => {
                const wrap = document.getElementById('ck-header-wrap');
                if (!wrap) return;
                if (window.scrollY > 10) wrap.classList.add('scrolled');
                else wrap.classList.remove('scrolled');
            };

            const bindSearch = () => {
                const wrap = document.querySelector('.ck-search-wrap');
                const trigger = document.getElementById('ck-search-trigger');
                if (!wrap || !trigger) return;

                trigger.onclick = e => {
                    e.preventDefault();
                    e.stopPropagation();
                    wrap.classList.toggle('open');
                };
            };

            const markActive = () => {
                const path = window.location.pathname;

                document.querySelectorAll('.ck-navbar .nav-link').forEach(a => {
                    const href = a.getAttribute('href') || '';
                    const isHome = href === '/' && path === '/';
                    const isOther = href !== '/' && path.startsWith(href);
                    a.classList.toggle('active', isHome || isOther);
                });

                const resourcePaths = ['/publications', '/news-and-updates', '/reports'];
                const resourcesToggle = document.querySelector('.ck-resources-nav > .nav-link');
                if (resourcesToggle) {
                    const isResourcesPath = resourcePaths.some(p => path === p || path.startsWith(p + '/'));
                    resourcesToggle.classList.toggle('active', isResourcesPath);
                }

                document.querySelectorAll('.ck-resources-menu .ck-resource-link').forEach(link => {
                    const href = link.getAttribute('href') || '';
                    const isActive = path === href || path.startsWith(href + '/');
                    link.classList.toggle('active', isActive);
                });
            };

            const init = () => {
                applyScrollClass();
                bindSearch();
                markActive();
            };

            if (!window.__ckNavBound) {
                window.__ckNavBound = true;

                window.addEventListener('scroll', applyScrollClass, { passive: true });

                document.addEventListener('click', e => {
                    const wrap = document.querySelector('.ck-search-wrap');
                    if (wrap && !wrap.contains(e.target)) wrap.classList.remove('open');
                });

                document.addEventListener('keydown', e => {
                    if (e.key === 'Escape') {
                        const wrap = document.querySelector('.ck-search-wrap');
                        if (wrap) wrap.classList.remove('open');
                    }
                });
            }

            document.addEventListener('livewire:navigated', init);
            init();
        })();
    </script>
</div>
