<?php
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

$sql = "SELECT userName FROM UserName WHERE userName = '$_POST[user]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "ERROR: USER ALREADY EXISTS";
} else {
    	$sql = "INSERT INTO UserName (userName) values ('$_POST[user]')";
	$result = $conn->query($sql);
	if ($result == 1) {
	   echo "Registration succesful";
	} else {
		echo "ERROR: SOME ERROR WITH THE DB.";
	}
}

$conn->close();
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<form method="POST" action="index.php">
                <br>
                <input id="button" type="submit" name="submit" value="Back">
            </form>
			</head>
	</html>