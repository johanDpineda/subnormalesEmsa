
<nav class="navbar navbar-expand-lg bg-navbar-theme site-header">
    <div class="container-fluid" >
            <a href="{{ route('store.view', ['store_slug' => $storeSlug]) }}" class="navbar-brand">
                @if($store->image!=null)
                    <img src="{{asset('uploads/store/'.$store->image) }}" class="dark-logo img-fluid navbar-image" style="height: 100px">
                @else
                    {{$store->name}}
                @endif
            </a>

            <button class="navbar-toggler btnantiguo" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-5">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <button class=" waves-effect waves-light btnoffcanvasmi" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStart" aria-controls="offcanvasStart" style="font-family: Abel; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; padding: 10px 20px; font-size: 15px; background-color: transparent; border: none;">
                <span class="navbar-toggler-icon" style="margin-left: -7px;margin-top: -13px;"></span>
            </button>
        
            <div class="offcanvas offcanvas-start offcanvasmenumi " tabindex="-1" id="offcanvasStart" aria-labelledby="offcanvasStartLabel" style="max-width: 70% !important;background-color: #0000006e !important;">
                <div class="offcanvas-header contenedorbtnmenu">
        
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                    <div class="me-auto selectnav" >
                        <ul class="navbar-nav" id="barra-navegacion">
                            <li class="nav-item limenu {{Route::is('store.*')?'active':''}}" >
                                <a class="nav-link " href="{{ route('store.view', ['store_slug' => $storeSlug]) }}" style="font-family: Abel;font-size: 20px;text-align: center;">{{__('Home')}}</a>
                            </li>

                            <li class="nav-item menus limenu {{Route::is('noticias.*')?'active':''}}">
                                <a class="nav-link " href="{{ route('noticias.view', ['store_slug' => $storeSlug]) }}" style="font-family: Abel;font-size: 20px;text-align: center;">{{__('News')}} </a>
                            </li>
                           
                            {{-- @if($defaultTournament)
                                <li class="nav-item limenu  menus {{Route::is('teams.*')?'active':''}}">
                                    <a class="nav-link" href="{{ route('teams.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 20px;text-align: center;">{{__('Teams')}}</a>
                                </li>
        
                                <li class="nav-item limenu menus {{Route::is('programacion.*')?'active':''}}">
                                    <a class="nav-link " href="{{ route('programacion.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}"  style="font-family: Abel;font-size: 20px;text-align: center;">{{__('Programación')}}</a>
                                </li>
        
                                <li class="nav-item limenu menus {{Route::is('resultados.*')?'active':''}}">
                                    <a class="nav-link " href="{{ route('resultados.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 20px;text-align: center;">{{__('Resultados')}} </a>
                                </li>
        
                                <li class="nav-item menus {{Route::is('points.table.*')?'active':''}} ">
                                    <a class="nav-link " style="color: white; font-family: Abel;font-size:20px;text-align: center;" href="{{ route('points.table.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" >{{__('Points table')}}</a>
                                </li>
        
                                <li class="nav-item limenu dropdown" >
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-family: Abel;font-size: 20px;text-align: center;">
                                        {{__('Estadísticas')}}
                                    </a>
        
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        
                                        <li class="nav-item menus {{Route::is('TablaGoleadores.*')?'active':''}} ">
                                            <a class="nav-link " style="color: white; font-family: Abel;font-size: 20px;text-align: center;" href="{{ route('TablaGoleadores.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" >{{__('Goleadores')}}</a>
                                        </li>
                                        <li class="nav-item menus {{Route::is('tablavallamenosvencida.*')?'active':''}} ">
                                            <a class="nav-link " style="color: white; font-family: Abel;font-size: 20px;text-align: center;" href="{{ route('tablavallamenosvencida.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" >{{__('Valla Menos Vencida')}}</a>
                                        </li>
                                    </ul>
                                </li>
        
                                <li class="nav-item menus limenu {{Route::is('noticias.*')?'active':''}}">
                                    <a class="nav-link " href="{{ route('noticias.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 20px;text-align: center;">{{__('News')}} </a>
                                </li>
                                
                                <li class="nav-item menus limenu {{Route::is('resoluciones.*')?'active':''}}">
                                    <a class="nav-link " href="{{ route('resoluciones.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 20px;text-align: center;">{{__('Resoluciones')}} </a>
                                </li>
        
        
                                <li class="nav-item menus limenu {{Route::is('redsocial.*')?'active':''}}">
                                    <a class="nav-link " href="{{ route('redsocial.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 20px;text-align: center;">
                                    {{__('Social network')}} 
                                    </a>
                                
                                </li>
        
        
        
                            @endif --}}
                        </ul>
                    </div>
                    <ul class="navbar-nav ms-lg-auto d-flex align-items-center imgappmifutbol" >
                        <li class="nav-item me-2 me-xl-0">
                            <a class="nav-link style-switcher-toggle hide-arrow"  href="">
                                <i class="ti ti-md"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="containerdsd">
                                <div class="columnmovilapp">
                                    <a href="https://mi.futbol/">
                                        <img src="{{asset('assets/img/logo_mi_futbol.png')}}" class="dark-logo img-fluid" style="height: 40px">
                                    </a>
        
                                </div>
        
                                <div class="columnmovilapp">
                                    <a href="https://play.google.com/store/apps/details?id=mi.futbol.app">
                                        <img src="{{asset('assets/img/web/descargapp.webp')}}" class="dark-logo img-fluid" style="height: 40px">
                                    </a>
        
                                </div>
        
                            </div>
        
                            {{--  @if (Route::has('login'))
                                    @auth
                                        <a href="{{route('dashboard')}}" class="btn btn-primary waves-effect waves-light d-flex justify-content-around align-items-center" type="button" target="_blank"><i class="ti ti-dashboard"></i><p class="mb-0">{{__('Control Panel')}}</p></a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary waves-effect waves-light" type="button">{{__('Login')}}</a>
                                    @endauth
                            @endif  --}}
                        </li>
                    </ul>
                </div>
            </div>
        
        
            {{--  <div class="btn-menu">
                <label for="btn-menu">☰</label>
            </div>  --}}
        
        
            {{--  <input type="checkbox" id="btn-menu">  --}}
        
        
        
        
        
            
            <div class="collapse navbar-collapse menuocultomovil" id="navbar-ex-5" style="max-width: 100% !important;">
        
                <div class="me-auto selectnav" >
                    <ul class="navbar-nav" id="barra-navegacion">
                        <li class="nav-item limenu {{Route::is('store.*')?'active':''}}" >
                            <a class="nav-link " href="{{route('store.view', ['store_slug' => $storeSlug]) }}" style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('Home')}}</a>
                        </li>
                        
                       
                            <li class="nav-item limenu  menus {{Route::is('pedidos.*')?'active':''}}">
                                {{-- <a class="nav-link" href="{{ route('teams.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('Teams')}}</a> --}}
                                <a class="nav-link" href="{{ route('pedidos.view', ['store_slug' => $storeSlug]) }}" style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('Products')}}</a> 
                                
                            </li>

                            <li class="nav-item menus limenu {{Route::is('noticias.*')?'active':''}}">
                                <a class="nav-link " href="{{ route('noticias.view',  ['store_slug' => $storeSlug]) }}" style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('News')}} </a>
                            </li>
                           
        
                            {{-- <li class="nav-item limenu menus {{Route::is('programacion.*')?'active':''}}">
                                <a class="nav-link " href="{{ route('programacion.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}"  style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('Programación')}}</a>
                            </li>
                            <li class="nav-item limenu menus {{Route::is('resultados.*')?'active':''}}">
                                <a class="nav-link " href="{{ route('resultados.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('Resultados')}} </a>
                            </li>
                            <li class="nav-item menus {{Route::is('points.table.*')?'active':''}} ">
                                <a class="nav-link " style="color: white; font-family: Abel;font-size: 16.8px;text-align: center;" href="{{ route('points.table.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" >{{__('Points table')}}</a>
                            </li>
                            <li class="nav-item limenu dropdown" >
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-family: Abel;font-size: 16.8px;text-align: center;">
                                    {{__('Estadísticas')}}
                                </a>
        
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        
                                    <li class="nav-item menus {{Route::is('TablaGoleadores.*')?'active':''}} ">
                                        <a class="nav-link " style="color: white; font-family: Abel;font-size: 16.8px;text-align: center;" href="{{ route('TablaGoleadores.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" >{{__('Goleadores')}}</a>
                                    </li>
                                    <li class="nav-item menus {{Route::is('tablavallamenosvencida.*')?'active':''}} ">
                                        <a class="nav-link " style="color: white; font-family: Abel;font-size: 16.8px;text-align: center;" href="{{ route('tablavallamenosvencida.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" >{{__('Valla Menos Vencida')}}</a>
                                    </li>
                                </ul>
                            </li>
        
                            <li class="nav-item menus limenu {{Route::is('noticias.*')?'active':''}}">
                                <a class="nav-link " href="{{ route('noticias.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('News')}} </a>
                            </li>
                            <li class="nav-item menus limenu {{Route::is('resoluciones.*')?'active':''}}">
                                <a class="nav-link " href="{{ route('resoluciones.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}" style="font-family: Abel;font-size: 16.8px;text-align: center;">{{__('Resoluciones')}} </a>
                            </li>
        
        
                            <li class="nav-item menus limenu {{Route::is('redsocial.*')?'active':''}}">
                                <a class="nav-link " href="{{ route('redsocial.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}"  style="font-family: Abel;font-size: 16.8px;text-align: center;">
                                    {{__('Social network')}}
                                    
                                </a>
                            
                            
                            </li> --}}
        
        
                      
                    </ul>
                </div>
                <ul class="navbar-nav ms-lg-auto d-flex align-items-center imgappmifutbol" >
                    <li class="nav-item me-2 me-xl-0">
                        <a class="nav-link style-switcher-toggle hide-arrow"  href="">
                            <i class="ti ti-md"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="*" target="_blank">
                            <img src="{{asset('assets/img/LogoEmprendesitesfondo.png')}}" class="dark-logo img-fluid" style="height: 150px">
                        </a>
        
        
                       
        
        
        
        
                        {{--  @if (Route::has('login'))
                                @auth
                                    <a href="{{route('dashboard')}}" class="btn btn-primary waves-effect waves-light d-flex justify-content-around align-items-center" type="button" target="_blank"><i class="ti ti-dashboard"></i><p class="mb-0">{{__('Control Panel')}}</p></a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary waves-effect waves-light" type="button">{{__('Login')}}</a>
                                @endauth
                        @endif  --}}
                    </li>
                </ul>
            </div>
            
    </div>

    
</nav>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $(".site-header").addClass("barrafija");



        } else {
            $(".site-header").removeClass("barrafija");

        }

    });
</script>


<script>
    document.addEventListener('click', function(event) {
        const containerMenu = document.querySelector('.container-menu');
        const btnMenu = document.getElementById('btn-menu');

        if (containerMenu.contains(event.target) || btnMenu.contains(event.target)) {
            // Hacer algo si se hace clic dentro del menú o en el botón de menú
        } else {
            // Cerrar el menú si se hace clic fuera de él
            btnMenu.checked = false;
        }
    });
</script>



