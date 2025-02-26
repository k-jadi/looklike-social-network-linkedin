let footerpost = document.querySelector("#footer_post");
let lastScrollValue = 0;

document.addEventListener('scroll',() => {
let top  = document.documentElement.scrollTop;
if(lastScrollValue < top) {
    footerpost.classList.add("hidden");
} else {
    footerpost.classList.remove("hidden");
}
lastScrollValue = top;
});