<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="light-style layout-navbar-fixed layout-menu-fixed"
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










{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.4.0/css/flag-icon.min.css">--}}

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css">--}}


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

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/tabler-icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icons.css')}}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" class="template-customizer-core-css" href="{{asset('assets/vendor/css/rtl/core.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css')}}"
          class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css')}}"/>


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

    <!-- Vendor Style -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>

    <link rel="stylesheet" href="{{asset('assets/css/imageuser.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/indicadoresDocumentos.css')}}"/>
    <script src="{{asset('assets/js/tablas.js')}}"></script>


    <!-- Summernote -->
  {{--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">




    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>


    <script src="{{asset('assets/vendor/js/template-customizer.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places,drawing,geometry"></script>
{{--    <link rel="stylesheet" href="{{ asset('js/select2.min.css') }}">--}}
    @livewireStyles
</head>
<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('layouts.sidebar')
        <!-- Layout container -->
        <div class="layout-page">
            @include('layouts.nav')
            <div class="content-wrapper">
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>


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
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>--}}
{{--<script>--}}
{{--    document.addEventListener("DOMContentLoaded", function() {--}}
{{--        var tooltips = new bootstrap.Tooltip(document.querySelectorAll('[data-bs-toggle="tooltip"]'), {--}}
{{--            trigger: 'hover', // Puedes especificar el evento de activación--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
<!-- Page JS -->
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
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
<script src="{{asset('assets/js/ui-popover.js')}}"></script>


<!-- Summernote -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>








@stack('scripts')



@livewireScripts

<script>
    //Hecho

    Livewire.on('alert', function (message, modal) {

    // Hide preloader y mostrar alerta después de 1 segundo
    Swal.fire({
            title: 'Hecho!',
            text: message,
            icon: 'success',
            showConfirmButton: false // También oculta el botón OK en el mensaje de alerta
        });

    $(modal).modal('hide'); // Oculta el modal
});



Livewire.on('mostrarPreloader', function (message, modal) {
    // Crear una instancia de Swal sin mostrarla
    const preloader = Swal.mixin({
        title: 'Espere porfavor, Se estan enviado los correos...',
        showConfirmButton: false
    });

    // Mostrar la animación de carga
    preloader.showLoading();

    // Hide preloader y mostrar alerta después de 1 segundo
    setTimeout(function() {
        preloader.close(); // Oculta el preloader
        Swal.fire({
            title: 'Hecho!',
            text: message,
            icon: 'success',
            showConfirmButton: false // También oculta el botón OK en el mensaje de alerta
        });

        $(modal).modal('hide'); // Oculta el modal
    }, 1000);
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

<script>
    function marcarNotificacionYRecargarcaminante(notificacionIddatoscaminante) {
        // Lógica para marcar la notificación como leída (puedes incluir tu lógica aquí)

        // Recargar la página después de un breve retraso
        setTimeout(function() {
            location.reload();
        }, 500); // Recarga después de 500 milisegundos (0.5 segundos), ajusta el valor según sea necesario
    }
</script>

<script>
    function marcarNotificacionYRecargarmacro(notificacionIdcodemacro) {
        // Lógica para marcar la notificación como leída (puedes incluir tu lógica aquí)

        // Recargar la página después de un breve retraso
        setTimeout(function() {
            location.reload();
        }, 500); // Recarga después de 500 milisegundos (0.5 segundos), ajusta el valor según sea necesario
    }
</script>

<script>
    function marcarNotificacionYRecargarnewsubnormal(notificacionIdnewsubnormal) {
        // Lógica para marcar la notificación como leída (puedes incluir tu lógica aquí)

        // Recargar la página después de un breve retraso
        setTimeout(function() {
            location.reload();
        }, 500); // Recarga después de 500 milisegundos (0.5 segundos), ajusta el valor según sea necesario
    }
</script>

<script>
    function marcarNotificacionYRecargardocuments(notificacionIddocuments) {
        // Lógica para marcar la notificación como leída (puedes incluir tu lógica aquí)

        // Recargar la página después de un breve retraso
        setTimeout(function() {
            location.reload();
        }, 500); // Recarga después de 500 milisegundos (0.5 segundos), ajusta el valor según sea necesario
    }
</script>

<script>
    function marcarNotificacionYRecargarfactura(notificacionIdcodefactura) {
        // Lógica para marcar la notificación como leída (puedes incluir tu lógica aquí)

        // Recargar la página después de un breve retraso
        setTimeout(function() {
            location.reload();
        }, 500); // Recarga después de 500 milisegundos (0.5 segundos), ajusta el valor según sea necesario
    }
</script>







</body>
</html>
