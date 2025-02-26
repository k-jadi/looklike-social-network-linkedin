let avatar_menu = document.getElementById('avatar');
let barre_lateral = document.getElementById('barre_lateral');
let fermeture_barre_lateral = document.getElementById('fermeture_barre_lateral');
function disableScroll() {
    // Get the current page scroll position
    scrollTop =
    window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft =
    window.pageXOffset || document.documentElement.scrollLeft,
 
        // if any scroll is attempted,
        // set this to the previous value
        window.onscroll = function() {
            window.scrollTo(scrollLeft, scrollTop);
        };
}
function enableScroll() {
    window.onscroll = function() {};
}

avatar_menu.addEventListener('click', () => {
    barre_lateral.style.transform ='translateX(0%)';
    disableScroll();
})
fermeture_barre_lateral.addEventListener('click', () => {
    barre_lateral.style.transform ='translateX(-100%)';
    enableScroll()
})