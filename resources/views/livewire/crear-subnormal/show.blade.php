<div wire:init="readyToLoad">
    <div wire:ignore.self class="card" id="show">

        <div class="card-datatable table-responsive pt-0">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">{{__('Subnormal zone')}}</h5>
                    </div>

                    @if ($this->loggedUserRole != 'Control de energia' && $this->loggedUserRole != 'Centro de Inteligencia')
                        <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <div class="dt-buttons btn-group flex-wrap">
                                <button class="dt-button add-new btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                                    <span>
                                    <i class="ti ti-plus me-0 me-sm-1"></i>
                                    <span class=" d-sm-inline-block">{{__('Add Subnormal zone')}}</span>
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
                                @if($creacionsubnormal->total()>10)
                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                        <label>
                                            {{__('Show')}}
                                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" wire:model="cant">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                @if($creacionsubnormal->total()>25)
                                                    <option value="50">50</option>
                                                @endif
                                                @if($creacionsubnormal->total()>50)
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

                    @if($this->loggedUserRole == 'Control de energia')
                        <div class="col-sm-12 col-md-8 d-flex justify-content-center justify-content-md-end">
                            <div class="row">

                                <div class="col-md-6 mpx-2 mb-3" style="justify-content: center;display: flex;align-items: end;">
                                    <button type="reset" class="btn btn-primary " wire:click="resetFilter">
                                        <span><i class="fa-solid fa-arrows-rotate me-1 ti-xs"></i>{{__('Reset search')}}</span>
                                    </button>

                                </div>

                                <div class="col-md-6 mpx-2 mb-3">
                                    <label for="">{{__('Search invoice code')}}:</label>
                                    <input type="search" name="queryControlcodefactura" wire:model="queryControlcodefactura" class="form-control" placeholder="{{__('Buscar codigo de Macro')}}">

                                </div>
                                




                            </div>

                        </div>

                    @endif





                    @if($this->loggedUserRole == 'Centro de Inteligencia' || $this->loggedUserRole == 'Admin')
                        <div class="col-sm-12 col-md-8 d-flex justify-content-center justify-content-md-end">
                            <div class="row">

                                <div class="col-md-4 mpx-2 mb-3">
                                    <label for="">{{__('Search by sector name')}}:</label>
                                    <input type="search" name="querySectorName" wire:model="querySectorName" class="form-control" placeholder="{{__('sector name')}}">
                                </div>

                                <div class="col-md-4 mpx-2 mb-3">
                                    <label for="">{{__('Search code macro')}}:</label>
                                    <input type="search" name="queryControlTerreno" wire:model="queryControlTerreno" class="form-control" placeholder="{{__('Buscar codigo de Macro')}}">

                                </div>

                                <div class="col-md-4 mpx-2 mb-3">
                                    <label for="">{{__('Search invoice code')}}:</label>
                                    <input type="search" name="queryControlcodefactura" wire:model="queryControlcodefactura" class="form-control" placeholder="{{__('Buscar codigo de Macro')}}">

                                </div>

                            </div>

                        </div>

                    @endif




                </div>
                <div class="table-container">


                    <table class="table" id="miTabla">
                        <thead class="border-top">
                            <tr>
                                <th class="text-center">{{__('municipality')}}</th>
                                <th class="text-center">{{__('Sector name')}}</th>
                                <th class="text-center">{{__('macrometer code')}}</th>
                                <th class="text-center">{{__('invoice code')}}</th>

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <th class="text-center">{{__('Leader Name')}}</th>
                                @endif

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <th class="text-center">{{__('Leaders phone')}}</th>
                                @endif

                                <th class="text-center">{{__('Address')}}</th>

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <th class="text-center">{{__('Mayors Certificate')}}</th>
                                @endif

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <th class="text-center">{{__('Acta Leader')}}</th>
                                @endif

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <th class="text-center">{{__('Emsa Agreement')}}</th>
                                @endif

                                @if ($this->loggedUserRole != 'Control de energia' && $this->loggedUserRole != 'Centro de Inteligencia')
                                    <th class="text-center">{{__('document upload')}}</th>
                                @endif

                                @if ($this->loggedUserRole != 'Control de energia'  && $this->loggedUserRole != 'Centro de Inteligencia')
                                    <th class="text-center">{{__('billing notification')}}</th>
                                @endif

                                <th class="text-center">{{__('View Documents')}}</th>

                                @if ($this->loggedUserRole != 'Control de energia')
                                    <th class="text-center">{{__('edit record')}}</th>
                                @endif

                                @if ($this->loggedUserRole == 'Control de energia' ||  $this->loggedUserRole == 'Centro de Inteligencia')
                                    <th class="text-center">{{__('Add invoice code')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($creacionsubnormal as $creacionsubnormals)
                            <tr>
                                <td class="text-center">{{$creacionsubnormals->municipality->name}}</td>
                                <td class="text-center">{{$creacionsubnormals->sector_name}}</td>
                                <td class="text-center">{{$creacionsubnormals->controlterreno->code_macromedidor}}</td>

                                @if($creacionsubnormals->codefactura && $creacionsubnormals->codefactura->invoice_code != null)
                                    <td class="text-center">{{$creacionsubnormals->codefactura->invoice_code}}</td>
                                @else
                                    <td class="text-center">Sin codigo</td>
                                @endif


                                @if ($this->loggedUserRole != 'Facturacion')
                                    <td class="text-center">{{$creacionsubnormals->controlterreno->Datoscaminante->name}}</td>
                                @endif

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <td class="text-center">{{$creacionsubnormals->phone}}</td>
                                @endif

                                <td class="text-center">{{$creacionsubnormals->address}}</td>


                                @if ($this->loggedUserRole != 'Facturacion')
                                    <td class="text-center"><span class="{{ $creacionsubnormals->docalcaldia ? 'estado-activo' : 'estado-inactivo' }}"></span></td>
                                @endif

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <td class="text-center"><span class="{{ $creacionsubnormals->doclider ? 'estado-activo' : 'estado-inactivo' }}"></span></td>
                                @endif

                                @if ($this->loggedUserRole != 'Facturacion')
                                    <td class="text-center"><span class="{{ $creacionsubnormals->docacuerdoemsa ? 'estado-activo' : 'estado-inactivo' }}"></span></td>
                                @endif

                                @if ($this->loggedUserRole != 'Control de energia' && $this->loggedUserRole != 'Centro de Inteligencia')
                                    <td class="text-center">
                                        <div class="d-inline-block text-nowrap">

                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#cargarCertificado"
                                            wire:click="$set('docAlcaldiaa', {{ $creacionsubnormals->id }})" title="Certificado Alcaldia">
                                                <i class="fa-solid fa-landmark"></i>
                                            </button>

                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#cargarActa"
                                                wire:click="$set('doclideer', {{ $creacionsubnormals->id }})" title="Acuerdo Lider">
                                                <i class="fa-solid fa-user"></i>
                                            </button>

                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#cargarAcuerdo"
                                                wire:click="$set('docacuerdoemsaa', {{ $creacionsubnormals->id }})" title="Acuerdo Emsa">
                                                <i class="fa-solid fa-file"></i>
                                            </button>


                                        </div>
                                    </td>
                                @endif


                                @if ($this->loggedUserRole != 'Control de energia' && $this->loggedUserRole != 'Centro de Inteligencia')

                                    <td class="text-center">
                                        @php
                                            $estado = $creacionsubnormals->docacuerdoemsa ? 'estado-activo' : 'estado-inactivo';
                                        @endphp


                                        <button id="boton-campana" class="btn btn-sm btn-icon" {{ $estado == 'estado-activo' ? '' : 'disabled' }} wire:click="handleClickButton({{ $creacionsubnormals->id }})" title="Notificar a centro de inteligencia">
                                            <i class="fa-solid fa-bell"></i>
                                        </button>

                                        <div wire:loading wire:target="handleClickButton({{ $creacionsubnormals->id }})">
                                            <!-- Aquí puedes mostrar la alerta de espera con el preloader -->
                                            <div class="alert alert-info">
                                                <div class="spinner-border" role="status" style="width: 1.5rem !important;height: 1.5rem !important;">
                                                    <span class="visually-hidden">Enviado Correos...</span>
                                                </div>
                                                <span style="font-size: 13px;text-align: center;display: flex;justify-content: center;"> Enviado Correos...</span>
                                            </div>
                                        </div>




                                        @if (isset($notificationSent[$creacionsubnormals->id]) && $notificationSent[$creacionsubnormals->id])
                                            <div class="alert alert-success" style="font-size: 12px;width: 122px;margin: 10px;">
                                            <span>Correo enviado.</span>
                                            </div>
                                        @endif

                                    </td>
                                @endif


                                <td class="text-center">
                                    <div class="d-inline-block text-nowrap">

                                        <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#retrieveDocuments"  wire:click="retrieveDocuments({{ $creacionsubnormals->id }})" title="Visulizar Documentos">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>





                                    </div>

                                </td>


                                @if ($this->loggedUserRole != 'Control de energia')
                                    <td class="text-center">
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$creacionsubnormals->id}})" title="Editar">
                                                <i class="ti ti-edit"></i>
                                            </button>

                                        </div>
                                    </td>
                                @endif

                                @if ($this->loggedUserRole == 'Control de energia' ||  $this->loggedUserRole == 'Centro de Inteligencia')
                                    <td class="text-center">
                                        <div class="d-inline-block text-nowrap">

                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#invoicecode"
                                            wire:click="$set('codefactura', {{ $creacionsubnormals->id }})" title="Agregar codigo para la factura">
                                                <i class="fa-solid fa-file-invoice"></i>
                                            </button>



                                        </div>
                                    </td>
                                @endif


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
                    @if($creacionsubnormal->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $creacionsubnormal->firstItem() }} {{__('to')}} {{ $creacionsubnormal->lastItem() }} {{__('of')}} {{ $creacionsubnormal->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-end">
                                @if ($creacionsubnormal->hasPages())
                                    {{$creacionsubnormal->links('vendor.livewire.bootstrap')}}
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            @include('CrearSubNormal.documentalcaldia')
            @include('CrearSubNormal.cargarActa')
            @include('CrearSubNormal.cargarAcuerdo')
            @include('CrearSubNormal.edit')
            @include('CrearSubNormal.Listdocumentos')
            @include('CrearSubNormal.visualizardocalcaldia')
            @include('CrearSubNormal.visualizardocAcuerdoemsa')
            @include('CrearSubNormal.visualizardocActa')
            @include('CrearSubNormal.viewDocument')
            @include('CrearSubNormal.codigotesoreria')

        </div>

    </div>









</div>




