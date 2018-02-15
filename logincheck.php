<?php session_start(); ?>
<?php
	include "DB_config.php";
	$user_id = $_POST['username'];
	$pw = $_POST['password'];

	// Create connection
	$conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT login_id, password FROM login_user";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        if($user_id===$row["login_id"]&&$pw===$row["password"]){
	        	$_SESSION['username'] = $user_id;
	        	header('Location:mainpage.php');
	        }
	    }
	}
	echo '<script language="javascript">alert("username or password is incorrect");location="index.php";</script>';
	$conn->close();
?>