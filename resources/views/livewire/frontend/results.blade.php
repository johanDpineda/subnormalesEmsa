<div>
    <div class="tablapartidosclub">
        <div class="contenedorpartidos">
            <div class="tablatotalpartidos">
                <div class="contenpatidostotal">
                    <section  class="table table_body">
                        <div class="container">
                            <div class="row py-3">
                                <div class="col-md-12 text-sm-start">
                                    <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="date">{{__('Date')}}:</label>
                                    <input type="date" id="date" name="date" placeholder="{{__('Search')}}.." wire:model="date" class="form-control">
                                </div>
                                <div class="col-6 col-md-3 select-result">
                                    <label for="group_id">Grupos:</label>
                                    <select id="group_id" wire:model="group_id" name="group_id"
                                            class="select2 form-select single-select"
                                            data-placeholder="{{__('Select')}}...">
                                        <option value=""></option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-3 select-result">
                                    <label for="team_id">Equipos:</label>
                                    <select id="team_id" wire:model="team_id" name="team_id"
                                            class="select2 form-select single-select"
                                            data-placeholder="{{__('Select')}}...">
                                        <option value=""></option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-3 select-result">
                                    <label for="session_id">Fase:</label>
                                    <select id="session_id" wire:model="session_id" name="session_id"
                                            class="select2 form-select single-select"
                                            data-placeholder="{{__('Select')}}...">
                                        <option value=""></option>
                                        @foreach($sessions as $session)
                                            <option value="{{$session->id}}">{{$session->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <table class="partidosclubes table_body table-striped table-hover ">
                            <thead>
                            <tr class="barraopcionespartidos">
                                <th class="descriptablapartidos">

                                    <span class="label">FECHA</span>
                                </th>

                                <th class="descriptablapartidos">

                                    <span class="label">HORA</span>
                                </th>

                                <th class="descriptablapartidos">

                                    <span class="label">PARTIDO</span>
                                </th>

                                <th class="descriptablapartidos">

                                    <span class="label">ARBITRO</span>
                                </th>


                                <th class="descriptablapartidos">

                                    <span class="label">TRANSMISIÓN</span>
                                </th>
                                <th class="descriptablapartidos">
                                    <span class="label">ESTADO</span>
                                </th>
                                <th class="descriptablapartidos">
                                    <span class="label">VER PARTIDO</span>
                                </th>

                            </tr>

                            </thead>


                            <tbody>

                            @forelse ($matches as $match)
                                <tr class="descripcionesspartido">


                                    <td class="descrip1 tablepartidoo">
                                        <p class="fechapartido">{{ $match->date }}</p>
                                    </td>

                                    <td class="descrip2 tablepartidoo1">
                                        <p class="horapartido">{{ $match->hour }}</p>
                                        <i data-tip="Hora central Europea (CET)"
                                           class="varhora font-ligadago"></i>
                                    </td>

                                    <td class="descrip3 tablepartidoo2">
                                        <div class="partidosoficiales">
                                            <div class="clubespartidos">
                                                <a href="">
                                                    <div class="cluboficiales">
                                                        @if($match->team_one->logo!=null)

                                                            <img
                                                                src="{{asset('uploads/teams/'.$match->team_one->logo) }}"
                                                                class="iconclubesliga size-xs">
                                                            <div class="textoequipo1">
                                                                <p class="nameclub">{{ Str::limit($match->team_one->name, 15) }}</p>
                                                            </div>

                                                        @else

                                                            @php
                                                                $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                                                                $imagenAleatoria = collect($imagenes)->random();
                                                            @endphp

                                                            @if ($imagenAleatoria)
                                                                <img src="{{ asset('uploads/logoteams/' . $imagenAleatoria->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesliga size-xs">
                                                                <div class="textoequipo1">
                                                                    <p class="nameclub">{{ Str::limit($match->team_one->name, 15) }}</p>
                                                                </div>
                                                            @else
                                                                <p>No se encontraron imágenes.</p>
                                                            @endif

                                                            {{--  <img
                                                                src="{{asset('assets/img/favicon/favicon.png') }}"
                                                                class="iconclubesliga size-xs">
                                                            <div class="textoequipo1">
                                                                <p class="nameclub">{{$match->team_one->name}}</p>
                                                            </div>  --}}

                                                        @endif


                                                    </div>
                                                </a>
                                            </div>

                                            <div class="clubespartidosgf">

                                                <div class="live">

                                                    <p class="marcadores">{{$match->results->team_one_score}}</p>
                                                    <p class="marcadores">-</p>
                                                    <p class="marcadores">{{$match->results->team_two_score}}</p>

                                                    {{--  @if($match->results!=null)
                                                        @if($match->results->team_one_score)

                                                            <p class="marcadores">{{$match->results->team_one_score}}</p>
                                                            <p class="marcadores">-</p>
                                                            <p class="marcadores">{{$match->results->team_two_score}}</p>

                                                        @else
                                                            <p class="marcadores">Vs</p>
                                                        @endif

                                                    @else

                                                        <p class="marcadores">Vs</p>
                                                    @endif  --}}


                                                </div>
                                            </div>

                                            <div class="clubespartidos">
                                                <a href="">
                                                    <div class="cluboficialesop2">

                                                        @if($match->team_two->logo!=null)

                                                            <img
                                                                src="{{asset('uploads/teams/'.$match->team_two->logo) }}"
                                                                class="iconclubesliga size-xs">
                                                            <div class="textoequipo2">
                                                                <p class="nameclub">{{ Str::limit($match->team_two->name, 15) }}</p>
                                                            </div>

                                                        @else

                                                            @php
                                                                $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                                                                $imagenAleatoriateamtworesult = collect($imagenes)->random();
                                                            @endphp

                                                            @if ($imagenAleatoriateamtworesult)
                                                                <img src="{{ asset('uploads/logoteams/' . $imagenAleatoriateamtworesult->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesliga size-xs">
                                                                <div class="textoequipo2">
                                                                    <p class="nameclub"> {{ Str::limit($match->team_two->name, 15) }}</p>
                                                                </div>
                                                            @else
                                                                <p>No se encontraron imágenes.</p>
                                                            @endif

                                                            {{--  <img
                                                                src="{{asset('assets/img/favicon/favicon.png') }}"
                                                                class="iconclubesliga size-xs">
                                                            <div class="textoequipo2">
                                                                <p class="nameclub">{{$match->team_two->name}}</p>
                                                            </div>  --}}

                                                        @endif


                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </td>

                                    @php
                                        $nombres = explode(' ', $match->arbitrator->name);
                                        $primerNombre = $nombres[0];
                                        $apellidos= explode(' ', $match->arbitrator->lastname);
                                        $primerapellido = $apellidos[0];
                                    @endphp

                                    <td class="competicionliga">
                                        <p class="titulocompeticion">
                                            {{$primerNombre}} {{$primerapellido}}
                                        </p>
                                    </td>

                                    <td class="verpartido">
                                        @if($league->image!=null)

                                            <p class="tituloverpartido">
                                                -
                                            </p>

                                        @else

                                            <p class="tituloverpartido">
                                                Sin transmisión
                                            </p>

                                        @endif

                                    </td>

                                    <td class="competicionligacancha">
                                        <p class="titulocompeticion">
                                            {{$match->status->name}}
                                        </p>
                                    </td>

                                    <td class="resumenpartido partidoresumen">
                                        <a href="{{ route('resumenpartido.view', ['league_slug' => $league->slug, 'tournament_slug' => $tournament->slug, 'id_partidoresumen' => $match->id]) }}">
                                            <i class=" estadisttticas font-ligadago "><img
                                                    src="{{asset('assets/img/flecha.png') }}"
                                                    class="iconpartidoclubes"></i>
                                        </a>
                                    </td>





                                </tr>
                            @empty
                                <tr class="odd">
                                    <td valign="top" colspan="12" class="dataTables_empty text-center">No hay resultados</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>





                        @forelse($matches as $match )


                            <div class="containerProgramado czlpZsmovil">

                                <div class="contenedor-partido">
                                    <div class="info-partido" style="display: grid;">
                                        <span class="titulomovilprogramado">Fecha</span>
                                        <span class="texntomovilprogramado"> {{ $match->date }}</span>
                                    </div>


                                    <div class="info-partido" style="border-left: 1px solid white;display: grid;">
                                        <span class="titulomovilprogramado">Hora</span>
                                        <span class="texntomovilprogramado">{{ $match->hour }}</span>
                                    </div>

                                </div>

                                <div class="contenedor-equipos">

                                    <div class="clubespartidosmovil">
                                        <a href="">
                                                @if($match->team_one->logo!=null)

                                                    <img src="{{asset('uploads/teams/'.$match->team_one->logo) }}" class="iconclubesligamovil size-xs">

                                                    <div class="textoequipo1movil">
                                                        <p class="nameclubmovil">{{ Str::limit($match->team_one->name, 15) }}</p>
                                                    </div>

                                                @else

                                                    @php
                                                        $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                                                        $imagenAleatoriaresult = collect($imagenes)->random();
                                                    @endphp

                                                    @if ($imagenAleatoriaresult)
                                                        <img src="{{ asset('uploads/logoteams/' . $imagenAleatoriaresult->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesligamovil size-xs">
                                                        <div class="textoequipo1movil">
                                                            <p class="nameclubmovil"> {{ Str::limit($match->team_one->name, 15) }}</p>
                                                        </div>
                                                    @else
                                                        <img src="{{asset('assets/img/favicon/favicon.png') }}" class="iconclubesligamovil size-xs">
                                                        <div class="textoequipo1movil">
                                                            <p class="nameclubmovil">{{ Str::limit($match->team_one->name, 15) }}</p>
                                                        </div>
                                                    @endif

                                                    {{--  <img src="{{asset('assets/img/favicon/favicon.png') }}" class="iconclubesligamovil size-xs">
                                                    <div class="textoequipo1movil">
                                                        <p class="nameclubmovil">{{$match->team_one->name}}</p>
                                                    </div>  --}}

                                                @endif

                                        </a>
                                    </div>

                                    <div class="VSresultado">

                                        <p class="marcadores">{{$match->results->team_one_score}}</p>
                                                    <p class="marcadores">-</p>
                                                    <p class="marcadores">{{$match->results->team_two_score}}</p>


                                        {{--  @if($match->results!=null)
                                            @if($match->results->team_one_score!=null)

                                            <div class="live">

                                                    <p class="marcadores">{{$match->results->team_one_score}}</p>
                                                    <p class="marcadores">-</p>
                                                    <p class="marcadores">{{$match->results->team_two_score}}</p>

                                            </div>
                                            @else
                                            <p class="marcadores">Vs</p>
                                        @endif

                                        @else

                                            <p class="marcadores">Vs</p>
                                        @endif  --}}



                                    </div>

                                    <div class="clubespartidosmovil">
                                        <a href="">


                                                @if($match->team_two->logo!=null)

                                                    <img
                                                        src="{{asset('uploads/teams/'.$match->team_two->logo) }}"
                                                        class="iconclubesligamovil size-xs">
                                                    <div class="textoequipo2movil">
                                                        <p class="nameclubmovil">{{ Str::limit($match->team_two->name, 15) }}</p>
                                                    </div>

                                                @else

                                                    @php
                                                        $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                                                        $imagenAleatoriaresultve = collect($imagenes)->random();
                                                    @endphp

                                                    @if ($imagenAleatoriaresultve)
                                                        <img src="{{ asset('uploads/logoteams/' . $imagenAleatoriaresultve->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesligamovil size-xs">
                                                        <div class="textoequipo2movil">
                                                            <p class="nameclubmovil"> {{ Str::limit($match->team_two->name, 15) }}</p>
                                                        </div>
                                                    @else
                                                        <img src="{{asset('assets/img/favicon/favicon.png') }}" class="iconclubesligamovil size-xs">
                                                        <div class="textoequipo2movil">
                                                            <p class="nameclubmovil">{{ Str::limit($match->team_two->name, 15) }}</p>
                                                        </div>
                                                    @endif

                                                        {{--  <img
                                                            src="{{asset('assets/img/favicon/favicon.png') }}"
                                                            class="iconclubesligamovil size-xs">
                                                        <div class="textoequipo2movil">
                                                            <p class="nameclubmovil">{{$match->team_two->name}}</p>
                                                        </div>  --}}

                                                @endif



                                        </a>
                                    </div>

                                </div>

                                <div class="contenedor-horizontal">
                                    <div class="elemento">
                                        <button type="button" class="btn btn-primary infopartidoverMovil" data-bs-toggle="modal" data-bs-target="#animationModal{{ $match->id }}" style="height: 42px;width: 100%;">
                                           <span style="margin-right: 5px;">Detalles</span> <i class="fa-sharp fa-solid fa-list-ul fa-lg" style="color: #080808;"></i></i>
                                        </button>
                                    </div>
                                    <div class="elemento">
                                        <a href="{{ route('resumenpartido.view', ['league_slug' => $league->slug, 'tournament_slug' => $tournament->slug, 'id_partidoresumen' => $match->id]) }}">

                                            <button class="infopartidoverMovil">
                                                <span style="margin-right: 5px;">Ver Partido</span> <i class="fa-sharp fa-regular fa-circle-right fa-xl"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>


                            </div>
                            @include('frontend.modalinfopartidoResultado.index')
                        @empty
                            <p class="nohaypartidomovil">No hay partido</p>
                        @endforelse









                        @if($matches->total()!=0)
                            <div class="row mx-2 my-3">
                                <div class="col-md-5 text-sm-start" style="text-align: center">
                                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                        {{__('Showing')}} {{ $matches->firstItem() }} {{__('to')}} {{ $matches->lastItem() }} {{__('of')}} {{ $matches->total() }} {{__('results')}}
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                                    @if ($matches->hasPages())
                                        {{$matches->links('vendor.livewire.bootstrap')}}
                                    @endif
                                </div>
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
    <script>
        $(function () {
            window.initResultsShow=()=>{
                // Select2
                $('.select-result .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    allowClear: Boolean($(this).data('allow-clear')),
                    dropdownParent: $('.select-result')
                });
            }
            $('.select-result .single-select').on('change', function (e) {
                livewire.emit('ResultsShowChange', $(this).val(), $(this).attr('wire:model'))
            });
            window.livewire.on('ResultsShowHydrate',()=>{
                initResultsShow();
            });

            livewire.emit('ResultsShowChange', '', '');
        });
    </script>
</div>
