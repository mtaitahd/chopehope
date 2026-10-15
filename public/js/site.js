const menuButton = document.querySelector('.nav-toggle');
const menu = document.querySelector('#main-menu');

const supportsHover = window.matchMedia('(hover: hover) and (pointer: fine)');
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
