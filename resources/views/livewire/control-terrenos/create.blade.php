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
                    <form class="row g-3" wire:submit.prevent="save" id="formAuthentication" >

                        <div class="col-12">
                            <label class="form-label" for="code_macromedidor">{{__('macrometer code')}}:</label>
                            <input type="text" id="code_macromedidor" class="form-control" placeholder="" name="code_macromedidor" aria-label="" wire:model.defer="code_macromedidor" />
                            @error('code_macromedidor')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12 select-controterreno">
                            <label class="form-label" for="role">{{__('Walking Information')}}</label>
                            <select id="data_caminante_id" name="data_caminante_id" wire:model.defer="data_caminante_id" class="select2 form-select single-select" data-placeholder="{{__('Select a Walking Information')}}...">
                                <option></option>
                                @foreach($datacaminante  as $option)
                                <option value="{{$option->id}}"><h4 style="font-weight: 900; background-color:rgb(3, 3, 3)">{{__('Leader Name')}}</h4> : {{$option->name}}</option>
                                @endforeach
                            </select>
                            @error('data_caminante_id')
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
                $('.select-controterreno .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    dropdownParent: $('.select-controterreno')
                });
            }
            $('.select-controterreno .single-select').on('change', function (e) {
                livewire.emit('ControlterrenoCreateChange', $(this).val(), $(this).attr('wire:model.defer'));
            });

            window.livewire.on('controlterrenoCreateHydrate',()=>{
                initUsersCreate();
            });
            livewire.emit('ControlterrenoCreateChange', '', '');
        });
    </script>



</div>
