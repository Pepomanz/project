<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

/*$event_id=$_GET["EventName"];
$event_name=$_GET["event_name"];
if($event_name=="")
echo $event_id;
else
echo $event_name;
*/
$count=(int)$_GET['i'];
  echo $count;

$con=mysqli_connect("127.0.0.1","root","","project_test");
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
for($i=1;$i<=$count;$i++)
{
 $col = "Column".$i;	
 $column = $_GET[$col];
 echo $column ."<br>";
 //$sql = "INSERT INTO eventheader  WHERE StudentID = "'$column'" ";
}


$con->close();
?>