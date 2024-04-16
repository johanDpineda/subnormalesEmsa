<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('dashboard')}}" class="app-brand-link">
            <img src="{{asset('assets/img/logo-emsa.png')}}" alt="" class="light-logo img-fluid" style="
            width: 100%;">
            <img src="{{asset('assets/img/logo-emsa.png')}}" alt="" class="dark-logo img-fluid" style="
            width: 100%;">
            <img src="{{ asset('assets/img/favicon/faviconlogo-emsa.png') }}" alt="" class="light-menu-hover" height="40px">
            <img src="{{ asset('assets/img/favicon/faviconlogo-emsa.png') }}" alt="" class="dark-menu-hover" height="40px">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class=""></div>
        <ul class="menu-inner py-1">
            <li class="menu-item {{Route::is('dashboard')?'active':''}}">
                <a href="{{route('dashboard')}}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div >{{__('Home')}}</div>
                </a>
            </li>

            @can('users.index')
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{__('Staff')}}</span>
                </li>
                <li class="menu-item {{Route::is('users.*')?'active':''}}">
                    <a href="{{route('users.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div >{{__('Users')}}</div>
                    </a>
                </li>


            @endcan

            @can('userscaminantes.index')
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{__('Walkers')}}</span>
                </li>
                <li class="menu-item {{Route::is('userscaminantes.*')?'active':''}}">
                    <a href="{{route('userscaminantes.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div >{{__('Users Caminante')}}</div>
                    </a>
                </li>
            @endcan

            @canany(['Caminantes.index'])
                <li class="menu-item open" style="">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-map-location-dot" ></i>
                        <div>{{__('walking data')}}</div>
                    </a>

                    <ul class="menu-sub">
                        @can('Caminantes.index')
                            <li class="menu-item {{Route::is('Caminantes.*')?'active':''}}">
                                <a href=" {{route('Caminantes.index')}}" class="menu-link">
                                    {{--                            <i class="menu-icon tf-icons ti ti-smart-home"></i>--}}
                                    <div>{{__('Caminantes')}}</div>
                                </a>
                            </li>
                        @endcan

                    </ul>


                </li>
            @endcanany

            @can('controlTerrenos.index')
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{__('Subnormal Data')}}</span>
                </li>
                <li class="menu-item {{Route::is('controlTerrenos.*')?'active':''}}">
                    <a href="{{route('controlTerrenos.index')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-location-dot"></i>

                        <div >{{__('Subnormal Land')}}</div>
                    </a>
                </li>
            @endcan


            @canany(['CrearSubNormal.index'])
                <li class="menu-item open" style="">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-solid fa-street-view"></i>
                        <div>{{__('Subnormal zone')}}</div>
                    </a>

                    <ul class="menu-sub">
                        @can('CrearSubNormal.index')
                            <li class="menu-item {{Route::is('CrearSubNormal.*')?'active':''}}">
                                <a href="{{route('CrearSubNormal.index')}}" class="menu-link">
                                    <i class="menu-icon fa-solid fa-street-view"></i>
                                    <div >{{__('Subnormal')}}</div>
                                </a>
                            </li>
                        @endcan
                    </ul>

                    <ul class="menu-sub">
                        @can('censofamilia.index')
                            <li class="menu-item {{Route::is('censofamilia.*')?'active':''}}">
                                <a href="{{route('censofamilia.index')}}" class="menu-link">
                                    <i class="menu-icon fa-solid fa-street-view"></i>
                                    <div >{{__('census')}}</div>
                                </a>
                            </li>
                        @endcan
                    </ul>


                </li>
            @endcanany




        </ul>
</aside>
