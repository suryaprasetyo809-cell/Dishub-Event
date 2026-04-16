import './css/main.css';

console.log('Dishub Event - Vite Ready');

// Mobile Menu Logic
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('mobile-toggle');
    const menu = document.getElementById('mobile-menu');
    const close = document.getElementById('mobile-close');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.remove('hidden');
        });
    }

    if (close && menu) {
        close.addEventListener('click', () => {
            menu.classList.add('hidden');
        });
    }
});
