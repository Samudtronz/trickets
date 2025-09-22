<!-- Dashboard Nav Start -->
<div class="dashboard-nav bg-white flx-between gap-md-3 gap-2">
    <div class="dashboard-nav__left flx-align gap-md-3 gap-2">
        <button type="button" class="icon-btn bar-icon text-heading bg-gray-seven flx-center">
            <img src="{{ asset('assets-backend/images/icons/menu-bar.svg') }}" alt="">
        </button>
        <button type="button" class="icon-btn arrow-icon text-heading bg-gray-seven flx-center">
            <img src="{{ asset('assets-backend/images/icons/angle-right.svg') }}" alt="">
        </button>
    </div>
    <div class="dashboard-nav__right">
        <div class="header-right flx-align">
    <div class="header-right__inner gap-sm-3 gap-2 flx-align d-flex">

        <div class="user-profile">
            <button class="user-profile__button flex-align">
                <span class="user-profile__thumb">
                    <img src="{{ asset('assets-backend/images/thumbs/user-profile.png') }}" class="cover-img" alt="">
                </span>
            </button>
            <ul class="user-profile-dropdown">
                <li class="sidebar-list__item">
                    <a href="dashboard-profile.html" class="sidebar-list__link">
                        <span class="sidebar-list__icon">
                            <img src="{{ asset('assets-backend/images/icons/sidebar-icon2.svg') }}" alt="" class="icon">
                            <img src="{{ asset('assets-backend/images/icons/sidebar-icon-active2.svg') }}" alt="" class="icon icon-active">
                        </span>
                        <span class="text">Profile</span>
                    </a>
                </li>
                
                <li class="sidebar-list__item">
                    <a href="setting.html" class="sidebar-list__link">
                        <span class="sidebar-list__icon">
                            <img src="{{ asset('assets-backend/images/icons/sidebar-icon10.svg') }}" alt="" class="icon">
                            <img src="{{ asset('assets-backend/images/icons/sidebar-icon-active10.svg') }}" alt="" class="icon icon-active">
                        </span>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li class="sidebar-list__item">
                    <!-- Ganti href dengan form logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="sidebar-list__link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="sidebar-list__icon">
                            <img src="{{ asset('assets-backend/images/icons/sidebar-icon13.svg') }}" alt="" class="icon">
                            <img src="{{ asset('assets-backend/images/icons/sidebar-icon-active13.svg') }}" alt="" class="icon icon-active">
                        </span>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
    </div>
</div>
<!-- Dashboard Nav End -->