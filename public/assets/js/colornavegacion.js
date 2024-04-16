document.addEventListener('click', function(event) {
    var barraNavegacion = document.getElementById('barra-navegacion');
    var elementosLi = barraNavegacion.getElementsByTagName('li');

    // Eliminar la clase 'selected' de todos los elementos <li>
    for (var i = 0; i < elementosLi.length; i++) {
      elementosLi[i].classList.remove('selected');
    }

    // Verificar si se hizo clic dentro de la barra de navegación
    if (barraNavegacion.contains(event.target)) {
      // Agregar la clase 'selected' al elemento <li> que se hizo clic
      if (event.target.tagName === 'A') {
        event.target.parentElement.classList.add('selected');
      }
    }
  });
