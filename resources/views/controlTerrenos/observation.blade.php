<div>
    <div wire:ignore.self class="modal fade" id="observaciones" tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple ">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('observation')}}</h3>
                        
                    </div>
                    <div class="card">
                        @if ($selectedCaminanteobservaciones)
                            <textarea  cols="30" rows="10" disabled>{{$selectedCaminanteobservaciones->Datoscaminante->Observaciones}}</textarea>
                        @else
                            <p>{{ __('No coordinates available') }}</p>
                        @endif
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
   


</div>
