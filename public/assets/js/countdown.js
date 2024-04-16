

 // Configura Moment.js para usar el idioma en español
 moment.locale('es');

// Obtener la fecha y hora del partido desde los datos del partido en línea
var fechaPartido = document.getElementById('cuenta-regresiva').getAttribute('data-fecha-partido'); // Comillas dobles aquí
var horaPartido =  document.getElementById('cuenta-regresiva').getAttribute('data-hora-partido'); // Comillas dobles aquí
var fechaHoraPartido = fechaPartido + 'T' + horaPartido;

// Crear un objeto Moment a partir de la fecha y hora del partido
var fechaHoraMoment = moment(fechaHoraPartido, 'YYYY-MM-DD HH:mm:ss');


// Configurar el contador regresivo utilizando la fecha y hora del partido
var countdown = simplyCountdown('#cuenta-regresiva', {
    year: fechaHoraMoment.year(),
        month: fechaHoraMoment.month() + 1,
        day: fechaHoraMoment.date(),
        hours: fechaHoraMoment.hours(),
        minutes: fechaHoraMoment.minutes(),
        seconds: fechaHoraMoment.seconds(),
    wordClass: {
    
        days: { singular: 'Día', plural: 'Días' }, // Cambio a español
        hours: { singular: 'hora', plural: 'horas' }, // Cambio a español
        minutes: { singular: 'minuto', plural: 'minutos' }, // Cambio a español
        seconds: { singular: 'segundo', plural: 'segundos' }, // Cambio a español
        pluralLetter: 's'
    },
    plural: true, //use plurals
	inline: false, //set to true to get an inline basic countdown like : 24 days, 4 hours, 2 minutes, 5 seconds
	inlineClass: 'simply-countdown-inline',
    enableUtc: false, // Desactivar el uso de UTC para tener en cuenta la zona horaria de Colombia
    onEnd: function() {
		// Cuando el tiempo se acabe, ocultar el div con el contador regresivo
        document.getElementById('cuenta-regresiva').style.display = 'none';
        document.getElementById('divinfotiempo').style.marginTop  = "8.6rem";

       // Mostrar la imagen correspondiente al estado del partido
       mostrarImagenSegunEstado();
	},
    refresh: 1000,
    sectionClass: 'simply-section',
    amountClass: 'simply-amount',
    wordClass: 'simply-word',
    zeroPad: false,
    countUp: false


});



   // Obtener el estado del partido desde el atributo de datos del elemento HTML
   var statusPartido = document.getElementById('estadospartidos').getAttribute('estadospartidos');;

   // Función para mostrar la imagen correspondiente según el estado del partido
   function mostrarImagenSegunEstado() {
       if (statusPartido === '1') { // Partido jugando
           document.getElementById('cuenta-regresiva').style.display = 'none'; //Ocultar el contador regresivo
           document.getElementById('infoTiempoAcabado').style.display = 'block';   // Mostrar el div con la información ver partido
           document.getElementById('textjugando').style.display = 'block';   // Mostrar el div con la información ver partido
           document.getElementById('textfinalizado').style.display = 'none';   // Mostrar el div con la información ver partido
           document.getElementById('textsuspendido').style.display = 'none';   // Mostrar el div con la información ver partido
           document.getElementById('textprogramado').style.display = 'none';   // Mostrar el div con la información ver partido

           document.getElementById('imgjugando').style.display = 'inline'; // Mostrar la imagen de partido jugando
           document.getElementById('imgfinalizado').style.display = 'none'; // Ocultar la imagen de partido en finalizado
           document.getElementById('imgsuspendido').style.display = 'none'; // Mostrar la imagen de partido suspendido
           document.getElementById('imgprogramado').style.display = 'none'; // Ocultar la imagen de partido en programado
       } else if (statusPartido === '2') { // Partido finalizado
        document.getElementById('cuenta-regresiva').style.display = 'none'; //Ocultar el contador regresivo
        document.getElementById('infoTiempoAcabado').style.display = 'block';   // Mostrar el div con la información ver partido
        document.getElementById('textjugando').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('textfinalizado').style.display = 'block';   // Mostrar el div con la información ver partido
        document.getElementById('textsuspendido').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('textprogramado').style.display = 'none';   // Mostrar el div con la información ver partido

        document.getElementById('imgjugando').style.display = 'none'; // Mostrar la imagen de partido jugando
        document.getElementById('imgfinalizado').style.display = 'inline'; // Ocultar la imagen de partido en finalizado
        document.getElementById('imgsuspendido').style.display = 'none'; // Mostrar la imagen de partido suspendido
        document.getElementById('imgprogramado').style.display = 'none'; // Ocultar la imagen de partido en programado
       } else if (statusPartido === '3') { // Partido Suspendido
        document.getElementById('cuenta-regresiva').style.display = 'flex'; //Ocultar el contador regresivo
        document.getElementById('infoTiempoAcabado').style.display = 'block';   // Mostrar el div con la información ver partido
        document.getElementById('infoTiempoAcabado').style.width = "100%";
        document.getElementById('imgsuspendido').style.marginTop = "-9px";
        document.getElementById('imgsuspendido').style.width = "43%";

        document.getElementById('textjugando').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('textfinalizado').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('textsuspendido').style.display = 'block';   // Mostrar el div con la información ver partido
        document.getElementById('textprogramado').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('divinfotiempo').style.marginTop  = "14.6rem";
        document.getElementById('imgjugando').style.display = 'none'; // Mostrar la imagen de partido jugando
        document.getElementById('imgfinalizado').style.display = 'none'; // Ocultar la imagen de partido en finalizado
        document.getElementById('imgsuspendido').style.display = 'inline'; // Mostrar la imagen de partido suspendido
        document.getElementById('imgprogramado').style.display = 'none'; // Ocultar la imagen de partido en programado
    } else if (statusPartido === '4') { // Partido Programado
       // document.getElementById('cuenta-regresiva').style.display = ''; Ocultar el contador regresivo
        document.getElementById('infoTiempoAcabado').style.display = 'block';   // Mostrar el div con la información ver partido

        document.getElementById('textjugando').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('textfinalizado').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('textsuspendido').style.display = 'none';   // Mostrar el div con la información ver partido
        document.getElementById('textprogramado').style.display = 'block';   // Mostrar el div con la información ver partido
        document.getElementById('divinfotiempo').style.marginTop  = "14.6rem";
        document.getElementById('imgjugando').style.display = 'none'; // Mostrar la imagen de partido jugando
        document.getElementById('imgfinalizado').style.display = 'none'; // Ocultar la imagen de partido en finalizado
        document.getElementById('imgsuspendido').style.display = 'none'; // Mostrar la imagen de partido suspendido
        document.getElementById('imgprogramado').style.display = 'inline'; // Ocultar la imagen de partido en programado
    }
   }

   // Llamar a la función inicialmente para mostrar la imagen correspondiente al estado actual
   mostrarImagenSegunEstado();

