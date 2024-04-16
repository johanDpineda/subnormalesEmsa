<div wire:init="readyToLoad">
    <div wire:ignore.self class="card" id="show">

        <div class="card-datatable table-responsive pt-0">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">{{__('Census list')}}</h5>
                    </div>

                    @if ($this->loggedUserRole != 'Centro de Inteligencia')
                        <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <div class="dt-buttons btn-group flex-wrap">
                                <button class="dt-button add-new btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                                    <span>
                                    <i class="ti ti-plus me-0 me-sm-1"></i>
                                    <span class="d-sm-inline-block">{{__('add census')}}</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">

                    @if($this->loggedUserRole == 'Centro de Inteligencia' || $this->loggedUserRole == 'Admin')
                        <div class="col-md-12 text-md-start my-4">

                            <div class="row">
                                <div class="col-md-3 col-sm-12 mb-3">

                                    <button type="reset" class="btn btn-primary w-100" wire:click="resetFilter">
                                        <span><i class="fa-solid fa-arrows-rotate me-1 ti-xs"></i>{{__('Reset search')}}</span>
                                    </button>

                                </div>

                                <div class="col-md-2 col-sm-12 mb-3">

                                    <button class="btn btn-secondary btn-label-secondary mx-0 w-100" wire:click="exportarExcel"><span><i class="ti ti-upload me-1 ti-xs"></i>{{__('Export')}}</span></button>

                                </div>
                                <div class="col-md-7">

                                </div>

                            </div>




                        </div>
                    @endif

                    <div class="col-sm-12 col-md-4">
                        <div class="me-3">
                            @if($readyToLoad)
                                @if($censofamiliasubnormals->total()>10)
                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                        <label>
                                            {{__('Show')}}
                                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" wire:model="cant">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                @if($censofamiliasubnormals->total()>25)
                                                    <option value="50">50</option>
                                                @endif
                                                @if($censofamiliasubnormals->total()>50)
                                                    <option value="100">100</option>
                                                @endif
                                            </select>
                                            {{__('entries')}}
                                        </label>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>


                    @if($this->loggedUserRole == 'Centro de Inteligencia' || $this->loggedUserRole == 'Admin')
                        <div class="col-sm-12 d-flex justify-content-center">
                            <div class="row">


                                <!-- Columna 1 -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <!-- Contenido del primer div -->
                                        <div class="col-md-4 mpx-2 mb-3">
                                            <label for="">{{__('Nit')}}:</label>
                                            <input type="search" name="querycc" wire:model="querycc" class="form-control" placeholder="{{__('Cedula')}}">
                                        </div>

                                        <div class="col-md-4 mpx-2 mb-3">
                                            <label for="">{{__('Search code macro')}}:</label>
                                            <input type="search" name="querycodemacro" wire:model="querycodemacro" class="form-control" placeholder="{{__('Buscar codigo de Macro')}}">
                                        </div>

                                        <div class="col-md-4 mpx-2 mb-3">
                                            <label for="">{{__('sector name')}}:</label>
                                            <input type="search" name="query" wire:model="query" class="form-control" placeholder="{{__('Buscar nombre sector')}}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna 2 -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <!-- Contenido del segundo div -->
                                        <div class="col-md-6 mpx-2 mb-3">
                                            <label for="">{{__('representative name')}}:</label>
                                            <input type="search" name="querynamerepresentante" wire:model="querynamerepresentante" class="form-control" placeholder="{{__('Buscar nombre representante')}}">

                                        </div>

                                        <div class="col-md-6 mpx-2 mb-3">
                                            <label for="">{{__('Census Date')}}:</label>
                                            <input type="date" name="queryfechacenso" wire:model="queryfechacenso" class="form-control" >

                                        </div>
                                    </div>
                                </div>









                            </div>

                        </div>


                    @endif


                </div>



                <div class="table-container">


                    <table class="table" id="miTabla">
                        <thead class="border-top">
                            <tr>

                                <th class="text-center">{{__('Sector name')}}</th>
                                <th class="text-center">{{__('Nombre representante')}}</th>
                                <th class="text-center">{{__('area')}}</th>
                                <th class="text-center">{{__('cedula')}}</th>
                                <th class="text-center">{{__('codigo siec')}}</th>
                                <th class="text-center">{{__('Macro')}}</th>
                                <th class="text-center">{{__('Municipio')}}</th>
                                <th class="text-center">{{__('celular')}}</th>
                                <th class="text-center">{{__('Fecha censo')}}</th>
                                <th class="text-center">{{__('direccion')}}</th>

                                <th class="text-center">{{__('Census document')}}</th>

                                <th class="text-center">{{__('Document update')}}</th>


                                @if($this->loggedUserRole != 'Grupo Social')
                                    <th class="text-center">{{__('code siec')}}</th>
                                @endif

                                <th class="text-center">{{__('document upload')}}</th>

                                <th class="text-center">{{__('View Documents')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($censofamiliasubnormals as $censofamiliasubnormal)
                            <tr>

                                @if ($censofamiliasubnormal->Datoszonas->sector_name != 'null')
                                    <td class="text-center">{{ $censofamiliasubnormal->Datoszonas->sector_name }}</td>
                                @endif

                                @if ($censofamiliasubnormal->Datoszonas->controlterreno->Datoscaminante->name != 'null')
                                    <td class="text-center">{{ $censofamiliasubnormal->Datoszonas->controlterreno->Datoscaminante->name }}</td>
                                @endif

                                @if ($censofamiliasubnormal->area != 'null')
                                    <td class="text-center">{{$censofamiliasubnormal->area}}</td>
                                @endif

                                @if ($censofamiliasubnormal->cedula_lider != 'null')
                                    <td class="text-center">{{ $censofamiliasubnormal->cedula_lider }}</td>
                                @endif



                                <td class="text-center">{{$censofamiliasubnormal->codesiecs?$censofamiliasubnormal->codesiecs->codigo_siec:'Sin Codigo'}}</td>



                                @if ($censofamiliasubnormal->Datoszonas->controlterreno->code_macromedidor != 'null')
                                    <td class="text-center">{{ $censofamiliasubnormal->Datoszonas->controlterreno->code_macromedidor  }}</td>
                                @endif

                                @if ($censofamiliasubnormal->Datosmunicipios->name != 'null')
                                    <td class="text-center">{{ $censofamiliasubnormal->Datosmunicipios->name }}</td>
                                @endif

                                @if ($censofamiliasubnormal->Datoszonas->phone != 'null')
                                    <td class="text-center">{{$censofamiliasubnormal->Datoszonas->phone }}</td>
                                @endif

                                @if ($censofamiliasubnormal->fecha_censo != 'null')
                                <td class="text-center">{{ \Carbon\Carbon::parse($censofamiliasubnormal->fecha_censo)->format('d/m/Y') }}</td>

                                @endif

                                @if ($censofamiliasubnormal->Datoszonas->phone != 'null')
                                    <td class="text-center">{{ $censofamiliasubnormal->Datoszonas->address }}</td>
                                @endif

                                <td class="text-center"><span class="{{ $censofamiliasubnormal->doccensofamily ? 'estado-activo' : 'estado-inactivo' }}"></span></td>

                                <td class="text-center">{{ $censofamiliasubnormal->doccensofamily?$censofamiliasubnormal->doccensofamily->updated_at:'Sin Actualizacion'}}</td>


                                @if($this->loggedUserRole != 'Grupo Social')
                                    <td class="text-center">

                                        <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#codigosiec"
                                        wire:click="$set('codigosiecsub', {{ $censofamiliasubnormal->id }})" title="Codigo Siec">
                                            <i class="fa-solid fa-barcode"></i>
                                        </button>

                                    </td>
                                @endif

                                <td class="text-center">

                                    <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#cargarcenso"
                                    wire:click="$set('doccenso', {{ $censofamiliasubnormal->id }})" title="Cargar Documento Censo">
                                        <i class="fa-solid fa-users-rectangle"></i>
                                    </button>

                                </td>

                                <td class="text-center">
                                    <div class="d-inline-block text-nowrap">

                                        <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#viewcenso"  wire:click="viewcenso({{ $censofamiliasubnormal->id }})" title="Ver Documento">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>





                                    </div>

                                </td>


                            </tr>
                        @empty
                            <tr class="odd">
                                <td valign="top" colspan="12" class="dataTables_empty text-center">{{$readyToLoad?__('No zoneSubnormal registered registered'):__('Loading...')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
                @if ($readyToLoad)
                    @if($censofamiliasubnormals->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $censofamiliasubnormals->firstItem() }} {{__('to')}} {{ $censofamiliasubnormals->lastItem() }} {{__('of')}} {{ $censofamiliasubnormals->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-end">
                                @if ($censofamiliasubnormals->hasPages())
                                    {{$censofamiliasubnormals->links('vendor.livewire.bootstrap')}}
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>



        </div>
        @include('censofamilia.document')
        @include('censofamilia.codesiec')
        @include('censofamilia.listdocumentoscensos')
        @include('censofamilia.visualizarcenso')
    </div>




</div>
