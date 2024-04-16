<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="layout-navbar-fixed dark-style layout-menu-fixed"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="{{ asset('/assets') . '/' }}"
      data-template="vertical-menu-template"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/faviconlogo-emsa.png')}}"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">



<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@100&family=Rubik:wght@300&display=swap" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/tabler-icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icons.css')}}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" class="template-customizer-core-css" href="{{asset('assets/vendor/css/rtl/core.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core-dark.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default-dark.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default-dark.css')}}"/>


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}"/>
    <link rel="stylesheet"
          href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}"/>

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}"/>

    <!-- Summernote -->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/css/listastats.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/totalequiposliga.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/menuapp.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/perfiljugador.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/resumenpartido.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/pantallacargue.css')}}"/>

    <link rel="stylesheet" href="{{asset('assets/css/scroll.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/bannerfutbol.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/publicidaddiseno.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/botonmichat.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/fullscreen.css')}}"/>

    <!-- Vendor Style -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>
    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    {{--    <script src="{{asset('assets/vendor/js/template-customizer.js')}}"></script>--}}
    <script src="{{asset('assets/js/config.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/css/estilosfli.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/stores.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/estilosequipos.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/tablagoleadores.css')}}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <!-- abel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" rel="stylesheet"/>


    <link rel="stylesheet" href="https://unpkg.com/flickity-fullscreen@2/fullscreen.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-fhfFGN2uQ93oaRFFVzvqb2Tz6wr8EyxN7TS0MqQNpsVMfF4Vdh1PBeVyfRpbMBu5nOuZV6n8ZvC1WXhRGVdXNw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places,drawing,geometry"></script>
    @livewireStyles
</head>
<body>
@include('frontend.layouts.partials.preload')



@if(!Route::is('frontend.index'))
@include('frontend.layouts.navbar')

@endif

@yield('content')
@if(!Route::is('redsocial.view') && !Route::is('frontend.index'))
    @include('frontend.layouts.partials.menuapp')

    @include('frontend.layouts.partials.publicidadfooter')
    {{--  @include('frontend.layouts.partials.botonMichat')  --}}
    @include('frontend.layouts.partials.botonMichat')

    @include('frontend.layouts.footer')
@endif






<script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>

<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>

<script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

<script src="{{asset('assets/vendor/js/menu.js')}}"></script>



<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>

<!-- Page JS -->
{{--<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>--}}
<!-- Vendor Scripts -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>

<script src="{{asset('assets/js/flickity.pkgd.min.js')}}"></script>
<script src="{{asset('assets/js/flickity.pkgd.js')}}"></script>
<script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="/path/to/jquery.countdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="{{asset('assets/js/highcharts.js')}}"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{asset('assets/js/carrusel.js')}}"></script>
<script src="{{asset('assets/js/carruselautomatico.js')}}"></script>
<script src="{{asset('assets/js/carruseldias.js')}}"></script>
<script src="{{asset('assets/js/selectgrupos.js')}}"></script>
<script src="{{asset('assets/js/simplyCountdown.min.js')}}"></script>
<script src="{{asset('assets/js/countdown.js')}}"></script>

<script src="{{asset('assets/js/canchamapa.js')}}"></script>

<script src="{{asset('assets/js/jquery.hislide.js')}}"></script>
<script>
    $('.slide').hiSlide();
</script>




<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="{{asset('assets/js/colorselect.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simply-countdown@2.5.0/dist/simplycountdown.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://unpkg.com/flickity-fullscreen@2/fullscreen.js"></script>



<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
{{--Style Frontend--}}
@livewireScripts
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            "@0.00": {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            "@0.75": {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            "@1.00": {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            "@1.50": {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        }
    });
</script>






<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<script type="text/javascript">

    $('.slick-trackmn').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: $('.next'),
        prevArrow: $('.prev'),
        centerMode: true,
        focusOnSelect: true,


        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

</script>





<script type="text/javascript">

    $('.slick-trackmnv2').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: $('.next'),
        prevArrow: $('.prev'),

        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

</script>

<script type="text/javascript">
    $('.carouselnoticias').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear'
      });
</script>


<script>
    document.getElementById('dropdown').addEventListener('change', function () {
        var selectedOption = this.value;
        var rows = document.querySelectorAll('#tabla-informacion tbody tr');
        var mensaje = document.getElementById('mensaje');
        var tablaInformacion = document.getElementById('tabla-informacion');

        if (selectedOption === '') {
            rows.forEach(function (row) {
                row.style.display = 'none';
            });
            mensaje.style.display = 'block';
            tablaInformacion.style.display = 'none';
        } else {
            rows.forEach(function (row) {
                row.style.display = 'none';
                mensaje.style.display = 'block';

                if (row.getAttribute('data-id') === selectedOption) {
                    row.style.display = '';
                }
            });
            mensaje.style.display = 'none';
            tablaInformacion.style.display = '';
        }
    });


</script>

<!-- Tu código JavaScript pantalla cargue-->
<script>
    // Mostrar pantalla de carga
    function showLoading() {
        $('.loading-overlay').show();
    }

    // Ocultar pantalla de carga
    function hideLoading() {
        $('.loading-overlay').hide();
    }

    // Ejemplo de cómo utilizarlo (por ejemplo, en una solicitud AJAX)
    $(document).ready(function () {
        showLoading();

        $.ajax({
            url: '/tu-ruta-ajax',
            type: 'GET',
            success: function (data) {
                // Procesar datos recibidos
                // ...

                hideLoading();
            },
            error: function () {
                hideLoading();
            }
        });
    });
</script>


    <script>
        // JavaScript para aplicar estilos condicionales
        const containerpartidosprogramados = document.getElementById('containerpartidosprogramados');
        const items = containerpartidosprogramados.querySelectorAll('.partidosprogramdos');

        if (items.length === 1) {
            containerpartidosprogramados.classList.add('center-one-item');
        } else if (items.length >= 2) {
            containerpartidosprogramados.classList.add('multiple-items');
        }
    </script>


    <script>
        // JavaScript para aplicar estilos condicionales
        const nocontainerpartidosprogramados = document.getElementById('nocontainerpartidosprogramados');
        const noitems = nocontainerpartidosprogramados.querySelectorAll('.nopartidosprogramdos');

        if (noitems.length === 1) {
            nocontainerpartidosprogramados.classList.add('center-one-item');
        } else if (noitems.length >= 2) {
            nocontainerpartidosprogramados.classList.add('multiple-items');
        }
    </script>




  <!-- Incluir la librería countdown.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js"></script>



  <script type="text/javascript">

    $('.carruselpublicidad').slick({

        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows:false,
        centerMode: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

</script>


<script>
    $(document).ready(function () {
        $('.boton-transparente').on('click', function () {
            var targetModal = $(this).data('target');
            $(targetModal).modal('show');
        });
    });
</script>


<script type="text/javascript">



$('.for_slick_slider_noticias').slick({
        infinite:true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows:false,
        autoplay: true,
        autoplaySpeed: 2000,
        dots:false,
        centerMode: true,
        centerPadding: '60px',
        
     
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 3
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
    });







</script>

<script type="text/javascript">

    $('.for_slick_slider_prendas').slick({
        infinite:true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows:false,
        autoplay: true,
        autoplaySpeed: 2000,
        dots:false,
        centerMode: true,
        centerPadding: '60px',
        
     
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 3
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
    });

</script>

<script type="text/javascript">

    $('.multiple-items').slick({
        
        speed: 300,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-angle-left" style="color: #ffffff;"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i> </button>',
        responsive: [
            {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
            },
            {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
            },
            {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
            }
        ]
      });

</script>

<script type="text/javascript">

    $('.multiple-items-category').slick({
        
       
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
       
        prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-angle-left" style="color: #ffffff;"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i> </button>',
        responsive: [
            {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
            },
            {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
            },
            {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
            }
        ]
      });

</script>

<script>
    //Hecho

    Livewire.on('alert', function (message, modal) {
        Swal.fire(
            {
                title: 'Hecho!',
                text: message,
                icon: 'success',
                showCancelButton: false,
            }
        );

        $(modal).modal('hide');//hide/show
    });
    //Seguro?
    Livewire.on('deleteDevice', deviceId => {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Esta seguro?',
            text: "Este cambio no podra revertirse!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('show-devices', 'delete', deviceId)
                swalWithBootstrapButtons.fire(
                    'Eliminado!',
                    'El elemento seleccionado ha sido eliminado.',
                    'success'
                )
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'No se aplicaran los cambios',
                    'error'
                )
            }
        })
    });

    Livewire.on('eliminarOrganizador', () => {
        Swal.fire({
            title: 'Eliminado',
            text: 'El elemento seleccionado ha sido eliminado.',
            icon: 'success',
            showCancelButton: false,
            timer: 1500, // Cambia el valor si deseas que el mensaje se muestre durante más tiempo
            timerProgressBar: true,
            onClose: () => {
                // Aquí puedes realizar cualquier acción adicional después de que se muestre el mensaje
            }
        });
    });
</script>










<!-- Incluir la librería countdown.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js"></script>


</body>


</html>
