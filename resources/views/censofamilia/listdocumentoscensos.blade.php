<div wire:ignore.self  class="modal fade" id="viewcenso"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-simple ">
        <div class="modal-content p-3 p-md-5">

            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{__('Viewing documents')}}</h3>

                </div>
                <div class="container mt-5">

                    <div class="row">


                        @if(empty($doccenso))
                            <div class="alert alert-warning" role="alert">
                                No hay documento disponible del censo.
                            </div>
                        @else
                            <div class="col-md-12 mb-3 cardmovile">
                                <div class="card estiloscardresulocion">
                                    <div class="card-body">

                                        @php
                                            $extension = pathinfo($doccenso, PATHINFO_EXTENSION);
                                            $iconClass = '';
                                            $iconColor = '';

                                            // Mapea las extensiones a los iconos de Font Awesome y colores
                                            if (in_array($extension, ['pdf', 'xls', 'xlsx', 'docx'])) {
                                                // Extensiones de documentos (PDF, Excel, DOCX)
                                                if ($extension === 'pdf') {
                                                    $iconClass = 'fa-sharp fa-solid fa-file-pdf fa-xl';
                                                    $iconColor = '#ec5757'; // Rojo para PDF
                                                } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                                    $iconClass = 'fa-file-excel';
                                                    $iconColor = '#08a867'; // Verde para Excel
                                                } elseif ($extension === 'docx') {
                                                    $iconClass = 'fa-file-word';
                                                    $iconColor = '#3fa0e7'; // Azul para DOCX
                                                }
                                            } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                                                // Extensiones de imágenes (JPG, JPEG, PNG, GIF, BMP)
                                                $iconClass = 'fa-image';
                                                $iconColor = '#6a6a75'; // Azul para imágenes
                                            } else {
                                                $iconClass = 'fa-file'; // Icono predeterminado
                                                $iconColor = '#5c5f63'; // Color predeterminado
                                            }

                                        @endphp

                                        <h5 class="card-titleresoluciones titlemovile" style="font-weight: bold;color: black;">

                                            Documento Censo
                                        </h5>
                                        <div class="row">
                                            <div class="file-xinfo col-8" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">

                                                <div class="file-dated mb-3" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                                    <span class="textotituloresolucion textdateinmovil" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px" style="font-weight: bold;">
                                                        Fecha de creacion
                                                    </span>
                                                    <span class="textoindicativo">{{ $created_at_censo ? \Carbon\Carbon::parse($created_at_censo)->format('d/m/Y') : '' }}</span>
                                                </div>




                                                <div class="file-dated" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                                    <span class="textotituloresolucion textnamedocmovil" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px" style="font-weight: bold;">
                                                        Nombre del Documento
                                                    </span>
                                                    <span class="textoindicativo">{{ $doccenso }}</span>
                                                </div>

                                            </div>

                                            <div class="col-4">
                                                <div style="width: 100%;position: relative;">
                                                    <i class="fas {{ $iconClass }} imagemovile" style="color: {{ $iconColor }};float: right;font-size: 5em;"></i>

                                                </div>

                                            </div>

                                        </div>



                                        <p class="card-text">
                                            <!-- Puedes agregar más información sobre el documento aquí si lo deseas -->
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6 btnmovil">

                                                <a href="{{ asset('uploads/documentcenso/'.$doccenso) }}" download class="btn btn-primary btn-block" style="color: white;background-color: #3358ff;font-weight: bold;/* border-color: currentColor;">
                                                    Descargar
                                                    <div style="margin-left: 5px">
                                                        <i class="fa-sharp fa-solid fa-file-arrow-down fa-lg" style="color: #ffffff;"></i>
                                                    </div>
                                                </a>

                                            </div>

                                            <div class="col-md-6">
                                                @if (in_array($extension, ['pdf', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                    @if ($extension === 'pdf')
                                                        <!-- Mostrar botón de visualización solo para archivos PDF -->
                                                        <a class="btn btn-primary btn-block" onclick="openPdfModal('{{ asset('uploads/documentcenso/'.$doccenso) }}')" style="color: white;background-color: #3358ff;font-weight: bold;">
                                                            Visualizar
                                                            <div style="margin-left: 5px">
                                                                <i class="fa-sharp fa-solid fa-eye fa-lg" style="color: #ffffff;"></i>
                                                            </div>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>



                                        </div>
                                    </div>






                                </div>
                            </div>
                        @endif











                    </div>
                </div>

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

<script>
    function openPdfModal(pdfPath) {
        // Establecer la ruta del PDF en el modal
        var pdfEmbed = document.getElementById("pdfEmbed");
        pdfEmbed.setAttribute("src", pdfPath);

        // Abrir el modal
        var pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'));
        pdfModal.show();

        // Cerrar el modal cuando se haga clic en el botón de cerrar
        var closeButton = document.querySelector('#pdfModal .btn-close');
        closeButton.addEventListener('click', function() {
            pdfModal.hide();
        });



    }



</script>


