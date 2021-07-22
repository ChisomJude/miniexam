<?php
include_once 'dbConnection.php';
$ref      = @$_GET['q'];
$username = $_POST['uname'];
$password = $_POST['password'];

$username = stripslashes($username);
$username = addslashes($username);
$password = stripslashes($password);
$password = addslashes($password);
$result = mysqli_query($con, "SELECT * FROM teachers WHERE username = '$username' and password = '$password'") or die('Error');
$count = mysqli_num_rows($result);
if ($count == 1) {
    session_start();
    $row = mysqli_fetch_array($result);
    if (isset($_SESSION['username'])) {
        session_unset();
    }
    $_SESSION["name"]     = $row['name'];
    $_SESSION["key"]      = '65585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39';
    $_SESSION["username"] = $username;
    $_SESSION["id"] = $row['id'];
    header("location:dashboard_teacher.php?q=0");
} else
    header("location:$ref?w=Warning : Access denied");
?>