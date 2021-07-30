// imagen.onchange = evt => {
//     const [file] = imagen.files
//     if (file) {
//         image-preview.src = URL.createObjectURL(file)
//     }
// }

function restoreImage(path) {

    // alert(path)
    // console.log(path)
    image_preview = document.getElementById('image-preview');
    imagen = document.getElementById('imagen');

    if(path != "http://localhost/RockolasPanchos/public/storage") {
        image_preview.src = path;
    } else {
        image_preview.src = "http://localhost/RockolasPanchos/public/storage/no_imagen.jpg";
    }
    
    imagen.value = "";

}