//Display add course popup
let newCourse = document.querySelector("#course-new");

newCourse.addEventListener("click", () => {
    $("#course-new-add").fadeIn(200);
    document.getElementById("course-new-add").style.display = "block";
});

//Close add course popup
let closeCourse = document.querySelector("#course-close-btn");
closeCourse.addEventListener("click", () => {
    $("#course-new-add").fadeOut(200);
    document.getElementById("course-new-add").style.display = "none";
});

let cancelCourse = document.querySelector("#course-cancel-btn");
cancelCourse.addEventListener("click", () => {
    $("#course-new-add").fadeOut(200);
    document.getElementById("course-new-add").style.display = "none";
});