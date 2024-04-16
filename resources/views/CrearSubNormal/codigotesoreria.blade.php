<div wire:ignore.self  class="modal fade" id="invoicecode"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-simple ">
        <div class="modal-content p-3 p-md-5">

            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Code Tesoreria')}}</h3>
                    <p class="text-muted">{{__('Complete the information para el codigo de la factura')}}</p>
                </div>




                @if($codefactura)
                    @livewire("crear-subnormal.code-tesoreria", ['codefactura' => $codefactura])
                @endif



            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}" defer></script>
<script>
    $(function () {
        window.initFilesEdit=()=>{
            // Select2
            $('.select-files-edit .single-select').select2({
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                allowClear: Boolean($(this).data('allow-clear')),
                dropdownParent: $('.select-files-edit')
            });
        }


        $('.select-files-edit .single-select').on('change', function (e) {
            livewire.emit('FilesShowChange', $(this).val(), $(this).attr('wire:model'))
        });

        window.livewire.on('FilesShowHydrate',()=>{
            initFilesEdit();
        });
        livewire.emit('FilesShowChange', '', '');
    });
</script>


