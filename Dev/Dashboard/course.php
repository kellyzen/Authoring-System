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
                    <button class="dashboard-action-button action-btn" type="button">
                        <i class="fal fa-regular fa-list"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <div id="dashboard-content" class="dashboard-content">
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 1</span>
                <span class="dashboard-topic-difficulty difficulty-advanced"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 2</span>
                <span class="dashboard-topic-difficulty difficulty-intermediate"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 3</span>
                <span class="dashboard-topic-difficulty difficulty-beginner"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 4</span>
                <span class="dashboard-topic-difficulty difficulty-beginner"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 5</span>
                <span class="dashboard-topic-difficulty difficulty-advanced"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 6</span>
                <span class="dashboard-topic-difficulty difficulty-intermediate"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 7</span>
                <span class="dashboard-topic-difficulty difficulty-beginner"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
        <div class="dashboard-topic">
            <span class="svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title">Topic 8</span>
                <span class="dashboard-topic-difficulty difficulty-intermediate"></span>
            </span>
            <i class="fal fa-solid fa-ellipsis-h"></i>
        </div>
    </div>
</div>
<script>
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