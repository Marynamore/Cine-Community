const itemCarousel = document.querySelectorAll('.item-carousel');

itemCarousel.forEach(carousel => {
    let currentIndex = 0;
    const itens = carousel.querySelectorAll('.item-conteudo');
    const numitens = itens.length;
    const visibleitens = 4; // Number of visible films in the carousel
    const moveBy = 1; // Number of films to move by on each navigation click

    function showitens() {
        itens.forEach((item, index) => {
            item.style.display = index >= currentIndex && index < currentIndex + visibleitens ? 'block' : 'none';
        });
    }

    function navigate(direction) {
        currentIndex += direction * moveBy;
        if (currentIndex < 0) {
            currentIndex = numitens - visibleitens;
        } else if (currentIndex >= numitens - visibleitens) {
            currentIndex = 0;
        }
        showitens();
    }

    showitens();

    const prevButton = document.createElement('button','i');
    prevButton.classList.add('fa-solid', 'fa-arrow-left'); // Replace 'fa-arrow-left' with the appropriate class for the left arrow icon
    prevButton.addEventListener('click', () => navigate(-1));
    prevButton.style.fontSize = '35px';
    prevButton.style.justifyContent = 'space-between'; // Adjust the font size as needed
    prevButton.style.color = '#08ef'; // Adjust the color as needed
    prevButton.style.backgroundColor = '#1f242d';
    carousel.insertBefore(prevButton, carousel.firstChild);

    
    const nextButton = document.createElement('button','i');
    nextButton.classList.add('fa-solid', 'fa-arrow-right'); // Replace 'fa-arrow-right' with the appropriate class for the right arrow icon
    nextButton.addEventListener('click', () => navigate(1));
    nextButton.style.fontSize = '35px'; 
    prevButton.style.justifyContent = 'center';
    // Adjust the font size as needed
    nextButton.style.color = '#08ef'; // Adjust the color as needed
    nextButton.style.backgroundColor = '#1f242d';
    carousel.appendChild(nextButton);
    
});
