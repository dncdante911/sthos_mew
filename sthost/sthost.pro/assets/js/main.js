document.addEventListener("DOMContentLoaded", () => {
    const fadeEls = document.querySelectorAll('.fade-in');
    fadeEls.forEach(el => {
        el.classList.add('visible');
    });
});
