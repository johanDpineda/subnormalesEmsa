<div wire:ignore.self class="modal fade" id="gallery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" x-show="mostrarModal">
    <div class="modal-dialog modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Add mayor document')}}</h3>
                    <p class="text-muted">{{__('Complete the information to add the Alcaldia certificate file')}}</p>
                </div>
                <form class="row g-3" wire:submit.prevent="save">
                    <div class="col-12">
                        <label class="form-label" for="file_name_alcaldia">* {{__('Mayor Office Document')}}:</label>
                        <input type="file" wire:model="file_name_alcaldia" class="form-control">
                        @error('file_name_alcaldia')
                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                        @enderror
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.attr="disabled" wire:target="save" wire:click='save'>
                            {{__('Save')}}
                        </button>
                        <button type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean">
                            {{__('Cancel')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
