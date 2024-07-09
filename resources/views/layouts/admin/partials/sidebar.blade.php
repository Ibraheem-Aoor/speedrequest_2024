<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-colored">
    <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
        <div class="sidebar-brand">
            <a href="index.html">
                <i class="fa fa-cut me-3"></i>{{ config('app.name', 'FEMILUX') }}
                <span class="sidebar-colored d=none">
                    <img src="{{ getAppLogo('light') }}" height="24" alt="">
                </span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="">
                <a href="{{ route('admin.dashboard') }}"><i class="ti ti-home me-2"></i>{{ __('general.dashboard') }}</a>
            </li>
            <li class="">
                <a href="{{ route('admin.service.index') }}"><i class="ti ti-browser  me-2"></i>{{ __('general.services') }}</a>
            </li>
            <li class="">
                <a href="{{ route('admin.barber.index') }}"><i class="ti ti-user me-2"></i>{{ __('general.barbers') }}</a>
            </li>
            <li class="">
                <a href="{{ route('admin.booking.index') }}"><i class="ti ti-shopping-cart me-2"></i>{{ __('general.bookings') }}</a>
            </li>
            <li class="">
                <a href="{{ route('admin.contacts.index') }}"><i class="ti ti-mail-opened me-2"></i>{{ __('general.contacts') }}</a>
            </li>
            <li class="sidebar-dropdown">
                <a href="javascript:void(0)"><i class="ti ti-license me-2"></i>{{ __('general.pages') }}</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('admin.page.edit', ['slug' => 'home']) }}">{{ __('general.home') }}</a></li>
                        <li><a href="{{ route('admin.page.edit', ['slug' => 'about']) }}">{{ __('general.about') }}</a></li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-dropdown" id="test">
                <a href="javascript:void(0)"><i class="ti ti-license me-2"></i>{{ __('general.settings') }}</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('admin.work_hour.edit') }}">{{ __('general.working_hours') }}</a></li>
                        <li><a href="{{ route('admin.setting.edit') }}">{{ __('general.site_settings') }}</a></li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-dropdown d-none">
                <a href="javascript:void(0)"><i class="ti ti-license me-2"></i>{{ __('general.example') }}</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="comingsoon.html">{{ __('general.comingsoon') }}</a></li>
                        <li><a href="maintenance.html">{{ __('general.maintenance') }}</a></li>
                        <li><a href="error.html">{{ __('general.error') }}</a></li>
                        <li><a href="thankyou.html">{{ __('general.thankyou') }}</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper -->
