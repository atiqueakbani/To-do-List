<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "Atique-akbani123$";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['user']))
{
$sql = "SELECT userName FROM UserName WHERE userName = '$_POST[user]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	/*$sql= "SELECT UserNameID FROM UserName WHERE userName = '$_POST[user]'";
	$uid = $conn->query($sql);*/
	$sql = "SELECT UserNameID FROM UserName WHERE userName = '$_POST[user]'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['UserNameID'];
	$_SESSION['login_user']= $_POST[user];
	header("Location: todo.php?user=$_POST[user]&uid=$id");
} else {
    echo "Your are Not Registered";
}	
}
$conn->close();
?>
