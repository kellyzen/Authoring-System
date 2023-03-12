<div class="file-lists">
    <div class="topic-file">
        <a href="">
            <span class="svg svg-video"></span>
            <span class="topic-file-group">
                <span class="topic-file-title">Video 1</span>
            </span>
        </a>
        <i class="fal fa-solid fa-ellipsis-h"></i>
        <div class="ellipsis-dropdown">
            <div class="ellipsis-dropdown-content">
                <div class="ellipsis-dropdown-box">
                    <span>Delete</span>
                    <i class="fal fa-solid fa-trash"></i>
                </div>
                <div class="ellipsis-dropdown-box">
                    <span>View</span>
                    <i class="fal fa-solid fa-eye"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="topic-file">
        <a href="">
            <span class="svg svg-video"></span>
            <span class="topic-file-group">
                <span class="topic-file-title">Video 2</span>
            </span>
        </a>
        <i class="fal fa-solid fa-ellipsis-h"></i>
        <div class="ellipsis-dropdown">
            <div class="ellipsis-dropdown-content">
                <div class="ellipsis-dropdown-box">
                    <span>Delete</span>
                    <i class="fal fa-solid fa-trash"></i>
                </div>
                <div class="ellipsis-dropdown-box">
                    <span>View</span>
                    <i class="fal fa-solid fa-eye"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="topic-file">
        <a href="">
            <span class="svg svg-video"></span>
            <span class="topic-file-group">
                <span class="topic-file-title">Video 3</span>
            </span>
        </a>
        <i class="fal fa-solid fa-ellipsis-h"></i>
        <div class="ellipsis-dropdown">
            <div class="ellipsis-dropdown-content">
                <div class="ellipsis-dropdown-box">
                    <span>Delete</span>
                    <i class="fal fa-solid fa-trash"></i>
                </div>
                <div class="ellipsis-dropdown-box">
                    <span>View</span>
                    <i class="fal fa-solid fa-eye"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //Toggle dropdown for topics
    function toggleEllipsisFunction(file_ID) {
        removeShow('.ellipsis-dropdown-content');

        let topicID = 'file_ID' + file_ID.toString();
        document.getElementById(topicID).classList.toggle("show");
    }

    //Remove show class
    function removeShow(classList) {
        const check = document.querySelectorAll(classList);
        check.forEach(e => {
            if (e.classList.contains('show')) {
                e.classList.remove('show');
            }
        })
    }

    //Close all dropdowns if user clicks outside of it
    document.onclick = function(event) {
        if (!event.target.matches('.fa-ellipsis-h')) {
            removeShow('.ellipsis-dropdown-content');
        }
    }
</script>