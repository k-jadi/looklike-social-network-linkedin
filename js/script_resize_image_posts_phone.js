const WIDTH2 = 300;

let input2 = document.getElementById("piece_join_posts2");

input2.addEventListener("change", (event2) => {
    let image_file2 = event2.target.files[0];
    let reader2 = new FileReader;
    reader2.readAsDataURL(image_file2);
    reader2.onload = (event3) => {
        let image_url2 = event3.target.result;
        let image2 = document.createElement("img");
        image2.src = image_url2;
        image2.onload = (e) => {
            let canvas2 = document.createElement('canvas');
            let ratio2 = WIDTH2 / e.target.width;
            canvas2.width = WIDTH2;
            canvas2.height = e.target.height * ratio2;
            const context2 = canvas2.getContext("2d");
            context2.drawImage(image2, 0,0,canvas2.width, canvas2.height);
            let new_image_url2 = context2.canvas.toDataURL("image/png", 90);
            let new_image2 = document.createElement("img");
            new_image2.src = new_image_url2;
            new_image2.style.width = "110px";
            new_image2.style.height = "110px";
            document.getElementById('image_wrapper2').appendChild(new_image2);
            let image_file2 = urlTofile2(new_image_url2);
            uploadimage2(image_file2);
            document.getElementById("fermerphoto2").addEventListener("click", () => {
            document.getElementById('image_wrapper2').removeChild(new_image2);
            })

        }
    }

})



const generaterandomstring2 = function (length=6) {
    return Math.random().toString(20).substring(2,length) + '.png';
}


let urlTofile2 = (url) => {
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

    
    const zzz2 = generaterandomstring2();

    let file2 = new File([dataArr], zzz2 , {type: mime});

    return file2;

}


let uploadimage2 = (file2) => {

    let form_post_pc2 = document.getElementById("form_posts_pc2");
    let new_input2 = document.createElement("input");
    new_input2.type = "file";
    new_input2.name = "piece_jointe_posts2";

    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file2);
    new_input2.files = dataTransfer.files;

    new_input2.style.display = "none";
    
    form_post_pc2.appendChild(new_input2);
}