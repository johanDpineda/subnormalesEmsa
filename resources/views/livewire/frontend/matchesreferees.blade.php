<div>
    <div class="modal-body" style="padding: 0px;" >

        <div class="player-stats">

            <div class="stats-container">
                <div class="statperfilarbitro">

                    <section  class="table  table_bodyperfilarbitro">
                        <table class="partidosarbitros table_bodyarbitro table-striped table-hover">



                            <tbody class="custom-tbody">

                                @foreach($matches as $ultimosmatchs)
                                        <tr class="descripcionarbitro">
                                                <td class="custom-td" style="width: 100%;">

                                                    <div class="partidosoficiales">
                                                        <div class="clubespartidos">
                                                            <a href="">
                                                                <div class="cluboficiales">
                                                                    @if($ultimosmatchs->team_one->logo!=null)

                                                                        <img
                                                                            src="{{asset('uploads/teams/'.$ultimosmatchs->team_one->logo) }}"
                                                                            class="iconclubesliga size-xs">
                                                                        <div class="textoequipo1referees">
                                                                            <p class="nameclubarbitro">{{ Str::limit($ultimosmatchs->team_one->name, 13) }} </p>
                                                                        </div>

                                                                    @else

                                                                        @php
                                                                            $imagenes = File::allFiles(public_path('uploads/logoteamscolor/'));
                                                                            $imagenAleatoria = collect($imagenes)->random();
                                                                        @endphp

                                                                        @if ($imagenAleatoria)
                                                                            <img src="{{ asset('uploads/logoteamscolor/' . $imagenAleatoria->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesliga size-xs">
                                                                            <div class="textoequipo1referees" >
                                                                                <p class="nameclubarbitro">{{ Str::limit($ultimosmatchs->team_one->name, 13) }}</p>
                                                                            </div>
                                                                        @else
                                                                            <img class="badge-image badge-image--80 js-badge-image" src="{{asset('assets/img/favicon/favicon.png') }}">
                                                                            <div class="textoequipo1" >
                                                                                <p class="nameclubarbitro">{{ Str::limit($ultimosmatchs->team_one->name, 13) }}</p>
                                                                            </div>
                                                                        @endif

                                                                        {{--  <img
                                                                            src="{{asset('assets/img/favicon/favicon.png') }}"
                                                                            class="iconclubesliga size-xs">
                                                                        <div class="textoequipo1referees">
                                                                            <p class="nameclubarbitro">{{$ultimosmatchs->team_one->name}}</p>
                                                                        </div>  --}}

                                                                    @endif


                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div class="clubespartidosgf">

                                                            <div class="live">

                                                                <p class="marcadoresarbitro">{{$ultimosmatchs->results->team_one_score}}</p>
                                                                        <p class="marcadoresarbitro">-</p>
                                                                        <p class="marcadoresarbitro">{{$ultimosmatchs->results->team_two_score}}</p>

                                                                {{--  @if($ultimosmatchs->results!=null)
                                                                    @if($ultimosmatchs->results->team_one_score!=null)

                                                                        <p class="marcadoresarbitro">{{$ultimosmatchs->results->team_one_score}}</p>
                                                                        <p class="marcadoresarbitro">-</p>
                                                                        <p class="marcadoresarbitro">{{$ultimosmatchs->results->team_two_score}}</p>

                                                                    @else
                                                                        <p class="marcadoresarbitro">Vs</p>
                                                                    @endif

                                                                @else

                                                                    <p class="marcadoresarbitro">Vs</p>
                                                                @endif  --}}


                                                            </div>
                                                        </div>

                                                        <div class="clubespartidos">
                                                            <a href="">
                                                                <div class="cluboficialesop2">

                                                                    @if($ultimosmatchs->team_two->logo!=null)

                                                                        <img
                                                                            src="{{asset('uploads/teams/'.$ultimosmatchs->team_two->logo) }}"
                                                                            class="iconclubesliga size-xs">
                                                                        <div class="textoequipo2referees">
                                                                            <p class="nameclubarbitro">{{ Str::limit($ultimosmatchs->team_two->name, 13) }}</p>
                                                                        </div>

                                                                    @else
                                                                        @php
                                                                            $imagenes = File::allFiles(public_path('uploads/logoteamscolor/'));
                                                                            $imagenAleatoriacfassd = collect($imagenes)->random();
                                                                        @endphp

                                                                        @if ($imagenAleatoriacfassd)
                                                                            <img src="{{ asset('uploads/logoteamscolor/' . $imagenAleatoriacfassd->getFilename()) }}" alt="Descripción de la imagen" class="iconclubesliga size-xs">
                                                                            <div class="textoequipo2referees" >
                                                                                <p class="nameclubarbitro">{{ Str::limit($ultimosmatchs->team_two->name, 13) }}</p>
                                                                            </div>
                                                                        @else
                                                                            <img class="badge-image badge-image--80 js-badge-image" src="{{asset('assets/img/favicon/favicon.png') }}">
                                                                            <div class="textoequipo2referees" >
                                                                                <p class="nameclubarbitro">{{ Str::limit($ultimosmatchs->team_two->name, 13) }}</p>
                                                                            </div>
                                                                        @endif

                                                                        {{--  <img
                                                                            src="{{asset('assets/img/favicon/favicon.png') }}"
                                                                            class="iconclubesliga size-xs">
                                                                        <div class="textoequipo2referees">
                                                                            <p class="nameclubarbitro">{{$ultimosmatchs->team_two->name}}</p>
                                                                        </div>  --}}

                                                                    @endif


                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    <div style="margin-top: 10px">
                                                        <span style="color: #dad7d7">Fecha: <span style="color: #c4c0c0"> {{ $ultimosmatchs->date }} </span> </span>
                                                    </div>

                                                </td>

                                        </tr>

                                @endforeach





                            </tbody>

                        </table>
                    </section>

                    @if($matches->total()!=0)
                    <div class=" mx-2 my-3">
                        <div class="text-sm-start" style="text-align: center !important;">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $matches->firstItem() }} {{__('to')}} {{ $matches->lastItem() }} {{__('of')}} {{ $matches->total() }} {{__('results')}}
                            </div>
                        </div>

                    </div>
                    <div class=" d-flex justify-content-center ">
                        @if ($matches->hasPages())
                            {{$matches->links('vendor.livewire.pagination')}}
                        @endif
                    </div>
                @endif


                </div>



            </div>

        </div>


</div>
</div>
