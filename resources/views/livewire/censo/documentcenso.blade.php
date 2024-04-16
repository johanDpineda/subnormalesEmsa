<div>
    <form class="row g-3" wire:submit.prevent="save">


        <div class="col-12">
            <label class="form-label" for="file_name_censo">* {{__('census document')}}:</label>
            <input type="file" wire:model="file_name_censo" class="form-control">
            @error('file_name_censo')
            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
            @enderror
        </div>


        <div class="col-12 text-center">
            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="save" wire:click='save'>
                {{__('Save')}}</button>
            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean">
                {{__('Cancel')}}</button>
        </div>
</div>
