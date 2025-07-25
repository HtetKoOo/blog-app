<div class="app-header header-shadow">
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
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="custom-dropdown" style="position: relative; display: inline-block;">
                                <button id="customDropdownBtn" class="btn btn-secondary">
                                    {{ Auth::guard('admin')->user()->name }} <i class="fa fa-angle-down ml-1"></i>
                                </button>
                                <div id="customDropdownMenu" class="dropdown-menu-custom" style="display: none; position: absolute; right: 0; background: white; min-width: 160px; box-shadow: 0px 8px 16px rgba(0,0,0,0.2); z-index: 9999;">
                                    <a class="dropdown-item" href="#">User Account</a>
                                    <div class="dropdown-divider" style="border-top: 1px solid #ccc;"></div>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                {{ Auth::guard('admin')->user()->name }}
                            </div>
                            <div class="widget-subheading">
                                phone
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>