<div>
        <div class="ligaequiposd">

            <div class="row py-3">

                <div class="col-md-12 text-sm-start">
                    <button type="reset" class="btn btn-primary" wire:click="resetFilter">Limpiar filtro</button>
                </div>

                <div class="col-6 col-md-3">
                    <label class="form-label" for="date">{{__('Date')}}:</label>
                    <input type="date" id="date" name="date" placeholder="{{__('Search')}}.." wire:model="date" class="form-control">
                </div>

                <div class="col-6 col-md-3">
                    <label class="form-label" for="search">{{__('Search document')}}:</label>
                    <input type="search" class="form-control" placeholder="{{__('Search')}}.." aria-controls="DataTables_Table_0" wire:model="query">
                </div>

            </div>

            <div class="row">
                @forelse ($documentos as $documento)
                    <div class="col-md-4">
                        <div class="card estiloscardresulocion">
                            <div class="card-body">
                                @php
                                    $extension = pathinfo($documento->file_name, PATHINFO_EXTENSION);
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

                                <h3 class="card-titleresoluciones">

                                    {{ $documento->file_name_document }}
                                </h3>
                                <div class="row">
                                    <div class="file-xinfo col-8" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                        <div class="file-desc" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">

                                        </div>
                                        <div class="file-size" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                            <span class="textotituloresolucion" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                                Tamaño:
                                            </span>
                                            <span class="textoindicativo">{{ $documento->file_size }} KB</span>
                                        </div>
                                        <div class="file-hits" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                            <span class="textotituloresolucion" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                                Tipo:
                                            </span>
                                            <span class="textoindicativo">{{ $documento->file_type }}</span>
                                        </div>
                                        <div class="file-dated" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                            <span class="textotituloresolucion" speechify-initial-font-family="Roboto, sans-serif" speechify-initial-font-size="13px">
                                                Fecha de creacion:
                                            </span>
                                            <span class="textoindicativo">{{ $documento->created_at->format('d/m/Y') }}</span>
                                        </div>

                                    </div>

                                    <div class="col-4">
                                        <div style="width: 100%;position: relative;">
                                            <i class="fas {{ $iconClass }}" style="color: {{ $iconColor }};float: right;font-size: 5em;"></i>
                                        </div>

                                    </div>

                                </div>



                                <p class="card-text">
                                    <!-- Puedes agregar más información sobre el documento aquí si lo deseas -->
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ asset('uploads/leagues/files/'.$documento->file_name) }}" class="btn btn-primary btn-block" download style="color: black;background-color: #d4ff00;font-weight: bold;border-color: currentColor;">Descargar<div style="margin-left: 5px"><i class="fa-sharp fa-solid fa-file-arrow-down fa-lg" style="color: #111212;"></i></div>  </a>
                                @php
                                    $extension = pathinfo($documento->file_name, PATHINFO_EXTENSION);

                                    // Verificar si la extensión es .pdf o una extensión de imagen
                                    if ($extension === 'pdf' || in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                                        echo '<a class="btn  btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#animationModaldoc' . $documento->id . '" style="color: black;background-color: #d4ff00;font-weight: bold;border-color: currentColor;">Abrir Documento<div style="margin-left: 5px"><i class="fa-sharp fa-solid fa-eye fa-lg" style="color: #000000;"></i></div></a>';
                                    }
                                @endphp
                            </div>






                        </div>
                    </div>
                    @include('frontend.modalvisualizarDoc.index')
                @empty
                    <tr class="odd">
                        <td valign="top" colspan="12" class="dataTables_empty text-center">No hay Documentos</td>
                    </tr>
                @endforelse

                @if($documentos->total()!=0)
                    <div class="row mx-2 my-3">
                        <div class="col-md-5 text-sm-start" style="text-align: center !important;">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $documentos->firstItem() }} {{__('to')}} {{ $documentos->lastItem() }} {{__('of')}} {{ $documentos->total() }} {{__('results')}}
                            </div>
                    </div>
                    <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                        @if ($documentos->hasPages())
                            {{$documentos->links('vendor.livewire.bootstrap')}}
                        @endif
                    </div>
                    </div>
                @endif
            </div>

        </div>


</div>
