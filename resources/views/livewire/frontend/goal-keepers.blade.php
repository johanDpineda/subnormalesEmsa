<div class="container-fluid flex-grow-1 container-p-y h-100">
    <div class="listagoleadores my-5">
        <h5 class="textogoleadores text-center my-3">Valla menos vencida <span class="text-primary">{{$tournament->name}}</span></h5>
        <div class="vallasmenos">
            <div class="tabladegoleadoresliga">
                <section  class="table  table_body">
                    <div class="container">
                        <div class="row py-1">

                            {{--  <div class="col-md-4 text-end d-flex align-items-end text-end justify-content-end">
                                <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                            </div>  --}}
                            <div class="col-md-4"></div>
                            <div class="col-md-4 ">
                                <div class="select-goal-keepers">
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
                            </div>
                            <div class="col-md-4 text-end d-flex align-items-end text-end justify-content-end">
                                <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                            </div>

                        </div>
                    </div>
                    <table class="tablagolesliga  table_body table-striped table-hover">
                        <thead>
                        <tr class="barrainfoligagoles">
                            <th scope="col" class="posiciongoleadores">
                                <p class="estilobarrainfo"></p>
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
                        @forelse ($goalKeepers as $goalKeeper)
                            <tr>
                                <td class="posiciongoleador">
                                    <p class="numbergoleador">{{ $goalKeeper->position }}</p>
                                </td>
                                <td class="contengeneral teamequipogeneral">
                                    <a href="">
                                        <div class="infoequipo tamanoletraequipo">

                                            @if($goalKeeper->teams->logo!=null)
                                                <i class="fotoequipo">
                                                    <img
                                                        src="{{asset('uploads/teams/'.$goalKeeper->teams->logo) }}"
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
                                                    {{--  <img src="{{asset('assets/img/favicon/favicon.png') }}"
                                                         class="torneofotoclub">  --}}
                                                </i>
                                            @endif


                                            <div class="shield-mobile modocel textcenter">


                                                @if($goalKeeper->teams->name)
                                                    <a href="{{ route('teams.show', ['league_slug' => $league->slug, 'tournament_slug' => $tournament->slug,'team_slug'=>$goalKeeper->teams->slug]) }}" style="margin-left: 8px;width: 90px !important;">
                                                        <p class="clubnombre">{{ Str::limit($goalKeeper->teams->name, 11) }} </p>
                                                    </a>
                                                @else
                                                    <p class="clubnombre"> Sin nombre</p>
                                                @endif

                                            </div>

                                            <div class="shield-desktop modocel">

                                                @if($goalKeeper->teams->name)
                                                    <a href="{{ route('teams.show', ['league_slug' => $league->slug, 'tournament_slug' => $tournament->slug,'team_slug'=>$goalKeeper->teams->slug]) }}" style="margin-left: 10px;">
                                                        <p class="clubnombre tipoletratablagoles"> {{$goalKeeper->teams->name}} </p>
                                                    </a>

                                                @else
                                                    <p class="clubnombre"> Sin nombre</p>
                                                @endif


                                            </div>

                                        </div>
                                    </a>


                                </td>

                                <td class="contengeneral">
                                    <p class="totalgoles"> {{$goalKeeper->goals_against}}</p>
                                </td>

                            </tr>
                        @empty
                            <tr class="odd">
                                <td valign="top" colspan="12" class="dataTables_empty text-center">No hay valla menos vencida</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    @if($goalKeepers->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5 text-sm-start" style="text-align: center">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $goalKeepers->firstItem() }} {{__('to')}} {{ $goalKeepers->lastItem() }} {{__('of')}} {{ $goalKeepers->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                                @if ($goalKeepers->hasPages())
                                    {{$goalKeepers->links('vendor.livewire.bootstrap')}}
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
            window.initGoalKeepersShow=()=>{
                // Select2
                $('.select-goal-keepers .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    allowClear: Boolean($(this).data('allow-clear')),
                    dropdownParent: $('.select-goal-keepers')
                });
            }
            $('.select-goal-keepers .single-select').on('change', function (e) {
                livewire.emit('GoalKeepersShowChange', $(this).val(), $(this).attr('wire:model'))
            });
            window.livewire.on('GoalKeepersShowHydrate',()=>{
                initGoalKeepersShow();
            });

            livewire.emit('GoalKeepersShowChange', '', '');
        });
    </script>
</div>
