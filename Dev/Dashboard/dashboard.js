//Display add course popup
let addCourse = document.querySelector("#course-add");

addCourse.addEventListener("click", () => {
    $("#content-course-add").fadeIn(200);
    document.getElementById("content-course-add").style.display = "block";
});

//Close add course popup
let closeCourse = document.querySelector("#course-close-btn");
closeCourse.addEventListener("click", () => {
    $("#content-course-add").fadeOut(200);
    document.getElementById("content-course-add").style.display = "none";
});

let cancelCourse = document.querySelector("#course-cancel-btn");
cancelCourse.addEventListener("click", () => {
    $("#content-course-add").fadeOut(200);
    document.getElementById("content-course-add").style.display = "none";
});

//Display add topic popup
let addTopic = document.querySelector("#topic-add");

addTopic.addEventListener("click", () => {
    $("#content-topic-add").fadeIn(200);
    document.getElementById("content-topic-add").style.display = "block";
});

//Close add topic popup
let closeTopic = document.querySelector("#topic-close-btn");
closeTopic.addEventListener("click", () => {
    $("#content-topic-add").fadeOut(200);
    document.getElementById("content-topic-add").style.display = "none";
});

let cancelTopic = document.querySelector("#topic-cancel-btn");
cancelTopic.addEventListener("click", () => {
    $("#content-topic-add").fadeOut(200);
    document.getElementById("content-topic-add").style.display = "none";
});