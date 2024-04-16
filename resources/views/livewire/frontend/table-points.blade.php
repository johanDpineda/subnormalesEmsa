<div>
    <section  class="table  table_body my-2">
       <div class="container">
           <div class="row py-1 ">
                {{--  <div class="col-md-4 text-end d-flex align-items-end text-end justify-content-end">
                    <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                </div>  --}}
                <div class="col-md-12 text-sm-start">
                    <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                </div>
               <div class="col-6 col-md-4 select-points">
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
               <div class="col-6 col-md-4 select-points">
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
       </div>
        <table class="table tablagolesliga  table-striped table-hover">
            <thead >
            <tr class="barrainfoligaposiciones">
                <th scope="col" class="posiciontabla">#</th>
                <th scope="col" class="posiciontabla">{{__('Team')}}</th>
                <th scope="col" class="posiciontabla">PJ</th>
                <th scope="col" class="posiciontabla">PG</th>
                <th scope="col" class="posiciontabla">PE</th>
                <th scope="col" class="posiciontabla">PP</th>
                <th scope="col" class="posiciontabla">GF</th>
                <th scope="col" class="posiciontabla">GC</th>
                <th scope="col" class="posiciontabla">DG</th>
                <th scope="col" class="posiciontabla">PTS</th>
            </tr>
            </thead>
            <tbody >
            @forelse ($teamPoints as $teamPoint)
                <tr class="infoposiciontorneo">
                    <td class="pos posiciongoleador">{{ $teamPoint->position }}</td>
                    <td class="teamequipogeneral ligaposition">
                        <div class="tamanoletraequipo">

                            <div class="shield-mobile modocel textcenter">
                                @if($teamPoint->teams->logo!=null)
                                    <img
                                        src="{{asset('uploads/teams/'.$teamPoint->teams->logo) }}"
                                        class="fotosequipostablageneral">
                                @else
                                    @php
                                        $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                                        $imagenAleatoria = collect($imagenes)->random();
                                    @endphp

                                    <div class="avatar-wrapper m-1">
                                        <div class="avatar avatar-sm">
                                            @if ($imagenAleatoria)
                                                <img src="{{ asset('uploads/logoteams/' . $imagenAleatoria->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesligamovil size-xs">
                                            @else
                                                <p>No se encontraron imágenes.</p>
                                            @endif
                                                {{--  <span class="avatar-initial rounded-circle bg-label-primary">{{ $teamPoint->teams->name[0] }}</span>  --}}
                                        </div>
                                    </div>
                                @endif
                                <a>{{ Str::limit($teamPoint->teams->name, 9) }}</a>
                            </div>

                            <div class="shield-desktop modocel">
                                @if($teamPoint->teams->logo!=null)
                                    <img
                                        src="{{asset('uploads/teams/'.$teamPoint->teams->logo) }}"
                                        class="fotosequipostablageneral">
                                @else
                                    <div class="avatar-wrapper m-1">
                                        <div class="avatar avatar-sm">
                                            @if ($imagenAleatoria)
                                                <img src="{{ asset('uploads/logoteams/' . $imagenAleatoria->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesligamovil size-xs">
                                            @else
                                                <p>No se encontraron imágenes.</p>
                                            @endif

                                            {{--  <span class="avatar-initial rounded-circle bg-label-primary">{{ $teamPoint->teams->name[0] }}</span>  --}}
                                        </div>
                                    </div>
                                @endif
                                <a>{{ $teamPoint->teams->name }}</a>
                            </div>

                        </div>
                    </td>
                    <td class="teams contengeneral">{{ $teamPoint->matches_played }}</td>
                    <td class="teams contengeneral">{{ $teamPoint->matches_won }}</td>
                    <td class="teams contengeneral">{{ $teamPoint->tied_matches }}</td>
                    <td class="teams contengeneral">{{$teamPoint->matches_lost}}</td>
                    <td class="teams contengeneral">{{$teamPoint->goals_scored}}</td>
                    <td class="teams contengeneral">{{$teamPoint->goals_against}}</td>
                    <td class="teams contengeneral">{{$teamPoint->goals_difference}}</td>
                    <td class="teams contengeneral negrillapuntos">{{ $teamPoint->total_points }}</td>
                </tr>
            @empty
                <tr class="odd">
                    <td valign="top" colspan="12" class="dataTables_empty text-center">
                        {{$teamPoints?'El equipo seleccionado está en otro grupo':'No hay puntajes'}}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if($teamPoints->total()!=0)
            <div class="row mx-2 my-3">
                <div class="col-md-5 text-sm-start" style="text-align: center">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                        {{__('Showing')}} {{ $teamPoints->firstItem() }} {{__('to')}} {{ $teamPoints->lastItem() }} {{__('of')}} {{ $teamPoints->total() }} {{__('results')}}
                    </div>
                </div>
                <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                    @if ($teamPoints->hasPages())
                        {{$teamPoints->links('vendor.livewire.bootstrap')}}
                    @endif
                </div>
            </div>
        @endif
    </section>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
    <script>
        $(function () {
            window.initTablePointsShow=()=>{
                // Select2
                $('.select-points .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    allowClear: Boolean($(this).data('allow-clear')),
                    dropdownParent: $('.select-points')
                });
            }
            $('.select-points .single-select').on('change', function (e) {
                livewire.emit('TablePointsShowChange', $(this).val(), $(this).attr('wire:model'))
            });
            window.livewire.on('TablePointsShowHydrate',()=>{
                initTablePointsShow();
            });

            livewire.emit('TablePointsShowChange', '', '');
        });
    </script>
</div>
