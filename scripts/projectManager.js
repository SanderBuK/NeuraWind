function addProject() {
    location.href = ('add_project.php');
}

function changeProject(project_id){
    sessionStorage.project_id = project_id;
    location.href = ('load_project.php?project_id=' + project_id);
}

function saveProject(count){
    project_id = sessionStorage.getItem("project_id");
    project_title = encodeURIComponent(document.getElementById("project_title").value);
    stringPath = 'save_project.php?title=' + project_title + "&project_id=" + project_id + "&count=" + count;

    titles = [];
    contents = [];
    for(i = 0; i < count; i++){
        stringPath = stringPath.concat("&title" + i + "=" + encodeURIComponent(document.getElementById("title" + i).value));
        stringPath = stringPath.concat("&content" + i + "=" + encodeURIComponent(document.getElementById("content" + i).value));
    }
    console.log(stringPath);
    location.href = (stringPath);
}

function addContent(type){
    project_id = sessionStorage.getItem("project_id");
    location.href = ("add_content.php?project_id=" + project_id + "&type=" + type);
}

function removeContents(contentID){
    project_id = sessionStorage.getItem("project_id");
    location.href = ("remove_content.php?project_id=" + project_id + "&contentID=" + contentID);
}

function removeProject(project_id){
    location.href = ("remove_project.php?project_id=" + project_id);
}