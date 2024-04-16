<div>
    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple ">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('walking data')}}</h3>
                        <p class="text-muted">{{__('Complete the information to edit a zone')}}</p>
                    </div>
                    <form class="row g-3" wire:submit.prevent="save">

                        <div class="col-12">
                            <label class="form-label" for="code_macromedidor">{{__('macrometer code')}}:</label>
                            <input type="text" id="code_macromedidor" class="form-control" placeholder="" name="code_macromedidor" aria-label="" wire:model.defer="code_macromedidor" />
                            @error('code_macromedidor')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="update" wire:click='update'>
                                {{__('Update')}}</button>
                                <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                    {{__('Cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
   

</div>
