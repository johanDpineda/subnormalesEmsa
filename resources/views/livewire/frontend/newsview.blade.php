<div>
    <div class="ligaequiposd">

        <div class="row">
            <div class="col-md-8">
                <div class="row ">

                    @forelse ($newsviews as $newsview)
                        <div class="col-12 mb-4 news-item contnoticias ">
                            <div class="row">
                                <div class="col-4 diseñomovilnoticias">
                                    <a href="{{ route('noticias.show', ['store_slug' => $store->slug,'Noticias_slug'=>$newsview->slug]) }}">
                                        <div class="contenedornoticiasimagen">
                                            @if($newsview->image != null)
                                                <img src="{{ asset('uploads/news/' . $newsview->image) }}" alt="News Image" class="img-fluidnoticias">
                                            @else
                                                <img src="{{ asset('uploads/store/'.$store->image) }}" alt="Default Image" class="img-fluidnoticiasopacity">
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="col-8">
                                    <div class="contendorcontenidonoticias news-item">
                                        <div class="news-title">
                                            <h3><a href="{{ route('noticias.show', ['store_slug' => $store->slug,'Noticias_slug'=>$newsview->slug]) }}" style="
                                                color: #24ffe3;
                                            ">{{ $newsview->title }}</a></h3>
                                        </div>
                                        <h2><a href="{{ route('noticias.show', ['store_slug' => $store->slug,'Noticias_slug'=>$newsview->slug]) }}">{{ $newsview->header }}</a></h2>
                                        <p>{{ $newsview->subtitle }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty

                        <div class="mensaje-no-productos flicker-4">
                            <p>No hay Noticias</p>
                        </div>

                       
                    @endforelse


                </div>


                @if($newsviews->total()!=0)
                    <div class="row mx-2 my-3">
                        <div class="col-md-5 text-sm-start" style="text-align: center !important;">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $newsviews->firstItem() }} {{__('to')}} {{ $newsviews->lastItem() }} {{__('of')}} {{ $newsviews->total() }} {{__('results')}}
                            </div>
                        </div>

                        <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                            @if ($newsviews->hasPages())
                                {{$newsviews->links('vendor.livewire.pagination')}}
                            @endif
                        </div>

                    </div>

                @endif


            </div>
            <div class="col-md-4">


                <div class="col-md-9  my-3">
                    <label class="form-label" for="search">{{__('Search News')}}:</label>
                    <input type="search" class="form-control" placeholder="{{__('Search')}}.." aria-controls="DataTables_Table_0" wire:model="query">
                </div>


                <div id="cajanoticiasprincipales">

                    <section class="divnoticiasrecientes">
                        <h4 class="titlenewrecientes">
                            <span class="titlenewrecientes">Noticias Recientes</span>

                            @forelse ($newsviewsfive as $newsviewsfives)

                                <ul class="listnewrecientes">
                                    <li>
                                        <a href="{{ route('noticias.show', ['store_slug' => $store->slug,'Noticias_slug'=>$newsview->slug]) }}">
                                            {{ $newsviewsfives->header }}


                                        </a>
                                    </li>

                                </ul>

                            @empty
                                <div class="mensaje-no-productos flicker-4">
                                    <p>No hay Noticias Recientes</p>
                                </div>
                            @endforelse

                        </h4>

                    </section>

                 

                </div>

            </div>
        </div>



    </div>


</div>
