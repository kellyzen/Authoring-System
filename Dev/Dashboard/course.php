<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="dashboard-title-box">
            <span id="course-header-title" class="course-header-title" contenteditable="true">Course title</span>
            <span class="course-type">Computer Science</span>
        </div>
        <div class="dashboard-description-box">
            <span id="course-description" class="course-description" contenteditable="true">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, totam? Sequi alias eveniet ut quas ullam delectus et quasi incidunt rem deserunt asperiores reiciendis assumenda doloremque provident, dolores aspernatur neque.
            </span>
            <div class="dashboard-action-buttons-box">
                <div class="dashboard-action-buttons">
                    <button class="action-btn" type="button">
                        Filter <i class="fal fa-solid fa-filter"></i>
                    </button>
                    <button class="action-btn" type="button">
                        Add <i class="fal fa-regular fa-plus"></i>
                    </button>
                </div>
                <div class="dashboard-action-buttons">
                    <button id="viewButton" class="dashboard-action-button action-btn" type="button" onclick="changeView()">
                        <i class="fal fa-regular fa-list"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!--List of Topics-->
    <div id="dashboard-content" class="dashboard-content">
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 1</span>
                <span class="dashboard-topic-difficulty difficulty-advanced"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 2</span>
                <span class="dashboard-topic-difficulty difficulty-intermediate"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 3</span>
                <span class="dashboard-topic-difficulty difficulty-beginner"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 4</span>
                <span class="dashboard-topic-difficulty difficulty-beginner"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 5</span>
                <span class="dashboard-topic-difficulty difficulty-advanced"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 6</span>
                <span class="dashboard-topic-difficulty difficulty-intermediate"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 7</span>
                <span class="dashboard-topic-difficulty difficulty-beginner"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 8</span>
                <span class="dashboard-topic-difficulty difficulty-intermediate"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
    </div>
</div>
<script>
    //Toggle between edit and save function
    function changeView() {
        if (document.getElementById("dashboard-content").classList.contains("dashboard-list")) {
            //change dashboard to grid view
            document.getElementById('viewButton').innerHTML = '<i class="fal fa-regular fa-list"></i>';
            document.getElementById("dashboard-content").classList.remove("dashboard-list");
        } else {
            //change dashboard to list view
            document.getElementById('viewButton').innerHTML = '<i class="fal fa-solid fa-grip-vertical"></i>';
            document.getElementById("dashboard-content").classList.toggle("dashboard-list");
        }
    }

    //Ignore enter key while editing course title and course description
    document.querySelector('#course-header-title').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
    document.querySelector('#course-description').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
</script>