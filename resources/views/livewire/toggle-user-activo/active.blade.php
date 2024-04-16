<div>
    <label for="toggleActivo">
        <input type="checkbox" wire:click="toggleActivo" wire:model="activo" id="toggleActivo">
        <span>{{ $activo ? 'Activo' : 'Inactivo' }}</span>
    </label>
</div>
