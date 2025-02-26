window.addEventListener("load", function(){
    setTimeout(
        function open(event){
            document.querySelector(".popup").style.visibility = "visible";
            document.querySelector(".popup").style.opacity = "1";
        },
        1000
    )
});
document.querySelector("#close").addEventListener("click", function(){
    document.querySelector(".popup").style.visibility = "hidden";
    document.querySelector(".popup").style.opacity = "0";
});