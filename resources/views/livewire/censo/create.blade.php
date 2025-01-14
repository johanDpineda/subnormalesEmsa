<div>
    <div wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple ">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Data Caminante')}}</h3>
                        <p class="text-muted">{{__('Complete the information to add a new user')}}</p>
                    </div>
                    <form class="row g-3" wire:submit.prevent="save" >

                        <div class="col-12 select-crearsubnormal">
                            <label class="form-label" for="role">{{__('Subnormal zone')}}</label>
                            <select id="zona_subnormal_id" name="zona_subnormal_id" wire:model.defer="zona_subnormal_id" class="select2 form-select single-select" data-placeholder="{{__('Select a Subnormal zone')}}...">
                                <option></option>
                                @foreach($controlterreno  as $controlterrenos)
                                <option value="{{$controlterrenos->id}}">{{__('Leader Name')}}: {{$controlterrenos->controlterreno->Datoscaminante->name}}</option>
                                @endforeach
                            </select>
                            @error('zona_subnormal_id')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12 select-crearsubnormal">
                            <label class="form-label" for="role">{{__('Municipalities')}}</label>
                            <select id="municipalities_id" name="municipalities_id" wire:model.defer="municipalities_id" class="select2 form-select single-select" data-placeholder="{{__('select a municipality')}}...">
                                <option></option>
                                @foreach($municipios  as $municipio)
                                <option value="{{$municipio->id}}">{{$municipio->name}}</option>
                                @endforeach
                            </select>
                            @error('municipalities_id')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="cedula_lider">{{__('leaders nameplate')}}:</label>
                            <input type="number" id="cedula_lider" class="form-control" placeholder="" name="cedula_lider" aria-label="" wire:model.defer="cedula_lider" />
                            @error('cedula_lider')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="area">{{__('Area')}}:</label>
                            <input type="text" id="area" class="form-control" placeholder="" name="area" aria-label="" wire:model.defer="area" />
                            @error('area')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="area">{{__('Census date')}}:</label>
                            <input type="date" id="fecha_censo" class="form-control" placeholder="" name="fecha_censo" aria-label="" wire:model.defer="fecha_censo" />
                            @error('fecha_censo')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>


                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="save" wire:click='save'>
                                {{__('Save')}}</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean">
                                {{__('Cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>

    <script>
        $(function () {
            window.initUsersCreate=()=>{
                // Select2
                $('.select-crearsubnormal .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    dropdownParent: $('.select-crearsubnormal')
                });
            }
            $('.select-crearsubnormal .single-select').on('change', function (e) {
                livewire.emit('sectorsubnormalCreateChange', $(this).val(), $(this).attr('wire:model.defer'));
            });

            window.livewire.on('sectorsubnormalCreateHydrate',()=>{
                initUsersCreate();
            });
            livewire.emit('sectorsubnormalCreateChange', '', '');
        });
    </script>



</div>
