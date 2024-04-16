<div>
    <div wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple ">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Walker Data')}}</h3>
                        <p class="text-muted">{{__('Complete the information to add a new zone')}}</p>
                    </div>
                    <form class="row g-3" wire:submit.prevent="save" id="formAuthentication" >

                        <div class="col-12">
                            <label class="form-label" for="name">{{__('Leader Name')}}:</label>
                            <input type="text" id="name" class="form-control" placeholder="{{__('Enter the leader name')}}" name="name" aria-label="" wire:model.defer="name" />
                            @error('name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>


                        <div class="col-12">
                            <label class="form-label" for="name">{{__('Latitude')}}:</label>
                            <input type="number" name="latitude_mirror" id="latitude_mirror" placeholder="{{__('Enter Latitude')}}" wire:model.defer="latitude_mirror" class="form-control">
                            @error('latitude_mirror')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="name">{{__('Longitude')}}:</label>
                            <input type="number" name="longitude_mirror" id="longitude_mirror" placeholder="{{__('Enter Longitude')}}" wire:model.defer="longitude_mirror" class="form-control">
                            @error('longitude_mirror')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>


                        <div class="col-12">
                            <label class="form-label" for="Cantidad_transformador">{{__('Transformer quantity')}}:</label>
                            <input type="number" id="Cantidad_transformador" class="form-control" placeholder="{{__('Enter quantity')}}" name="Cantidad_transformador" aria-label="" wire:model.defer="Cantidad_transformador" />
                            @error('Cantidad_transformador')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="Cantidad_usuario">{{__('user quantity')}}:</label>
                            <input type="number" id="Cantidad_usuario" class="form-control" placeholder="{{__('Enter quantity')}}"  name="Cantidad_usuario" aria-label="" wire:model.defer="Cantidad_usuario" />
                            @error('Cantidad_usuario')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>



                        <div class="col-12 select-datacaminante">
                            <label class="form-label" for="role">{{__('Network Status')}}</label>
                            <select id="network_status_id" name="network_status_id" wire:model.defer="network_status_id" class="select2 form-select single-select" data-placeholder="{{__('Select a network status')}}...">
                                <option></option>
                                @foreach($NetworkStatus as $NetworkStatu)
                                <option value="{{$NetworkStatu->id}}">{{$NetworkStatu->name}}</option>
                                @endforeach
                            </select>
                            @error('network_status_id')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="Observaciones">{{__('Observations')}}:</label>

                            <textarea  id="Observaciones" cols="30" rows="10" class="form-control" placeholder="{{__('Enter your observation')}}" name="Observaciones" aria-label="" wire:model.defer="Observaciones" ></textarea>


                            @error('Observaciones')
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
                $('.select-datacaminante .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    dropdownParent: $('.select-datacaminante')
                });
            }
            $('.select-datacaminante .single-select').on('change', function (e) {
                livewire.emit('datacaminanteCreateChange', $(this).val(), $(this).attr('wire:model.defer'));
            });

            window.livewire.on('datacaminanteCreateHydrate',()=>{
                initUsersCreate();
            });
            livewire.emit('datacaminanteCreateChange', '', '');
        });
    </script>


</div>
