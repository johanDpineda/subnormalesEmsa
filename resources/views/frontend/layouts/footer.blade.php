<!--::::Pie de Pagina::::::-->

<div class="flex-grow-1 " style="background-color: #d0d0d0;">

    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box" >


                @if (isset($advertisements_three) && !empty($advertisements_three))


                        <div class="sponsors_footerpublicity carousel" style="height: 100% !important;" data-flickity='{ "freeScroll": true, "wrapAround": true,"autoPlay": true}'>
                            @foreach ( $advertisements_three as $advertisementhree )
                                <div class="carousel-cell">
                                    <figure class="logotorneoactual">
                                        <a href="{{ $advertisementhree->url }}"  target="_blank">
                                            <img src="{{asset('uploads/advertisements/'.$advertisementhree->image_path) }}" class="patrocinador1" >
                                        </a>
                                    </figure>
                                </div>
                            @endforeach
                        </div>

                @else
                <h2 style="color: #000000;font-weight: bold;">NO HAY LOGO</h2>
                @endif



            </div>
            <div class="box">
                <h2 style="color: black">SOBRE NOSOTROS</h2>
                <p style="color: rgba(0, 0, 0, 0.781)"><b>Somos la Mejor plataforma para el comercio de los emprendedores</b></p>
                {{-- <div class="divpoliticas">
                    <h4 class="titlepoliticas">POLITICAS</h4>
                    <li class="politicas">
                        <a href="{{ route('terminosycondiciones.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}">Términos y condiciones</a>
                    </li>
                    <li class="politicas">
                        <a href="{{ route('politicasdeprivacidad.view', ['league_slug' => $leagueSlug, 'tournament_slug' => $defaultTournament]) }}">Politicas de privacidad</a>
                    </li>


                </div> --}}

                <figure class="logopatrocinadoractual">

                    <a href="#">
                        <img src="{{asset('assets/img/fondoempresarenovado.png') }}" alt="Logo de SLee Dw" class="patrocinador2">
                    </a>
                   



                </figure>
            </div>
            <div class="box">
                <h2 class="siguenosredes" style="color: black">SIGUENOS</h2>


                <div class="red-social">

                    {{-- @forelse ($social_network_league->social_networks as $social_network)
                        <a href="{{ $social_network->pivot->url }}"  target="_blank">

                            <img src="{{asset('uploads/logoredsocial/'.$social_network->logo)}}" style="margin-bottom: 5px">
                        </a>
                    @empty
                        <p style="color: #e8e9e1;font-weight: bold;">No hay Redes Sociales</p>
                    @endforelse --}}



                </div>




            </div>
        </div>
        <div class="grupo-2">


            <small>Copyright&copy; 2024 <a class="enlace" href="*" target="_blank"> <b style="color: #002ee5;font-weight: bold;">EmprendeSite</b></a> - Todos los Derechos Reservados.</small>
        </div>
    </footer>


</div>
