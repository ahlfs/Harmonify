const dropArea = document.getElementById("drop-area");
const chooseFile = document.getElementById("foto");
const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
    getImgData();
});

function displayImage(url) {
    var imgPreview = document.getElementById("img-preview");
    imgPreview.style.display = "block";
    imgPreview.innerHTML = '<img src="' + url + '" />';
 }


function getImgData() {
    const files = chooseFile.files[0];
    if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
        imgPreview.style.display = "block";
        imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
    }
}

function deletePreview() {
    imgPreview.style.display = "none";
    chooseFile.value = "";
}

dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
});
dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    chooseFile.files = e.dataTransfer.files;
    getImgData();
});