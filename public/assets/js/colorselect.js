var customSelects = document.querySelectorAll('.custom-selectvbv');

customSelects.forEach(function(customSelect) {
  var select = customSelect.querySelector('select');

  select.addEventListener('change', function() {
    var selectedOption = select.options[select.selectedIndex];
    customSelect.setAttribute('data-selected', selectedOption.text);
  });
});
