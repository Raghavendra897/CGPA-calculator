<?php


$host='localhost';
$user='root';
$pass='';
$db='cgpa';
$con=mysqli_connect($host,$user,$pass,$db);
if(!$con){die("connection failed:".mysqli_connect_error());}
$sql = "SELECT * FROM subjectdata";
$result = mysqli_query($con,$sql);
		
if(mysqli_num_rows($result) >0)
{
	
$data = array();
$num_rows=0;
while($row =mysqli_fetch_assoc($result))
{
	$a = $row['name'];
	$b= $row['credits'];
	$c = $row['score'];
	$tem = array();
	$tem[0] =$a;
	$tem[1] = $b;
	$tem[2] =$c;
	$data[]=$tem;
}
$con->close(); 
echo json_encode($data); 	
exit();
}

else{
	$con->close();
	echo '0';
exit();
}
 


?>




