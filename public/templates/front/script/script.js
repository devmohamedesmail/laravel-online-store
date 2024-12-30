


document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', () => {
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            menu.style.maxHeight = menu.scrollHeight + 'px';
        } else {
            menu.style.maxHeight = '0';
            menu.addEventListener('transitionend', () => menu.classList.add('hidden'), {
                once: true
            });
        }
    });



    // swipper
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });





    //   quantity butn
    const increament_btn = document.getElementById('increament_btn');
    const decreament_btn = document.getElementById('decreament_btn');
    const quantity = document.getElementById('quantity');

  

    if (increament_btn) {
        increament_btn.addEventListener('click', () => {
            quantity.value++;
        });
    }


  

    if (decreament_btn) {
        decreament_btn.addEventListener('click', () => {
            if (quantity.value > 1) {
                quantity.value--;
            }
        }); 
    }








    // function toggleDropdown() {
    //     const menu = document.getElementById('dropdown-menu');
    //     const isHidden = menu.classList.contains('hidden');
    //     menu.classList.toggle('hidden', !isHidden); // Toggle the `hidden` class
    // }

    // Optional: Close dropdown if clicked outside
    // window.addEventListener('click', (event) => {
    //     const menu = document.getElementById('dropdown-menu');
    //     const button = document.getElementById('menu-button');
    //     if (!menu.contains(event.target) && !button.contains(event.target)) {
    //         menu.classList.add('hidden');
    //     }
    // });
});




document.addEventListener('DOMContentLoaded', function () {
    const paymentRadios = document.querySelectorAll('.payment-method-radio');
    const cardElement = document.getElementById('card-element');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            
            if (this.dataset.type === 'Pay with Visa') {
                cardElement.classList.remove('hidden');
            } else {
                cardElement.classList.add('hidden');
            }
        });
    });
});






document.addEventListener('DOMContentLoaded', function () {
    let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
});