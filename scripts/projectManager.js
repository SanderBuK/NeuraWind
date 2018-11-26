function addProject() {
    location.href = ('php/add_project.php');
}

function changeProject(project_id) {
    sessionStorage.project_id = project_id;
    location.href = ('php/load_project.php?project_id=' + project_id);
}

function saveProject(count) {
    project_id = sessionStorage.getItem("project_id");
    project_title = encodeURIComponent(document.getElementById("project_title").value);
    stringPath = 'php/save_project.php?title=' + project_title + "&project_id=" + project_id + "&count=" + count;

    titles = [];
    contents = [];
    for (i = 0; i < count; i++) {
        stringPath = stringPath.concat("&title" + i + "=" + encodeURIComponent(document.getElementById("title" + i).value));
        stringPath = stringPath.concat("&content" + i + "=" + encodeURIComponent(document.getElementById("content" + i).value));
    }
    console.log(stringPath);
    location.href = (stringPath);
}

function addContent(type) {
    project_id = sessionStorage.getItem("project_id");
    location.href = ("php/add_content.php?project_id=" + project_id + "&type=" + type);
}

function removeContents(content_id) {
    project_id = sessionStorage.getItem("project_id");
    location.href = ("php/remove_content.php?project_id=" + project_id + "&content_id=" + content_id);
}

function removeProject(project_id) {
    location.href = ("php/remove_project.php?project_id=" + project_id);
}

function shareProjectModal() {
    var modal = document.getElementById('shareModal');

    var btn = document.getElementById("shareBtn");

    var closeBtn = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    }

    closeBtn.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function searchShare() {
    console.log("searchShare");
    project_id = sessionStorage.getItem("project_id");
    search = document.getElementById("search").value;
    location.href = ("php/search_share.php?project_id=" + project_id + "&search=" + search);
}

function shareProject(searchUser_id) {
    console.log("shareProject");
    project_id = sessionStorage.getItem("project_id");
    location.href = ("php/share_project.php?project_id=" + project_id + "&searchUser_id=" + searchUser_id);
}