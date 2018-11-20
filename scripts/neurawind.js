var currentProject;

function addProject() {
    location.href = ('add_project.php');
}

function changeProject(title, text, num){
    document.getElementById("project_title").value = title;
    document.getElementById("project_text").value = text;
    currentProject = num;
}

function saveProject(){
    project_title = document.getElementById("project_title").value;
    project_text = document.getElementById("project_text").value;
    location.href = ('save_project.php?title=' + project_title + "&text=" + project_text + "&num=" + currentProject);
}