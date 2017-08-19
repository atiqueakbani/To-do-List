<!DOCTYPE html>

<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	    crossorigin="anonymous"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	    crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
	    crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
	    crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-3">Manage your TODOs</h1>
			<p class="lead">Now manage your TODOs linked with your accounts! Create an account with us just with your username!</p>
			<hr class="my-4">
			<center>
				<h2>My TODOs</h3>
			</center>
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "Atique-akbani123$";
				$dbname = "register";
			
				$conn = new mysqli($servername, $username, $password, $dbname);
			
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
			
				$user = $_GET['uid'];
				$sql = "SELECT uid, todo, status FROM TodoTable WHERE userid='$user'";
				$result = $conn->query($sql);
					if (mysqli_num_rows($result) > 0)
					{	
						while($row = $result->fetch_assoc())
						{
							if($row['status'] == 'Not done')	{
								echo "<div id='todo-list' class='card text-white bg-primary mb-3'>
									<div class='card-header'>
										<button id='status' type='button' todoid ='".$row['uid']."' class='badge badge-danger update '>
											Not done
										</button>"
										. $row['todo']. 
										"<button id='close' type='button' todoid ='".$row['uid']."' class='close delete' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
										</button>
									</div>
								</div>";
							}	elseif($row['status'] == 'done')	{
								echo "<div id='todo-list' class='card text-white bg-primary mb-3'>
									<div class='card-header'>
										<button id='status' type='button' todoid ='".$row['uid']."' class='badge badge-success'>
											Done
										</button>"
										. $row['todo']. 
										"<button id='close' type='button' todoid ='".$row['uid']."' class='close delete' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
										</button>
									</div>
								</div>";
							}	
							
						}
					}
					if (isset($_POST["todo"])) {
						$todo = $_POST['todo'];
						$user = $_GET['uid'];
						$sql = "INSERT INTO TodoTable (userid, todo, status) VALUES ('$user', '$todo', 'Not done')";
						$conn->query($sql);
						echo "<meta http-equiv='refresh' content='0'>";
					}
					$conn->close();
				?>

				<hr class="my-4">
				<form id="new-todo" method="POST" action="">
					<div class="form-group">
						<input type="name" class="form-control" name="todo" placeholder="Add todo">
					</div>
					<button type="submit" class="btn btn-primary">Add</button>
				</form>
		</div>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script>

		$('.update').click(function () {
					console.log("WorkingButton Update");
			$.post("todoupdate.php", {
					todoid: $(this).attr('todoid')
				},
				function (data, status) {
					console.log("Working Update");
					$(this).removeClass('badge-danger').addClass('badge-success').val("Done");
					location.reload();
				});
		});

		$('.delete').click(function () {
					console.log("WorkingButton Delete");
			$.post("tododelete.php", {
					todoid: $(this).attr('todoid')
				},
				function (data, status) {
					console.log("Working Delete");
					$(this).closest('#todo-list').remove();
					location.reload();
				});
		});
	</script>
	
</body>

</html>