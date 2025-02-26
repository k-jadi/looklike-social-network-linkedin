let footerpost2 = document.querySelector("#header_hidden");
let lastScrollValue2 = 0;

document.addEventListener('scroll',() => {
let top2  = document.documentElement.scrollTop;
if(lastScrollValue2 < top2) {
    footerpost2.classList.add("hidden2");
} else {
    footerpost2.classList.remove("hidden2");
}
lastScrollValue2 = top2;
});