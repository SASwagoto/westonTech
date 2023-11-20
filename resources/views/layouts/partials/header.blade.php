<div class="nav-header">
    <a href="{{route('dashboard')}}" class="">

        <div class="d-flex justify-content-center align-items-center mt-3">
            @if ($siteInfo->app_logo)
            <img src="{{asset('storage/site/'.$siteInfo->app_logo)}}" alt="Weston Tech" height="45">
            @else
            <img src="{{asset('assets')}}/images/logo.png" alt="Weston Tech" height="45">
            @endif
        </div>
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="22" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect width="4" height="4" rx="2" fill="#2A353A" />
                <rect y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="22" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect y="22" width="4" height="4" rx="2" fill="#2A353A" />
            </svg>
        </div>
    </div>
</div>
<!--**********************************
            Nav header end
        ***********************************-->

<!--**********************************
            Header start
        ***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="navbar-collapse justify-content-between collapse">
                <div class="header-left">
                    <div class="dashboard_bar">
                        @yield('header_title')
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
                            <i id="icon-light-1" class="fa-solid fa-sun"></i>
                            <i id="icon-dark-1" class="fa-solid fa-moon"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link bell dz-fullscreen" href="javascript:void(0);">
                            <i id="icon-full-1" class="fa-solid fa-expand"></i>
                            <i id="icon-minimize-1" class="fa-solid fa-compress"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown notification_dropdown">
                        @php
                            $currentLang = session('lang_code', 'en');
                        @endphp

                        @switch($currentLang)
                            @case('en')
                            <a class="nav-link me-0" href="{{route('langChange', 'bn')}}">Bn</a>
                                @break
                            @case('bn')
                            <a class="nav-link me-0" href="{{route('langChange', 'en')}}">En</a>
                                @break
                            @default    
                        @endswitch
                    </li>
                    <li class="nav-item">
                        <div class="dropdown header-profile2">
                            <a class="nav-link ms-0" href="javascript:void(0);" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="header-info2 d-flex align-items-center">
                                    <div class="d-flex align-items-center sidebar-info">

                                    </div>
                                    @if (Auth::user()->image)
                                    <img src="{{asset('storage/uploads/'. Auth::user()->image)}}" alt="">
                                    @else
                                    <img src="{{asset('assets')}}/images/avatar.jpg" alt="">
                                    @endif
                                    
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pb-0" style="">
                                <div class="card mb-0">
                                    <div class="card-header p-3">
                                        <ul class="d-flex align-items-center">
                                            <li>
                                                @if (Auth::user()->image)
                                                <img src="{{asset('storage/uploads/'. Auth::user()->image)}}" alt="">
                                                @else
                                                <img src="{{asset('assets')}}/images/avatar.jpg" alt="">
                                                @endif
                                            </li>
                                            <li class="ms-2">
                                                <h4 class="mb-0">{{Auth::user()->name}}</h4>
                                                
                                                @if(Auth::user()->roles->isNotEmpty())
                                                    <span>{{ Auth::user()->roles[0]->name }}</span>
                                                @else
                                                    <span>--</span>
                                                @endif
                                               
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="card-body p-3">
                                        <a href="{{route('profile.edit')}}" class="dropdown-item ai-icon">
                                            <i class="fa-solid fa-user"></i>
                                            <span class="ms-2">Profile </span>
                                        </a>
                                        <a href="{{route('settings.index')}}" class="dropdown-item ai-icon">
                                            <i class="fa-solid fa-gear"></i>
                                            <span class="ms-2">Settings </span>
                                        </a>

                                    </div>
                                    <div class="card-footer p-3 text-center">
                                        <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit();" class="dropdown-item ai-icon btn btn-primary light">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            <span class="text-primary ms-2">Logout </span>
                                        </a>
                                        <form action="{{route('logout')}}" id="logout" method="post">
                                        @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
