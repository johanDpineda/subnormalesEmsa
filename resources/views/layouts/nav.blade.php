<!-- Navbar -->

<style>

    .textroles{
        padding-top: 16px;
        font-size: 15px;
        display: contents;
    }

    .moviltext{
        display: none;

    }

    @media (max-width: 767px){

    .textroles{
        display: none;
    }


    .moviltext {
        padding-top: 22px !important;
        font-size: 13px !important;
        display: block;
    }

}
</style>

<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar"
>
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="  ">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                {{--                                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="  ">--}}
                {{--                                    <i class="ti ti-search ti-md me-2"></i>--}}
                {{--                                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>--}}
                {{--                                </a>--}}
            </div>
        </div>
        <!-- /Search -->





            @foreach(Auth::user()->roles as $role)
                <h5 class="align-items-center textroles">Bienvenido ,{{ Auth::user()->name }} <h5 class="text-muted textroles"> (  {{ $role->name }} )</h5> </h5>


                <h5 class="align-items-center moviltext ">Bienvenido ,<h5 class="text-muted moviltext" > (  {{ $role->name }} )</h5> </h5>
            @endforeach





        <ul class="navbar-nav flex-row align-items-center ms-auto">
           {{--
                s@if(Auth::user()->getRoleNames()->first() == 'User Store')
                s@if(Auth::user()->SubNormales!=null)
                    <li class="nav-item me-2 me-xl-0">
                        <a class="btn btn-primary"  href="{{route('store.view',Auth::user()->SubNormales->slug)}}" target="_blank">
                            <i class="ti ti-external-link"></i>
                        </a>
                    </li>
                s@endif
            s@endif
            --}}
            <!-- Language -->

            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="  " data-bs-toggle="dropdown">
                    @if(str_replace('_', '-', app()->getLocale())=='es')
                        <i class="fi fi-co fis rounded-circle me-1 fs-3"></i>
                    @else
                        <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                    @endif

                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{route('set_language', ['es'])}}">
                            <i class="fi fi-co fis rounded-circle me-1 fs-3"></i>
                            <span class="align-middle">{{ __("Spanish") }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('set_language', ['en'])}}">
                            <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                            <span class="align-middle">{{ __("English") }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Language -->

             <!-- Notification -->
             <div>
                @livewire('wordkin.notifications')
             </div>

              <!--/ Notification -->




           <!-- Style Switcher -->
            <li class="nav-item me-2 me-xl-0">
                <a class="nav-link style-switcher-toggle hide-arrow"  href="">
                    <i class="ti ti-md"></i>
                </a>
            </li>
            <!--/ Style Switcher -->
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
                    @if(Auth::user()->image!=null)
                    <div class="avatar avatar-online">
                            <img src="{{asset('uploads/users/'.Auth::user()->image)}}" alt class="h-auto rounded-circle" />
                    </div>
                    @else
                    <div class="avatar avatar-online">
                        <span class="avatar-initial rounded-circle bg-label-primary">{{Auth::user()->name[0]}}</span>
                    </div>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    @if(Auth::user()->image!=null)
                                        <div class="avatar avatar-online">
                                            <img src="{{asset('uploads/users/'.Auth::user()->image)}}" alt class="h-auto rounded-circle" />
                                        </div>
                                    @else
                                        <div class="avatar avatar-online">
                                            <span class="avatar-initial rounded-circle bg-label-primary">{{Auth::user()->name[0]}}</span>

                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    @foreach(Auth::user()->roles as $role)
                                        <small class="text-muted">{{ $role->name }}</small>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle">{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>

<!-- / Navbar -->
