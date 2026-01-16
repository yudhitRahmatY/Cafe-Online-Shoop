/* =========================
    NAVBAR TOGGLE
========================= */
let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};


/* =========================
    HOME IMAGE SLIDER
========================= */
document.querySelectorAll('.image-slider img').forEach(images => {
    images.onclick = () => {
        var src = images.getAttribute('src');
        document.querySelector('.main-home-image').src = src;
    };
});


/* =========================
    SWIPER REVIEW SLIDER
========================= */
var swiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    loop: true,
    grabCursor: true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        768: {
            slidesPerView: 2
        }
    },
});

/* =========================
    FILTER MENU (COFFEE / NON COFFEE)
========================= */
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {

        // Hapus class aktif pada tombol sebelumnya
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.getAttribute('data-filter'); // all / coffee / noncoffee
        const items  = document.querySelectorAll('.menu-card');

        // Loop setiap item menu
        items.forEach(item => {
            const category = item.getAttribute('data-category');

            if (filter === 'all' || category === filter) {
                item.style.display = 'block';

                // Animasi fade-in
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 50);

            } else {
                // Animasi fade-out
                item.style.opacity = '0';
                item.style.transform = 'scale(.7)';

                setTimeout(() => {
                    item.style.display = 'none';
                }, 200);
            }
        });
    });
});

