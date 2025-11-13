<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        @if($logo)
        <a class="large_logo" href="{{ url('/admin/about') }}"><img src="{{ url('/storage/'.$logo) }}" alt=""></a>
        <a class="small_logo" href="{{ url('/admin/about') }}"><img src="{{ url('/storage/'.$logo) }}" alt=""></a>
        @else
        <a class="large_logo" href="index-2.html"><img src="{{asset('img/logo.png')}}" alt=""></a>
        <a class="small_logo" href="index-2.html"><img src="{{asset('img/mini_logo.png')}}" alt=""></a>
        @endif
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="active">
            <a  href="{{url('/admin/sliders')}}"  aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{asset('img/menu-icon/dashboard.svg')}}" alt="">
                </div>
                <div class="nav_title">
                    <span>Sliders </span>
                </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate href="{{url('/admin/about-us')}}"  aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{asset('img/menu-icon/2.svg')}}" alt="">
                </div>
                <div class="nav_title">
                    <span>About Us </span>
                </div>
            </a>

        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/blog-posts')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/11.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>News & Updates</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/publications')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/15.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Publications</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/projects')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/6.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Projects</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/services')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/7.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Services</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/vacancies')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/7.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Vacancies</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/team')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/7.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Team</span>
              </div>
            </a>
        </li>
         <li class="">
            <a wire:navigate  href="{{url('/admin/testimony')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/7.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Testimony</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/client')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/8.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Clients</span>
              </div>
            </a>
        </li>
      </ul>
</nav>