const slider = document.querySelector('.slidessdr');
const prevBtn = document.querySelector('.prev-btndd');
const nextBtn = document.querySelector('.next-btndd');
const currentMonthLabel = document.getElementById('current-month');

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let currentDate = new Date();

prevBtn.addEventListener('click', () => {
  currentDate.setDate(currentDate.getDate() - 7);
  updateCarousel();
});

nextBtn.addEventListener('click', () => {
  currentDate.setDate(currentDate.getDate() + 7);
  updateCarousel();
});

function updateCarousel() {
  slider.innerHTML = '';

  const daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];

  const startDate = new Date(currentDate);
  startDate.setDate(startDate.getDate() - startDate.getDay());

  const endDate = new Date(startDate);
  endDate.setDate(endDate.getDate() + 6);

  const startMonth = startDate.toLocaleString('es-ES', { month: 'long' });
  const endMonth = endDate.toLocaleString('es-ES', { month: 'long' });

  currentMonthLabel.textContent = `${startMonth} - ${endMonth} ${currentYear}`;

  let currentDay = new Date(startDate);

  for (let i = 0; i < 7; i++) {
    const dayElement = document.createElement('a');
    dayElement.classList.add('slidegb');
    dayElement.href = '#'; // Agregar un enlace "#" temporalmente

    if (currentDay.toDateString() === currentDate.toDateString()) {
      dayElement.classList.add('current-day');
    }

    dayElement.addEventListener('click', (event) => {
      event.preventDefault(); // Evitar el comportamiento predeterminado de navegación
      // Aquí puedes agregar el código para abrir el enlace deseado
      // por ejemplo: window.location.href = 'tu_enlace.html';
    });

    dayElement.textContent = `${daysOfWeek[i]} ${currentDay.getDate()}`;

    slider.appendChild(dayElement);
    currentDay.setDate(currentDay.getDate() + 1);
  }

  const prevWeekDays = slider.querySelectorAll('.current-day');
  prevWeekDays.forEach(day => day.classList.remove('current-day'));

  const currentDayElement = slider.querySelector(`a:nth-child(${currentDate.getDay() + 1})`);
  currentDayElement.classList.add('current-day');
}

updateCarousel();
