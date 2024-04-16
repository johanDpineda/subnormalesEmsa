<div wire:init="readyToLoad">
    <div wire:ignore.self class="card" id="show">
        <div class="card-datatable table-responsive pt-0">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">{{__('Data records of walkers')}}</h5>
                    </div>
                    @if($loggedUserRole != 'Centro de Inteligencia' && $loggedUserRole != 'Admin')
                        <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <div class="dt-buttons btn-group flex-wrap">
                                <button class="dt-button add-new btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                                    <span>
                                    <i class="ti ti-plus me-0 me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block">{{__('Add sector')}}</span>
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
                                    <button class="btn btn-secondary btn-label-secondary mx-0 w-100" wire:click="exportarExcel">
                                        <span><i class="ti ti-upload me-1 ti-xs"></i>{{__('Export')}}</span>
                                    </button>
                                </div>
                                <div class="col-md-7">

                                </div>

                            </div>
                        </div>

                    @endif

                    <div class="col-sm-12 col-md-4">
                        <div class="me-3">
                            @if($readyToLoad)
                                @if($caminante->total()>10)
                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                        <label>
                                            {{__('Show')}}
                                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" wire:model="cant">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                @if($caminante->total()>25)
                                                    <option value="50">50</option>
                                                @endif
                                                @if($caminante->total()>50)
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

                        <div class="col-sm-12 col-md-8 d-flex justify-content-center justify-content-md-end">
                            <div class="row">

                                <div class="col-md-4 mpx-2 mb-3 ">
                                    <label for="searchInput">{{__('Search leader name')}}:</label>
                                    <input type="search" id="searchInput" name="query" wire:model="query" class="form-control" placeholder="{{__('Search Leader Name')}}...">
                                </div>

                                <div class="col-md-4 px-2 mb-3 select-dataWalker">
                                    <label for="Walker_id">{{__('Walker')}}:</label>
                                    <select id="Walker_id" wire:model="Walker_id" name="Walker_id" class="select2 form-select single-select" data-placeholder="{{__('Select a walker')}}...">
                                        <option value=""></option>
                                        @if($walking !== null && $walking->isNotEmpty())
                                            @foreach($walking as $walkings)
                                                <option value="{{$walkings->id}}">{{$walkings->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>

                                <div class="col-md-4 px-2 mb-3 select-dataWalker">
                                    <label for="networkstatuss_id">{{__('Network status')}}:</label>
                                    <select id="networkstatuss_id" wire:model="networkstatuss_id" name="networkstatuss_id" class="select2 form-select single-select" data-placeholder="{{__('Select a network status')}}...">
                                        <option value=""></option>
                                        @if($networkstatuss !== null && $networkstatuss->isNotEmpty())
                                            @foreach($networkstatuss as $networkstatus)
                                                <option value="{{$networkstatus->id}}">{{$networkstatus->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>

                            </div>

                        </div>

                    @endif




                </div>
                <div class="table-container">

                    <table class="table">
                        <thead class="border-top">
                            <tr>

                                <th class="text-center">{{__('Leader Name')}}</th>
                                <th class="text-center">{{__('Latitude')}}</th>
                                <th class="text-center">{{__('Longitude')}}</th>
                                <th class="text-center">{{__('Transformer quantity')}}</th>
                                <th class="text-center">{{__('user quantity')}}</th>
                                <th class="text-center">{{__('Network status')}}</th>
                                @if($loggedUserRole == 'Centro de Inteligencia' || $loggedUserRole == 'Admin')
                                    <th class="text-center">{{__('Walker')}}</th>
                                @endif
                                <th class="text-center">{{__('Observations')}}</th>
                                <th class="text-center">{{__('Map')}}</th>



                                @if ($this->loggedUserRole != 'Centro de Inteligencia')
                                    <th class="text-center">{{__('Actions')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($caminante as $caminantes)
                            <tr>

                                <td class="text-center">{{$caminantes->name}}</td>
                                <td class="text-center">{{$caminantes->latitude}}</td>
                                <td class="text-center">{{$caminantes->longitude}}</td>
                                <td class="text-center">{{$caminantes->Cantidad_transformador}}</td>
                                <td class="text-center">{{$caminantes->Cantidad_usuario}}</td>
                                <td class="text-center">{{$caminantes->networkstatus->name}}</td>

                                @if($loggedUserRole == 'Centro de Inteligencia' || $loggedUserRole == 'Admin')
                                    <td class="text-center">{{$caminantes->user->name}}</td>
                                @endif




                                <td class="text-center">
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#observaciones" wire:click="openMapModalobservaciones({{ $caminantes->id }})" title="Observaciones">
                                                <i class="fa-regular fa-comment-dots"></i>
                                            </button>


                                        </div>
                                </td>





                                <td class="text-center">
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#maps" wire:click="openMapModal({{ $caminantes->id }})" title="Ver Mapa">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </button>


                                        </div>
                                </td>




                                @if ($this->loggedUserRole != 'Centro de Inteligencia')
                                    <td class="text-center">
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$caminantes}})" title="Editar">
                                                <i class="ti ti-edit"></i>
                                            </button>

                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr class="odd">
                                <td valign="top" colspan="12" class="dataTables_empty text-center">{{$readyToLoad?__('No Sector registered'):__('Loading...')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
                @if ($readyToLoad)
                    @if($caminante->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $caminante->firstItem() }} {{__('to')}} {{ $caminante->lastItem() }} {{__('of')}} {{ $caminante->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-end">
                                @if ($caminante->hasPages())
                                    {{$caminante->links('vendor.livewire.bootstrap')}}
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
   @include('Caminantes.edit')
   @include('Caminantes.maps')
   @include('Caminantes.observaciones')

   <script src="{{asset('js/jquery.min.js')}}"></script>
   <script src="{{asset('js/select2.min.js')}}" defer></script>
   <script>
       $(function () {
           window.initHome=()=>{
               // Select2
               $('.select-dataWalker .single-select').select2({
                   width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                   placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona Un Caminante ...',
                   allowClear: Boolean($(this).data('allow-clear')),
                   dropdownParent: $('.select-dataWalker')
               });
           }
               $('.select-dataWalker .single-select').on('change', function (e) {
                   livewire.emit('walkerShowChange', $(this).val(), $(this).attr('wire:change'))
               });

               $('#Walker_id').on('change', function (e) {
                   @this.set($(this).attr('wire:model'), e.target.value);

               });

               $('#networkstatuss_id').on('change', function (e) {
                   @this.set($(this).attr('wire:model'), e.target.value);

               });



                window.livewire.on('walkerShowHydrate',()=>{
                   initHome();
               });
               livewire.emit('walkerShowChange', '', '');




           });


   </script>
</div>
