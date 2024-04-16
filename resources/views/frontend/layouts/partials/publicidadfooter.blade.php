<link rel="stylesheet" href="{{asset('frontend/css/flickity.css')}}">
<script src="{{asset('frontend/js/flickity.js')}}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if (isset($advertisements_two) && !empty($advertisements_two))
            <div id="" class="sponsors_footer carousel" data-flickity='{ "freeScroll": true, "wrapAround": true, "autoPlay": true, "cellAlign": "left" }'>

                @foreach ( $advertisements_two as $advertisementwo )
                    <div class="carousel-cell">
                        <a href="{{ $advertisementwo->url }}"  target="_blank">
                            <img src="{{asset('uploads/advertisements/'.$advertisementwo->image_path) }}" >
                        </a>
                    </div>
                @endforeach
            </div>
            @else
            <p class="nohaypartidomovil">No hay Publicidad</p>
            @endif
        </div>
    </div>
</div>
