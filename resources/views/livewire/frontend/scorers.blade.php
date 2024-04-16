<div class="container-fluid flex-grow-1  h-100">
    <div class="listagoleadores ">
        <h5 class="textogoleadores text-center">Goleadores <span class="text-primary">{{$tournament->name}}</span></h5>
        <div class="tabladegoleadores">
            <div class="tabladescorer">
                <section  class="table  table_body">
                    <div class="container">
                        <div class="row my-3">
                            <div class="col-md-12 text-sm-start">
                                <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                            </div>
                            {{--  <div class="col-md-4 text-end d-flex align-items-end">
                                <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                            </div>  --}}
                            <div class="col-6 col-md-4 select-scorers">
                                <label for="player_id">Jugador:</label>
                                <select id="player_id" wire:model="player_id" name="player_id"
                                        class="select2 form-select single-select"
                                        data-placeholder="{{__('Select')}}...">
                                    <option value=""></option>
                                    @foreach($players as $player)
                                        <option value="{{$player->id}}">{{$player->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 col-md-4 select-scorers">
                                <label for="team_id">Equipo:</label>
                                <select id="team_id" wire:model="team_id" name="team_id"
                                        class="select2 form-select single-select"
                                        data-placeholder="{{__('Select')}}...">
                                    <option value=""></option>
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <table class="tablagolesliga table_body table-striped table-hover">
                        <thead>
                        <tr class="barrainfoligagoles">
                            <th scope="col" class="posiciongoleadores">
                                <p class="estilobarrainfo"></p>
                            </th>
                            <th scope="col" class="clasegeneralgoles">
                                <p class="estilobarrainfo"></p>
                            </th>
                            <th scope="col" class="clasegeneralgoles">
                                <p class="estilobarrainfo">JUGADOR</p>
                            </th>
                            <th scope="col" class="clasegeneralgoles">
                                <p class="estilobarrainforf">EQUIPO</p>
                            </th>
                            <th scope="col" class="posiciongoleadores">
                                <p class="estilobarrainfo">GOLES</p>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse ($scorers as $key => $scorer)

                            @php
                                $nombres = explode(' ', $scorer->player->first_name);
                                $primerNombrelegue = $nombres[0];
                                $apellidos= explode(' ', $scorer->player->last_name);
                                $primerapellidolegue = $apellidos[0];
                            @endphp

                            <tr>
                                <td class="posiciongoleador">
                                    <p class="numbergoleador">
                                        {{ $scorer->position }}
                                    </p>
                                </td>

                                <td class="fotogoleador">
                                    <a>
                                        <div class="avatarjugador" type="button" class="btn btn-primary  boton-transparente" data-bs-toggle="modal" data-bs-target="#animationModalpos{{ $scorer->player_id }}">
                                            <div class="fotojugadorgoleadores">
                                                @if( $scorer->player->profile_photo!=null)
                                                    <div class="lazyload-wrapper " >
                                                        <img
                                                            src="{{asset('uploads/players/'.$scorer->player->profile_photo) }}"
                                                            class="fotjugador">
                                                    </div>
                                                @else
                                                    <div class="lazyload-wrapper ">
                                                        <img src="{{asset('assets/img/favicon/jugador-de-futbol2.png') }}"
                                                             class="sinfotjugador">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </td>

                                <td class="namegoleador">

                                    <a>

                                        @php
                                            $nombres = explode(' ', $scorer->player->first_name);
                                            $primerNombre = $nombres[0];
                                            $apellidos= explode(' ',  $scorer->player->last_name);
                                            $primerapellido = $apellidos[0];
                                        @endphp

                                        <p class="jugadorname tipoletratablagoles" type="button" class="btn btn-primary  boton-transparente" data-bs-toggle="modal" data-bs-target="#animationModalpos{{ $scorer->player_id }}">{{$primerNombre}} {{$primerapellido}}</p>

                                        {{--  @if( $scorer->player->player_name!=null)

                                            <div style="display:flex;align-items:center;gap:6px">
                                                <a href="{{ route('PerfilJugador.view', ['league_slug' => $league->slug, 'tournament_slug' => $tournament->slug,'player_slug'=>$scorer->player->slug]) }}">
                                                    <p class="jugadorname tipoletratablagoles">{{ $scorer->player->player_name }}</p>
                                                </a>
                                            </div>
                                        @else
                                            <div style="display:flex;align-items:center;gap:6px">
                                                <p class="jugadorname">Sin Nombre</p>
                                            </div>
                                        @endif  --}}


                                    </a>
                                </td>

                                <td class="contengeneral teamequipogeneral">
                                    <a href="">
                                        <div class="infoequipo tamanoletraequipo">

                                            @if($scorer->game_team->logo!=null)
                                                <i class="fotoequipo">
                                                    <img
                                                        src="{{asset('uploads/teams/'.$scorer->game_team->logo) }}"
                                                        class="torneofotoclub">
                                                </i>
                                            @else
                                                @php
                                                    $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                                                    $imagenAleatoria = collect($imagenes)->random();
                                                @endphp
                                                <i class="fotoequipo">
                                                    @if ($imagenAleatoria)
                                                        <img src="{{ asset('uploads/logoteams/' . $imagenAleatoria->getFilename()) }}" alt="Descripción de la imagen" class="torneofotoclub">
                                                    @else
                                                        <p>No se encontraron imágenes.</p>
                                                    @endif
                                                    {{--  <img src="{{asset('assets/img/favicon/favicon.png') }}" class="torneofotoclub">  --}}
                                                </i>
                                            @endif


                                            <div class="shield-mobile modocel textcenter">


                                                @if($scorer->game_team->name)
                                                    <a href="{{ route('teams.show', ['league_slug' => $league->slug, 'tournament_slug' => $tournament->slug,'team_slug'=>$scorer->game_team->slug]) }}" style="margin-left: 8px;width: 90px;">
                                                        <p class="clubnombre">{{ Str::limit($scorer->game_team->name, 11) }}</p>
                                                    </a>
                                                @else
                                                    <p class="clubnombre"> Sin nombre</p>
                                                @endif

                                            </div>

                                            <div class="shield-desktop modocel">

                                                @if($scorer->game_team->name)
                                                    <a href="{{ route('teams.show', ['league_slug' => $league->slug, 'tournament_slug' => $tournament->slug,'team_slug'=>$scorer->game_team->slug]) }}" style="margin-left: 8px;">
                                                        <p class="clubnombre tipoletratablagoles"> {{$scorer->game_team->name}} </p>
                                                    </a>

                                                @else
                                                    <p class="clubnombre"> Sin nombre</p>
                                                @endif


                                            </div>

                                        </div>
                                    </a>


                                </td>

                                <td class="contengeneral">
                                    <p class="totalgoles" style="
                                            font-size: 1rem;
                                            color: white;"> {{ $scorer->total_goals }}</p>
                                </td>
                            </tr>
                            @include('frontend.modalperfiljugadorscorers.index')
                        @empty
                            <tr class="odd">
                                <td valign="top" colspan="12" class="dataTables_empty text-center">No hay goleadores</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    @if($scorers->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5 text-sm-start" style="text-align: center">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $scorers->firstItem() }} {{__('to')}} {{ $scorers->lastItem() }} {{__('of')}} {{ $scorers->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                                @if ($scorers->hasPages())
                                    {{$scorers->links('vendor.livewire.bootstrap')}}
                                @endif
                            </div>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
    <script>
        $(function () {
            window.initScorersShow=()=>{
                // Select2
                $('.select-scorers .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    allowClear: Boolean($(this).data('allow-clear')),
                    dropdownParent: $('.select-scorers')
                });
            }
            $('.select-scorers .single-select').on('change', function (e) {
                livewire.emit('ScorersShowChange', $(this).val(), $(this).attr('wire:model'))
            });
            window.livewire.on('ScorersShowHydrate',()=>{
                initScorersShow();
            });

            livewire.emit('ScorersShowChange', '', '');
        });
    </script>
</div>
