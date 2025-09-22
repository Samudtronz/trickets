<!-- ===================== Dashboard Sidebar Start ======================= -->
<div class="dashboard-sidebar">
    <button type="button" class="dashboard-sidebar__close d-lg-none d-flex"><i class="las la-times"></i></button>
    <div class="dashboard-sidebar__inner">
        <a href="#" class="logo mb-48">
            <img src="{{ asset('assets-backend/images/logo/logo-trickets.png') }}" alt="">
        </a>

        <!-- Sidebar List Start -->
        <ul class="sidebar-list">
            <li class="sidebar-list__item">
                <a href="{{ route('backend.edit') }}" class="sidebar-list__link">
                    <span class="sidebar-list__icon">
                        <img src="{{ asset('assets-backend/images/icons/sidebar-icon1.svg') }}" alt="" class="icon">
                        <img src="{{ asset('assets-backend/images/icons/sidebar-icon-active1.svg') }}" alt="" class="icon icon-active">
                    </span>
                    <span class="text">Edit</span>
                </a>
            </li>

        </ul>
        <!-- Sidebar List End -->        
    </div>
</div>
<!-- ===================== Dashboard Sidebar End ======================= -->
