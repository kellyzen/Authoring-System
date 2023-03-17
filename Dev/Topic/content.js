//Toggle between edit and save function
function changeView() {
    let tabContent = document.querySelector("#nav-tabContent");

    if (tabContent.classList.contains("topic-list")) {
        //change topic to grid view
        document.getElementById('viewBtn').innerHTML = '<i class="fal fa-regular fa-list"></i>';
        tabContent.classList.remove("topic-list");
    } else {
        //change topic to list view
        document.getElementById('viewBtn').innerHTML = '<i class="fal fa-solid fa-grip-vertical"></i>';
        tabContent.classList.toggle("topic-list");
    }
}

function showFilterMenu() {
    document.getElementById("filter-dropdown").classList.toggle("show");
}

//Auto update topic information
setInterval(autoSaveTopic, 2000);

function autoSaveTopic() {
    var title = $('#topic-header-title').html();
    var description = $('#topic-description').html();
    var topicid = $('#get_id').val().trim();

    if (title == '') {
        document.getElementById('topic-header-title').innerHTML = 'Untitled';
    }

    if (description == '') {
        document.getElementById('topic-description').innerHTML = 'Add description here...';
    }

    if (title != '' || description != '') {
        $.ajax({
            url: 'Actions/topic_update.php',
            type: 'post',
            data: {
                topicid: topicid,
                title: title,
                description: description,
            }
        });
    }
}

//Ignore enter key while editing topic title and topic description
document.querySelector('#topic-header-title').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
    }
});
document.querySelector('#topic-description').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
    }
});