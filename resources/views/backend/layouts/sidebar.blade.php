<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{url('/admin')}}" class="@yield('home-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/article')}}" class="@yield('article-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Articles
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/programming')}}" class="@yield('programming-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Programming Languages
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/tag')}}" class="@yield('tag-active')">
                        <i class="metismenu-icon pe-7s-wallet"></i>
                        Tags
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/music-video')}}" class="@yield('mv-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Music Videos
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/singer')}}" class="@yield('singer-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Singers
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/music-genre')}}" class="@yield('mg-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Music Genres
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/ads')}}" class="@yield('ads-active')">
                        <i class="metismenu-icon pe-7s-wallet"></i>
                        Ads Management
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>