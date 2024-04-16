<div>
    <div class="infoequipoliga">
    
        <div class="container">
          <div class="row">
          
            <div class="col-md-6">
  
              @if($producto->image!=null)
                <img src="{{asset('uploads/productos/'.$producto->image) }}" class="img-fluid ">
                @else
  
                    @php
                        $imagenes = File::allFiles(public_path('uploads/logoteams/'));
                        $imagenAleatoria = collect($imagenes)->random();
                    @endphp
  
                    @if ($imagenAleatoria)
                        <img src="{{ asset('uploads/logoteams/' . $imagenAleatoria->getFilename()) }}" alt="Descripción de la imagen"  class="img-fluid modecelteamsshow">
                    @else
                        <p>No se encontraron imágenes.</p>
                    @endif
  
                    {{--  <img src="{{asset('assets/img/favicon/favicon.png') }}" alt="Avatar"
                        class="img-fluid modecelteamsshow" >  --}}
                @endif
  
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#enviarpedido{{ $producto->id }}">Mi Botónlkkl</button>
  
            </div>
  
            <div class="col-md-6">

             
  
            </div>
  
          </div>
  
  
        </div>
       
        {{-- @include('frontend.modalPedidos.index') --}}
  
        
      </div>
    
    
    
</div>
