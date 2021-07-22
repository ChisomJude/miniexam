<?php
session_start();
if(isset($_SESSION["username"])){
session_destroy();
}
include_once 'dbConnection.php';
$ref=@$_GET['el'];
echo $examno = mysqli_escape_string($con, $_POST['examno']);
$name = mysqli_escape_string($con,$_POST['name']);
$sex= mysqli_escape_string($con,$_POST['sex']);
$level="Entrance Exam";

$result = mysqli_query($con,"INSERT INTO user VALUES(NULL, '$name','$examno','$level','$sex',NULL,'$examno')")or die('An Error Occured');
$result = mysqli_query($con,"SELECT * FROM user WHERE rollno = '$examno' ") or die('Error22');
$count=mysqli_num_rows($result);
if($count==1){
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$class = $row['branch'];
}
session_start();

$_SESSION["name"] = $name;
$_SESSION["username"] =$examno;
$_SESSION["class"] = $class;
header("location:account.php?q=1");
}
else {header("location:entrance.php?w=Warning : Access denied");
}
?> 