var swiper = new Swiper(".home-slider", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 7500,
      disableOnInteraction: false
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    loop:true,
  });

// pop card//

// JavaScript code goes here (unchanged from the previous example)
const showModalBtn = document.getElementById('showModalBtn');
const recipeModal = document.getElementById('recipeModal');
const closeModalBtn = document.getElementById('closeModalBtn');

showModalBtn.addEventListener('click', function() {
    recipeModal.style.display = 'block';
});

closeModalBtn.addEventListener('click', function() {
    recipeModal.style.display = 'none';
});

recipeModal.addEventListener('click', function(event) {
    if (event.target === recipeModal) {
        recipeModal.style.display = 'none';
    }
});