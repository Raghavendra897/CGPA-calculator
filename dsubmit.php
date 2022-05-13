<?php
$host='localhost';
$user='root';
$pass='';
$db='cgpa';
$name = $_POST["name"];
$credits = $_POST["credits"];
$score = $_POST["score"];
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_error())
{
   echo 'error';
   exit();
}

$sql1 = "SELECT * FROM subjectdata WHERE name='$name'";
$result1 = mysqli_query($conn,$sql1);

$count1 = mysqli_num_rows($result1);

// If result matched $myusername and $mypassword, table row must be 1 row	
if($count1) 
{//session_register("myusername")
  
   header("location:index.php?subject=exist");
   exit();
}

$sql = "INSERT INTO `subjectdata`(`name`, `credits`, `score`) VALUES ('$name','$credits','$score')";

if ($conn->query($sql) === TRUE) 
{
   header("Location:index.php?add=success");
 } 
else {
   echo "Error: " . $sql . "<br>" . $conn->error;
   header("Location:index.php?error='$conn->error' ");
 }



exit();
?>