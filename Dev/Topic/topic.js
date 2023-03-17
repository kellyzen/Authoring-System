//Display add file popup
let addFile = document.querySelector("#file-add");

addFile.addEventListener("click", () => {
    $("#content-file-add").fadeIn(200);
    document.getElementById("content-file-add").style.display = "block";
});

//Close add file popup
let closeFile = document.querySelector("#file-close-btn");
closeFile.addEventListener("click", () => {
    $("#content-file-add").fadeOut(200);
    document.getElementById("content-file-add").style.display = "none";
});

let cancelFile = document.querySelector("#file-cancel-btn");
cancelFile.addEventListener("click", () => {
    $("#content-file-add").fadeOut(200);
    document.getElementById("content-file-add").style.display = "none";
});