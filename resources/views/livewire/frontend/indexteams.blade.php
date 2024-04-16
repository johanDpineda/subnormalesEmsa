<div>
    <div class="container-xl flex-grow-1 container-p-y ligaequiposd " style="min-height:100vh;">

        
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card" style="background-color: #edefef;">

                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-4 mt-2">

                            <img src="{{asset('assets/img/logo-emsa.png') }}" alt="Avatar" style="width: 25%;display: flex;justify-content: flex-start;align-items: center;border-radius: 127px;">

                        </div>

                        <h4 class="mb-1 pt-2 text-center" style="color: #020202;font-weight: 800;">Bienvenido a la Plataforma Emsa para SubNormales</h4>

                        <div class="text-center m-3">
    
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{route('dashboard')}}" class="btn btn-primary waves-effect waves-light w-50 btneternalsesion" type="button" >
                                        
                    
                                        <span style="margin-left: 4px;">
                                            {{__('Sign in')}}
                                    </span>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary waves-effect waves-light btneternalsesion" type="button"  >
                                       
                                        
                                        <span style="margin-left: 4px;">
                                            {{__('Sign in')}}
                                    </span>
                                    </a>
                                    {{--                        @if (Route::has('register'))--}}
                                    {{--                            <a href="{{ route('register') }}">{{__('Register')}}</a>--}}
                                    {{--                        @endif--}}
                                @endauth
                            @endif
        
                        </div>
                        
                    </div>

                  
    
                  
    
                </div>

            </div>

        </div>
 
    </div>
</div>
