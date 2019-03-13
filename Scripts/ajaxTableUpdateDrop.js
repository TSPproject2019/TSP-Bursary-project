var course = 0;
var courselevel =0;
var yearSelected = 0;
function showCourses(level) {
            courselevel = level;
            var xhttp;
            /*if(str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }*/
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    document.getElementById("table").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "../PHP/getTable.php?q=" + course + "&yr="+ yearSelected+"&lvl="+ courselevel, true);
            xhttp.send();
}
function showYear(courseChosen){
    course = courseChosen;
    document.getElementById("yearBtn").style.visibility = "visible";
}
function showLevel(courseYear){
    yearSelected = courseYear;
    document.getElementById("levelBtn").style.visibility = "visible";
}