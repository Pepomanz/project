<!DOCTYPE html>
<html>
<style>

h1 {
    border-bottom: 3px solid #cc9900;
    color: #996600;
    font-size: 30px;
}
table, th , td {
    border: 1px solid grey;
    border-collapse: collapse;
    padding: 5px;
}
table tr:nth-child(odd) {
    background-color: #f1f1f1;
}
table tr:nth-child(even) {
    background-color: #ffffff;
}
</style>

<title> Complex Form </title>
<body>
<h1> Exam Room ANNOUNCEMENT</h1>
<form action="" method="post" >
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <title>Dynamic Drop Down List</title>
    <body>
    <div id="subjectList"></div>
    <br>
    <div id="yearList">Year: 
        <script>
        document.write('<select name="Year" id="Year"><option value="">Select Year</option></select>')
        </script>
    </div>
    <br>
    <div id="subjectText">Subject: 
        <script>
        document.write('<input type="text" name="subject"><br>Year: <input type="text" name="Year">')
        </script>
    </div>
    <br>
    <div id="facultyList">Faculty:
        <script>
        document.write('<select name="Faculty" id="Faculty"><option value="">Select Faculty</option></select>')
        </script>
    </div>
    <br>
    <div id="departmentList">Department: 
        <script>
        document.write('<select name="Department" id="Department"><option value="">Select Department</option></select>')
        </script>
    </div>
    <br><br>
    <div id="programList">Program: 
        <script>
        document.write('<select name="Program" id="Program"><option value="">Select Program</option></select>')
        </script>
    </div>
    <br><br>
    </body>
    <div id="table"> Table: 
        <script>
        //document.write('<table id="myTable"><tr><th>AppID</th><th>Name</th><th>Student ID</th></tr><tr><td></td><td></td><td></td><td><button onclick="addRecord()">Edit</button></td></tr></table>')
        document.write('<table id="myTable"><tr><th>AppID</th><th>Name</th><th>Student ID</th></tr><tr><td></td><td></td><td></td></tr></table>')
        </script> 
    </div>  

    <br><INPUT TYPE = "submit" value = "Submit">
</form>
<script>
loadSubject();


function loadSubject(){
    var xmlhttp = new XMLHttpRequest();
    var url = "http://127.0.0.1:80/project/getSubject.php";
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            displayResponseSubject(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function loadYear(SubID){
    var xmlhttp = new XMLHttpRequest();
    var url = "http://127.0.0.1:80/project/getYear.php/?subjectID="+SubID;
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            displayResponseYear(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function loadFaculty(){
    var xmlhttp = new XMLHttpRequest();
    var url = "http://127.0.0.1:80/project/getFaculty.php";
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            displayResponseFaculty(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function loadDepartment(FacID){
    var xmlhttp = new XMLHttpRequest();
    var url = "http://127.0.0.1:80/project/getDepartment.php/?facultyID="+FacID;
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            displayResponseDepartment(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function loadProgram(DeID){
    var xmlhttp = new XMLHttpRequest();
    var url = "http://127.0.0.1:80/project/getProgram.php/?departmentID="+DeID;
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            displayResponseProgram(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function loadTable(ProID){
    var xmlhttp = new XMLHttpRequest();
    var selector = document.getElementById('Year');
    var year = selector.option[selector.selectedIndex].value;
    var url = "http://127.0.0.1:80/project/getTableForm1.php/?programID="+ProID"&year="+year;
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            displayResponseTable(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function addID(appID,studentID,proID)
{
    var xmlhttp = new XMLHttpRequest();
    var url = "http://127.0.0.1:80/project/addID.php/?studentID="+studentID+" &appID="+appID+"&programID="+proID;
    alert(url);
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            displayResponseTable(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function displayResponseSubject(response){
    var i;
    var out = "Existing Subject: <select id=\"Subject\" name=\"Subject\" class=\"required-entry\" onchange=\"javascript: EnableSubjectText(this.options[this.selectedIndex].value );loadYear(this.options[this.selectedIndex].value ); \"><option value=\"Select Subject\" >Select Subject</option>";
    var arr = JSON.parse(response);
    for(i = 0; i < arr.length; i++) {
        out += '<option value="'+arr[i].SubjectID+'">'+arr[i].SubjectName+'</option>';
    }
    out += "</select> *[Optional used for editing exam room records]";
    document.getElementById("subjectList").innerHTML = out;
}
function displayResponseYear(response){
    var i;
    var out = "Year: <select id=\"Year\" name=\"Year\" class=\"required-entry\" onchange=\"javascript: EnableSubjectText(this.options[this.selectedIndex].value ); loadFaculty();\"><option value=\"Select Year\" >Select Year</option>";
    var arr = JSON.parse(response);
    for(i = 0; i < arr.length; i++) {
        out += '<option value="'+arr[i].Year+'">'+arr[i].Year+'</option>';
    } 
    out += "</select>"; 
    document.getElementById("yearList").innerHTML = out;
}
function EnableSubjectText(response){
    var out = "Subject: <input type=\"text\" name=\"subject\"";
    if(response == "Select Year" || response == "Select Subject" ){
      out += " ><br>Year: <input type=\"text\" name=\"Year\">";
    }
    else out += " disabled><br>Year: <input type=\"text\" name=\"Year\" disabled>[disabled]";
    document.getElementById("subjectText").innerHTML = out;
    
}

function displayResponseFaculty(response){
    var i;
    var out = "Faculty: <select id=\"Faculty\" name=\"Faculty\" class=\"required-entry\" onchange=\"javascript: loadDepartment(this.options[this.selectedIndex].value );\" ><option value=\"Select Faculty\">Select Faculty</option>";
    var arr = JSON.parse(response);
    for(i = 0; i < arr.length; i++) {
        out += '<option value="'+arr[i].FacultyID+'">'+arr[i].Faculty+'</option>';
    }
    out += "</select>"; 
    document.getElementById("facultyList").innerHTML = out;
}
function displayResponseDepartment(response){

    var i;
    var out = "Department:<select id=\"Department\" name=\"Department\" class=\"required-entry\" onchange=\"javascript: loadProgram(this.options[this.selectedIndex].value );\"  ><option value=\"Select Department\">Select Department</option>";
    var arr = JSON.parse(response);
    for(i = 0; i < arr.length; i++) {
        out += '<option value="'+arr[i].DepartmentID+'">'+arr[i].DepartmentName+'</option>';
    }
    out += "</select>"; 
    document.getElementById("departmentList").innerHTML = out;
}

function displayResponseProgram(response){

    var i;
    var out = "Program:<select id=\"Program\" name=\"Program\" class=\"required-entry\" onchange=\"javascript: loadTable(this.options[this.selectedIndex].value );\" ><option value=\"Select Program\">Select Program</option>";
    var arr = JSON.parse(response);
    for(i = 0; i < arr.length; i++) {
        out += '<option value="'+arr[i].ProgramID+'">'+arr[i].ProgramName+'</option>';
    }
    out += "</select>"; 
    document.getElementById("programList").innerHTML = out;
}
function displayResponseTable(response){

    var i;
    var out = '<table id=\"myTable\"><tr><th>AppID</th><th>Name</th><th>Student ID</th></tr>';
    var arr = JSON.parse(response);
    for(i = 0; i < arr.length; i++) {
        //("555");
        if(arr[i].StudentID!=""){
         out += '<tr><td>'+arr[i].AppID+'</td><td>'+ arr[i].fName+' '+arr[i].lName+'</td><td>'+arr[i].StudentID+'</td><td></td></tr>';
        }
        else{

            out += '<tr><td>'+arr[i].AppID+'</td><td>'+ arr[i].fName+' '+arr[i].lName+'</td><td><INPUT TYPE = \"TEXT\" Name = \"studentID\" id = \"studentID\"'+i+' SIZE = \"20\"></td></tr>';
                  
        }
    }
    out += "</table>"; 
    document.getElementById("table").innerHTML = out;
}
function getvalue(appID,proID)
{
    //alert(proID);
    var stuID = document.getElementById("studentID").value;
    //alert(appID);
    addID(appID,stuID,proID);
}

</script>
</body>

</html>