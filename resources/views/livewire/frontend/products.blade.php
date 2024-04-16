<div>
    <div class="container-xl flex-grow-1 container-p-y ligaequiposd">
        <div class="row  modocelularteams">
            <div class="col-md-12">
                <h1 class="fw-bold tituloequiposliga"><span class="tituloequiposliga ">{{__('Product')}}</span></h1>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-md-8"></div>
            <div class="col-md-4 py-3 text-end">
                <input type="search" class="form-control" placeholder="{{__('Product name')}}.." aria-controls="DataTables_Table_0" wire:model="query">
            </div>
        </div>
        <div class="row" style="max-width: 99%;">



            @forelse($products as $product)
                <div class="col-md-4 my-2">
                    <a href="{{ route('pedidos.show', ['store_slug' => $store->slug,'product_slug'=>$product->slug]) }}"
                       style="color: inherit">
                        <div class="card dsdsd team-card h-100">
                            <div class="card-body p-0">
                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-6">
                                        @if($product->image!=null
                                        )
                                            <div class="avatar-wrapper d-flex justify-content-center">
                                                <div class="avatar avatar-xxl rounded-circle bg-label-primary">
                                                    <img src="{{asset('uploads/productos/'.$product->image)}}" alt="Avatar" class="">
                                                </div>
                                            </div>
                                        @else
                                            @php
                                                $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                                                $imagenAleatoria = collect($imagenes)->random();
                                            @endphp

                                            <div class="avatar-wrapper d-flex justify-content-center">
                                                <div class="avatar avatar-teams rounded-circle bg-label-primary">

                                                    @if ($imagenAleatoria)
                                                        <img src="{{ asset('uploads/logoteams/' . $imagenAleatoria->getFilename()) }}" alt="Descripción de la imagen" style="width: 90% !important;height: 96% !important;">
                                                    @else
                                                        <p>No se encontraron imágenes.</p>
                                                    @endif

                                                    {{--  @foreach ($imagenes as $imagen)
                                                        <img src="{{ asset('uploads/logoteams/' . $imagen->getFilename()) }}" alt="Descripción de la imagen">
                                                    @endforeach  --}}

                                                    {{--  <span class="avatar-initial rounded-circle bg-label-primary">{{$team->name[0]}}</span>  --}}
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-6" >
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <span class="fw-semibold me-1" style="color: #00D38C;font-weight: bold !important;">{{__('Name')}}:</span>
                                                <span class="team-info" style="color: #d7d6d6;text-transform: uppercase;">{{ Str::limit($product->name, 15) }}</span>
                                            </li>

                                            <li class="mb-2">
                                                <span class="fw-semibold me-1" style="color: #00D38C;font-weight: bold !important;">{{__('Price')}}:</span>
                                                <span class="team-info" style="color: #d7d6d6;text-transform: uppercase;">{{ Str::limit($product->price, 15) }}</span>
                                            </li>

                                            <li class="mb-2">
                                                <span class="fw-semibold me-1" style="color: #00D38C;font-weight: bold !important;">{{__('Category')}}:</span>
                                                <span class="team-info" style="color: #d7d6d6;text-transform: uppercase;">{{ Str::limit($product->categoryproduct->name) }}</span>
                                            </li>
                                            
                                        
                                        
                                            {{--  <li class="mb-2 pt-1">
                                                <span class="fw-semibold me-1" style="color: #d4ff00;">{{__('Ver Equipo')}}:</span>

                                                <span class="team-info">{{$team->type==1?'Aficionado':'Profesional'}}</span>
                                            </li>  --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            @empty
                <div class="row h-100">
                    <div class="col-md-12 text-center" style="
                            margin-top: 23px;">
                        <h4>Aun no hay Equipos Disponibles dentro del torneo</h4>
                    </div>
                </div>
            @endforelse
                @if($products->total()!=0)
                    <div class="row mx-2 my-3">
                        <div class="col-md-5 text-sm-start" style="text-align: center">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $products->firstItem() }} {{__('to')}} {{ $products->lastItem() }} {{__('of')}} {{ $products->total() }} {{__('results')}}
                            </div>
                        </div>
                        <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                            @if ($products->hasPages())
                                {{$products->links('vendor.livewire.bootstrap')}}
                            @endif
                        </div>
                    </div>
                @endif
        </div>
    </div>
</div>
