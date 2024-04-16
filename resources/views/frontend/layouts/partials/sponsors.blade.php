<link rel="stylesheet" href="{{asset('frontend/css/flickity.css')}}">
<script src="{{asset('frontend/js/flickity.js')}}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if (isset($advertisements_one) && !empty($advertisements_one))
            <div id="sponsor_carousel" class="sponsors carousel " data-flickity='{ "freeScroll": true, "wrapAround": true, "autoPlay": 2000}'>
                @foreach ( $advertisements_one as $advertisement  )
                <div class="carousel-cell">
                    <a href="{{ $advertisement->url }}"  target="_blank">
                        <img src="{{asset('uploads/advertisements/'.$advertisement->image_path) }}" >
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
