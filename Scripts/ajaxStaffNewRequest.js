var course = 0;
var courselevel = 0;
var yearSelected = 0;
var courseType = 0;
function showStudents() {
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    document.getElementById("students").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "../PHP/getStaffStudents.php?q=" + course + "&yr="+ yearSelected+"&lvl="+ courselevel +"&tp="+ courseType, true);
            xhttp.send();
}
function selectCourse(value)
{
    course = value;
    showStudents();
}
function selectYear(value)
{
    yearSelected = value;
    showStudents();
}
function selectLevel(value)
{
    courselevel = value;
    showStudents();
}
function selectType(value)
{
    courseType = value;
    showStudents();
}