<div id="ck-header-root" style="position:sticky;top:0;z-index:1050;">

{{-- Sticky wrapper — keeps topbar + navbar fixed at the top together --}}
<div id="ck-header-wrap" class="ck-header-wrap">

{{-- ══════════════════════════════════════════════════════════════════════════
     TOP BAR — contact info + social icons (desktop only)
════════════════════════════════════════════════════════════════════════════ --}}
<div class="ck-topbar d-none d-lg-flex align-items-center justify-content-between">
    <div class="ck-topbar-left">
        <a href="tel:{{ $contact->phone }}"><i class="fa-regular fa-phone me-1"></i>{{ $contact->phone }}</a>
        <a href="mailto:{{ $contact->email }}" class="ms-3"><i class="fa-regular fa-envelope-open me-1"></i>{{ $contact->email }}</a>
    </div>
    <div class="ck-topbar-right">
        <a href="{{ $contact->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="{{ $contact->twitter }}" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="{{ $contact->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="{{ $contact->youtube }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        <a href="{{ $contact->linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════════════════
     MAIN NAVBAR
     Logo is always in navbar-brand — it is NEVER hidden by Bootstrap.
════════════════════════════════════════════════════════════════════════════ --}}
<nav class="ck-navbar navbar navbar-expand-lg" id="ck-navbar" aria-label="Main navigation">
    <div class="container">

        {{-- ── Logo (always visible) ─────────────────────────────────────── --}}
        <a class="navbar-brand ck-nav-brand" wire:navigate href="/">
            @if($logo)
                <img src="{{ url('/storage/'.$logo) }}" alt="ClearKamo Logo" class="ck-logo-img">
            @else
                <img src="{{ asset('assets/img/clearkamo.png') }}" alt="ClearKamo Logo" class="ck-logo-img">
            @endif
        </a>

        {{-- ── Mobile hamburger ──────────────────────────────────────────── --}}
        <button class="navbar-toggler ck-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#ckNavCollapse"
                aria-controls="ckNavCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>

        {{-- ── Collapsible nav ───────────────────────────────────────────── --}}
        <div class="collapse navbar-collapse" id="ckNavCollapse">

            {{-- Nav links centred on desktop --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item" id="ck-home-nav-item"@if(request()->is('/')) style="display:none"@endif>
                    <a class="nav-link" wire:navigate href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="/about-us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="/projects">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="/news-and-updates">News &amp; Updates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="/publications">Publications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" wire:navigate href="/vacancies">Vacancies</a>
                </li>
            </ul>

            {{-- Desktop-only: search trigger + contact CTA --}}
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

            {{-- Mobile-only: search link + contact link ─────────────────── --}}
            <div class="d-flex d-lg-none flex-column gap-2 mt-3 pb-2 ck-mobile-extras">
                <form action="{{ route('search.results') }}" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control form-control-sm" placeholder="Search…">
                    <button type="submit" class="btn btn-sm ck-mobile-search-btn ms-2">
                        <i class="far fa-search"></i>
                    </button>
                </form>
                <a wire:navigate href="/contact-us" class="ck-contact-btn w-100 text-center">
                    Contact Us <i class="fa-solid fa-arrow-up-right ms-1"></i>
                </a>
            </div>

        </div>{{-- /#ckNavCollapse --}}
    </div>{{-- /.container --}}
</nav>

</div>{{-- /#ck-header-wrap --}}

{{-- ══════════════════════════════════════════════════════════════════════════
     STYLES
════════════════════════════════════════════════════════════════════════════ --}}
<style>
    /* ── Sticky header wrapper — topbar + navbar stick together ─────────── */
    .ck-header-wrap {
        background: #ffffff;
        transition: box-shadow .25s ease;
    }
    .ck-header-wrap.scrolled {
        box-shadow: 0 4px 20px rgba(15, 23, 42, .10);
    }

    /* ── Top bar ─────────────────────────────────────────────────────────── */
    .ck-topbar {
        background: #03a4fc;
        color: rgba(255,255,255,.85);
        font-size: .82rem;
        padding: 7px 3%;
        gap: 10px;
        border-bottom: none;
        overflow: hidden;
        max-height: 60px;
        opacity: 1;
        transition: max-height .35s ease, padding .35s ease, opacity .25s ease;
    }
    .ck-topbar a {
        color: rgba(255,255,255,.9);
        text-decoration: none;
        transition: color .2s, opacity .2s;
    }
    .ck-topbar a:hover { color: #ffffff; opacity: 1; }
    .ck-topbar-right { display: flex; gap: 14px; }
    .ck-topbar-right a { font-size: .9rem; }

    /* Hide top bar while scrolled, restore when back at top */
    .ck-header-wrap.scrolled .ck-topbar {
        max-height: 0;
        padding-top: 0;
        padding-bottom: 0;
        opacity: 0;
    }

    /* ── Main navbar ─────────────────────────────────────────────────────── */
    .ck-navbar {
        background: #ffffff;
        border-bottom: 1px solid #e9ecef;
        padding: 10px 0;
        transition: none;
    }

    /* ── Logo ──────────────────────────────────────────────────────────────
       navbar-brand is NEVER hidden by Bootstrap — this is the fix.
    ───────────────────────────────────────────────────────────────────────── */
    .ck-nav-brand { padding: 0; margin-right: 24px; flex-shrink: 0; }
    .ck-logo-img  { width: 140px; height: auto; display: block; }
    @media (max-width: 575.98px) { .ck-logo-img { width: 115px; } }

    /* ── Nav links ───────────────────────────────────────────────────────── */
    .ck-navbar .nav-link {
        color: #0f172a;
        font-size: .88rem;
        font-weight: 600;
        padding: 6px 10px;
        border-radius: 6px;
        transition: color .2s, background .2s;
        white-space: nowrap;
    }
    .ck-navbar .nav-link:hover,
    .ck-navbar .nav-link.active {
        color: #03a4fc;
        background: #eef7ff;
    }

    /* ── Hamburger ───────────────────────────────────────────────────────── */
    .ck-toggler {
        border: 1.5px solid #03a4fc;
        border-radius: 8px;
        padding: 6px 10px;
        color: #03a4fc;
        background: transparent;
        transition: background .2s;
    }
    .ck-toggler:hover { background: #eef7ff; }
    .ck-toggler:focus { box-shadow: 0 0 0 3px rgba(3,164,252,.25); outline: none; }
    .ck-toggler i { font-size: 1.15rem; pointer-events: none; }

    /* ── Desktop search ──────────────────────────────────────────────────── */
    .ck-search-trigger {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 1px solid #dbe4ff;
        background: #f8faff;
        color: #03a4fc;
        transition: background .2s, border-color .2s;
        cursor: pointer;
    }
    .ck-search-trigger:hover { background: #eef4ff; border-color: #b8d0ff; }
    .ck-search-popover {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 380px;
        max-width: min(380px, 90vw);
        background: #fff;
        border: 1px solid #dbe4ff;
        border-radius: 14px;
        box-shadow: 0 18px 38px rgba(15,23,42,.14);
        padding: 10px;
        display: none;
        z-index: 1200;
    }
    .ck-search-wrap.open .ck-search-popover { display: block; }

    /* ── Contact CTA button ──────────────────────────────────────────────── */
    .ck-contact-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #03a4fc;
        color: #ffffff;
        font-size: .84rem;
        font-weight: 700;
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        transition: background .2s, transform .15s;
        white-space: nowrap;
    }
    .ck-contact-btn:hover { background: #028de0; color: #fff; transform: translateY(-1px); }

    /* ── Mobile extras ───────────────────────────────────────────────────── */
    .ck-mobile-extras .form-control { border-radius: 8px; font-size: .85rem; }
    .ck-mobile-search-btn {
        background: #03A4FC;
        color: #fff;
        border-radius: 8px;
        padding: 6px 12px;
    }
    .ck-mobile-search-btn:hover { background: #028de0; color: #fff; }

    /* ── Mobile collapse panel ───────────────────────────────────────────── */
    @media (max-width: 991.98px) {
        #ckNavCollapse {
            background: #fff;
            border-top: 1px solid #e9ecef;
            padding: 12px 4px;
        }
        .ck-navbar .nav-link {
            padding: 9px 12px;
            font-size: .92rem;
            border-radius: 8px;
        }
        .ck-nav-actions { display: none !important; }
    }
</style>

{{-- ══════════════════════════════════════════════════════════════════════════
     SCRIPTS
════════════════════════════════════════════════════════════════════════════ --}}
<script>
(function () {
    /* ── Scroll shadow on the wrapper ────────────────────────────────── */
    const applyScrollClass = () => {
        const wrap = document.getElementById('ck-header-wrap');
        if (!wrap) return;
        if (window.scrollY > 10) wrap.classList.add('scrolled');
        else wrap.classList.remove('scrolled');
    };

    /* ── Desktop search popover ───────────────────────────────────────── */
    const bindSearch = () => {
        const wrap    = document.querySelector('.ck-search-wrap');
        const trigger = document.getElementById('ck-search-trigger');
        if (!wrap || !trigger) return;

        trigger.onclick = e => { e.preventDefault(); e.stopPropagation(); wrap.classList.toggle('open'); };
    };

    /* ── Active nav link + Home link visibility ───────────────────────── */
    const markActive = () => {
        const path = window.location.pathname;
        document.querySelectorAll('.ck-navbar .nav-link').forEach(a => {
            const href = a.getAttribute('href') || '';
            const isHome = href === '/' && path === '/';
            const isOther = href !== '/' && path.startsWith(href);
            a.classList.toggle('active', isHome || isOther);
        });
        const homeItem = document.getElementById('ck-home-nav-item');
        if (homeItem) homeItem.style.display = (path === '/') ? 'none' : '';
    };

    /* ── Init / re-init on Livewire navigate ──────────────────────────── */
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
