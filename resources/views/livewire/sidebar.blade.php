<nav class="sidebar">
    <div class="sidebar_close_icon d-lg-none">
        <i class="ti-close"></i>
    </div>
    <ul id="sidebar_menu">
        <li class="">
            <a wire:navigate href="{{ url('/admin/dashboard') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{asset('img/menu-icon/dashboard.svg')}}" alt="">
                </div>
                <div class="nav_title">
                    <span>Dashboard</span>
                </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate href="{{url('/admin/sliders')}}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{asset('img/menu-icon/21.svg')}}" alt="">
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
                  <img src="{{asset('img/menu-icon/3.svg')}}" alt="Services icon">
              </div>
              <div class="nav_title">
                  <span>Services</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/vacancies')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/17.svg')}}" alt="Vacancies icon">
              </div>
              <div class="nav_title">
                  <span>Vacancies</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate  href="{{url('/admin/team')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/14.svg')}}" alt="Team icon">
              </div>
              <div class="nav_title">
                  <span>Team</span>
              </div>
            </a>
        </li>
         <li class="">
            <a wire:navigate  href="{{url('/admin/testimony')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/10.svg')}}" alt="Testimony icon">
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
        <li class="">
            <a wire:navigate  href="{{url('/admin/contacts')}}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/20.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Contact us</span>
              </div>
            </a>
        </li>
        <li class="">
            <a wire:navigate href="{{ url('/admin/business-inquiries') }}" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{asset('img/menu-icon/11.svg')}}" alt="">
              </div>
              <div class="nav_title">
                  <span>Business Inquiries</span>
              </div>
            </a>
        </li>
      </ul>
</nav>
