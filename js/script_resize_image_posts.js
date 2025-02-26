const WIDTH = 300;

let input = document.getElementById("piece_join_posts");

input.addEventListener("change", (event) => {
    let image_file = event.target.files[0];
    let reader = new FileReader;
    reader.readAsDataURL(image_file);
    reader.onload = (event) => {
        let image_url = event.target.result;
        let image = document.createElement("img");
        image.src = image_url;
        image.onload = (e) => {
            let canvas = document.createElement('canvas');
            let ratio = WIDTH / e.target.width;
            canvas.width = WIDTH;
            canvas.height = e.target.height * ratio;
            const context = canvas.getContext("2d");
            context.drawImage(image, 0,0,canvas.width, canvas.height);
            let new_image_url = context.canvas.toDataURL("image/png", 90);
            let new_image = document.createElement("img");
            new_image.src = new_image_url;
            new_image.style.width = "130px";
            new_image.style.height = "130px";
            document.getElementById('image_wrapper').appendChild(new_image);
            
            let image_file = urlTofile(new_image_url);
            uploadimage(image_file);
            document.getElementById("fermerphoto").addEventListener("click", () => {
            document.getElementById('image_wrapper').removeChild(new_image);
            })
        }
    }

})

const generaterandomstring = function (length=6) {
    return Math.random().toString(20).substring(2,length) + '.png';
}


let urlTofile = (url) => {
    let arr = url.split(",")
    let mime = arr[0].match(/:(.*?);/)[1];
    let data = arr[1];

    let datastr = atob(data);
    let n = datastr.length;
    let dataArr = new Uint8Array(n);
    
    while(n--)
    {
        dataArr[n] = datastr.charCodeAt(n);
    }   

    
    const zzz = generaterandomstring();

    let file = new File([dataArr], zzz , {type: mime});

    return file;

}


let uploadimage = (file) => {

    let form_post_pc = document.getElementById("form_posts_pc");
    let new_input = document.createElement("input");
    new_input.type = "file";
    new_input.name = "piece_jointe_posts";

    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    new_input.files = dataTransfer.files;

    new_input.style.display = "none";
    
    form_post_pc.appendChild(new_input);
}