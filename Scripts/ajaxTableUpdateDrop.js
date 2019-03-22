var course = 0;
var courselevel =0;
var yearSelected = 0;
function showCourses(level) {
            courselevel = level;
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    document.getElementById("table").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "../PHP/getTable.php?q=" + course + "&yr="+ yearSelected+"&lvl="+ courselevel, true);
            xhttp.send();
}
function showYear(courseChosen)
{
   course = courseChosen;
   document.getElementById("yearBtn").style.visibility = "visible";
   //showStaffStudents(course,yearSelected);
}
function showLevel(courseYear)
{
    yearSelected = courseYear;
    document.getElementById("courseBtn").style.visibility = "visible";
    //document.getElementById("levelBtn").style.visibility = "visible";
    //showStaffStudents(course,yearSelected);
}
/*
function showStaffStudents(course,yearSelected) {
           var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    document.getElementById("table").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "../PHP/StaffMyStudents.php?q=" + course + "&yr="+ yearSelected, true);
            xhttp.send();
}*/