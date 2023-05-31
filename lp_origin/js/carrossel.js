
const filmeCarousel = document.querySelectorAll('.filme-carousel');

filmeCarousel.forEach(carousel => {
    let currentIndex = 0;
    const filmes = carousel.querySelectorAll('.filme-item');
    const numFilmes = filmes.length;
    const visibleFilmes = 4; // Number of visible films in the carousel
    const moveBy = 1; // Number of films to move by on each navigation click

    function showFilmes() {
        filmes.forEach((filme, index) => {
            filme.style.display = index >= currentIndex && index < currentIndex + visibleFilmes ? 'block' : 'none';
        });
    }

    function navigate(direction) {
        currentIndex += direction * moveBy;
        if (currentIndex < 0) {
            currentIndex = numFilmes - visibleFilmes;
        } else if (currentIndex >= numFilmes - visibleFilmes) {
            currentIndex = 0;
        }
        showFilmes();
    }

    showFilmes();

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
