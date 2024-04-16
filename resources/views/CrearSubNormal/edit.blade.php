<div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-simple ">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('subnormal sector')}}</h3>
                    <p class="text-muted">{{__('Edit industry information')}}</p>
                </div>
                <form class="row g-3" wire:submit.prevent="storeedit">

                    <div class="col-12">
                        <label class="form-label" for="sector_name">{{__('Sector name')}}:</label>
                        <input type="text" id="sector_name" class="form-control" placeholder="" name="sector_name" aria-label="" wire:model.defer="sector_name" />
                        @error('sector_name')
                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                        @enderror
                    </div>



                    <div class="col-12">
                        <label class="form-label" for="phone">{{__('Leaders phone')}}:</label>
                        <input type="text" id="phone" class="form-control" placeholder="" name="phone" aria-label="" wire:model.defer="phone" />
                        @error('phone')
                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="address">{{__('Address')}}:</label>
                        <input type="text" id="address" class="form-control" placeholder="" name="address" aria-label="" wire:model.defer="address" />
                        @error('address')
                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                        @enderror
                    </div>


                    <div class="col-12 select-crearsubnormaledit">
                        <label class="form-label" for="role">{{__('Municipalities')}}</label>
                        <select id="municipalities_id" name="municipios_zone_id" wire:model.defer="municipios_zone_id" class="select2 form-select single-select" data-placeholder="{{__('select a municipality')}}...">
                            <option></option>
                            @foreach($municipily  as $municipilys)
                            <option value="{{$municipilys->id}}">{{$municipilys->name}}</option>
                            @endforeach
                        </select>
                        @error('municipios_zone_id')
                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                        @enderror
                    </div>




                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="update" wire:click='update'>
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
                $('.select-crearsubnormaledit .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    dropdownParent: $('.select-crearsubnormaledit')
                });
            }
            $('.select-crearsubnormaledit .single-select').on('change', function (e) {
                livewire.emit('sectorsubnormalCreateChangeedit', $(this).val(), $(this).attr('wire:model.defer'));
            });



            window.livewire.on('sectorsubnormalCreateHydrateedit',()=>{
                initUsersCreate();
            });
            livewire.emit('sectorsubnormalCreateChangeedit', '', '');
        });
    </script>

