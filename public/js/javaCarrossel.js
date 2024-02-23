/**
 * Carrossel dos Filmes
 */

document.addEventListener('DOMContentLoaded', function () {
  const carousels = document.querySelectorAll('.filme__carousel');

  carousels.forEach((carousel) => {
    const prevBtn = carousel.querySelector('.prev');
    const nextBtn = carousel.querySelector('.next');
    const filmeItems = carousel.querySelectorAll('.filme__item');
    let currentIndex = 0;

    function showItem(index) {
      console.log('Showing item:', index);
      filmeItems.forEach((item, i) => {
        const offset = (i - index) * 100;
        item.style.transform = `translateX(${offset}%)`;
      });
    }

    nextBtn.addEventListener('click', function (event) {
      event.preventDefault();
      currentIndex = (currentIndex + 1) % filmeItems.length;
      showItem(currentIndex);
    });

    prevBtn.addEventListener('click', function (event) {
      event.preventDefault();
      currentIndex = (currentIndex - 1 + filmeItems.length) % filmeItems.length;
      showItem(currentIndex);
    });

    // Initial setup to remove empty spaces
    showItem(currentIndex);
  });
});

/**
 * Sessão Carrossel dos Itens
 */

document.addEventListener('DOMContentLoaded', function () {
  const carousels = document.querySelectorAll('.item__carousel');

  carousels.forEach((carousel) => {
    const prevBtn = carousel.querySelector('.prev');
    const nextBtn = carousel.querySelector('.next');
    const items = carousel.querySelectorAll('.item');
    let currentIndex = 0;

    function showItem(index) {
      console.log('Showing item:', index);
      items.forEach((item, i) => {
        const offset = (i - index) * 100;
        item.style.transform = `translateX(${offset}%)`;
      });
    }

    nextBtn.addEventListener('click', function (event) {
      event.preventDefault();
      currentIndex = (currentIndex + 1) % items.length;
      showItem(currentIndex);
    });

    prevBtn.addEventListener('click', function (event) {
      event.preventDefault();
      currentIndex = (currentIndex - 1 + items.length) % items.length;
      showItem(currentIndex);
    });

    // Initial setup to remove empty spaces
    showItem(currentIndex);
  });
});