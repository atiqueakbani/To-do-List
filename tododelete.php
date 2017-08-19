<?php
				$servername = "localhost";
				$username = "root";
				$password = "Atique-akbani123$";
				$dbname = "register";
			
				$conn = new mysqli($servername, $username, $password, $dbname);
			
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
			
                $id = $_POST['todoid'];
                
				$sql = "DELETE FROM TodoTable WHERE uid='$id'";
				$conn->query($sql);
					$conn->close();
				?>