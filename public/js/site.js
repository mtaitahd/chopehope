const menuButton = document.querySelector('.nav-toggle');
const menu = document.querySelector('#main-menu');

const supportsHover = window.matchMedia('(hover: hover) and (pointer: fine)');

const homeHero = document.querySelector('[data-home-hero]');
if (homeHero && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const images = [...homeHero.querySelectorAll('[data-home-hero-image]')];
    const slides = JSON.parse(homeHero.dataset.homeHeroSlides || '[]');
    let currentIndex = 0;
    let activeImage = images[0];
    let inactiveImage = images[1];

    if (slides.length > 1 && activeImage && inactiveImage) {
        const showNextSlide = async () => {
            const nextIndex = (currentIndex + 1) % slides.length;
            const nextSlide = slides[nextIndex];
            inactiveImage.src = nextSlide.src;

            try {
                await inactiveImage.decode();
            } catch {
                window.setTimeout(showNextSlide, 2000);
                return;
            }

            inactiveImage.alt = nextSlide.alt;
            inactiveImage.removeAttribute('aria-hidden');
            activeImage.setAttribute('aria-hidden', 'true');
            inactiveImage.classList.add('is-active');
            activeImage.classList.remove('is-active');
            [activeImage, inactiveImage] = [inactiveImage, activeImage];
            currentIndex = nextIndex;
            window.setTimeout(showNextSlide, 2000);
        };

        window.setTimeout(showNextSlide, 2000);
    }
}

document.querySelectorAll('.nav-dropdown').forEach((dropdown) => {
    dropdown.addEventListener('mouseenter', () => {
        if (supportsHover.matches) dropdown.setAttribute('open', '');
    });

    dropdown.addEventListener('mouseleave', () => {
        if (supportsHover.matches) dropdown.removeAttribute('open');
    });
});

if (menuButton && menu) {
    menuButton.addEventListener('click', () => {
        const isOpen = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', String(!isOpen));
        menu.classList.toggle('is-open', !isOpen);
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            menuButton.setAttribute('aria-expanded', 'false');
            menu.classList.remove('is-open');
            menu.querySelectorAll('.nav-dropdown[open]').forEach((dropdown) => dropdown.removeAttribute('open'));
        });
    });
}
