$(document).ready(function() {
    $('#miTabla').on('scroll', function() {
      var $this = $(this);
      var scrollLeft = $this.scrollLeft();
      var scale = 1 - (scrollLeft / 1000); // Ajusta este valor según la cantidad de compresión deseada

      // Aplicar la escala a las celdas de la tabla
      $this.find('td').css('transform', 'scale(' + scale + ')');
    });
  });
  