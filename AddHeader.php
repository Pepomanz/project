<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$event_id=(int)$_GET["EventName"];
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
 echo $column ."<br/>";
 $sql = "INSERT INTO eventheader  (HeaderTitle,HeaderNo) VALUES ('$column','$i') WHERE EventID = '$event_id' ";
 if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br/>" . $con->error;
}

}


$con->close();
?>