<div>
    <div wire:ignore.self class="modal fade" id="maps" tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple ">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Geolocation')}}</h3>

                    </div>
                    <div class="card ">
                        @if ($selectedCaminante)
                            <iframe src='https://www.google.com/maps?q={{ $selectedCaminante->latitude ?? "" }},{{ $selectedCaminante->longitude ?? "" }}&hl=es;z=14&output=embed' frameborder="0" width="450" height="450" class="cardmap-movil"></iframe>

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
