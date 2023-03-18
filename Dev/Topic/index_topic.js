//Search bar
let searchbar = document.querySelector("#search-input");
let files_all = document.querySelector("#file-lists-all");
let files_document = document.querySelector("#file-lists-document");
let files_video = document.querySelector("#file-lists-video");
let files_audio = document.querySelector("#file-lists-audio");
let files_image = document.querySelector("#file-lists-image");

$(function () {
    var userid = $('#user_ID').val().trim();
    var topicid = $('#topic_ID').val().trim();
    // When the user types in the search bar
    $(searchbar).on('input', function () {
        // Get the search query
        var query = $(this).val();

        // If the search query is not empty
        if (query.length > 0) {
            // Send an AJAX request to the server to perform file search
            $.ajax({
                url: 'file_all_search.php',
                type: 'GET',
                data: {
                    q: query,
                    userid: userid,
                    topicid: topicid,
                },
                success: function (data) {
                    // Display the search results in file
                    $(files_all).html(data);
                }
            });
            $.ajax({
                url: 'file_document_search.php',
                type: 'GET',
                data: {
                    q: query,
                    userid: userid,
                    topicid: topicid,
                },
                success: function (data) {
                    // Display the search results in file
                    $(files_document).html(data);
                }
            });
            $.ajax({
                url: 'file_video_search.php',
                type: 'GET',
                data: {
                    q: query,
                    userid: userid,
                    topicid: topicid,
                },
                success: function (data) {
                    // Display the search results in file
                    $(files_video).html(data);
                }
            });
            $.ajax({
                url: 'file_audio_search.php',
                type: 'GET',
                data: {
                    q: query,
                    userid: userid,
                    topicid: topicid,
                },
                success: function (data) {
                    // Display the search results in file
                    $(files_audio).html(data);
                }
            });
            $.ajax({
                url: 'file_image_search.php',
                type: 'GET',
                data: {
                    q: query,
                    userid: userid,
                    topicid: topicid,
                },
                success: function (data) {
                    // Display the search results in file
                    $(files_image).html(data);
                }
            });

        } else {
            // Reload window if the search query is empty
            window.location = ''
        }
    });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})