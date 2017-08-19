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
                $sql = "SELECT status FROM TodoTable WHERE uid='$id'";
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) > 0)
                {	    
                    $row = $result->fetch_assoc();
                    if($row['status'] == "done")    {

                        $sql = "UPDATE TodoTable SET status = 'Not Done' WHERE uid='$id'";
                        $conn->query($sql);
                    }else{

                        $sql = "UPDATE TodoTable SET status = 'done' WHERE uid='$id'";
                        $conn->query($sql);
                    }
                }
					$conn->close();
?>