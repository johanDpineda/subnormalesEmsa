<div>

    <form class="row g-3" wire:submit.prevent="save">


        <div class="col-12">
            <label class="form-label" for="file_name_alcaldia">* {{__('Mayor Office Document')}}:</label>
            <input type="file" wire:model="file_name_alcaldia" class="form-control">
            @error('file_name_alcaldia')
            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="start_date">Fecha de Realización del Documento:</label>
            <input type="date" wire:model.defer="start_date" id="start_date" class="form-control">
            @error('start_date')
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
