<?php
	include "DB_config.php";
	$user_id = $_POST['username'];
	$pw = $_POST['password'];
	$conpw = $_POST['confirmpassword'];
	$email = $_POST['email'];

	if (!($pw === $conpw)) {
		echo '<script language="javascript">alert("The passwords are not same.");location="signuppage.php";</script>';
	}
	else {
		$conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "INSERT INTO login_user (login_id, password, email, image)
		VALUES ('$user_id', '$pw', '$email','')";

		if ($conn->query($sql) === TRUE) {
			echo '<script language="javascript">alert("New record created successfully");location="index.php";</script>';
		} else {
			echo '<script language="javascript">alert("Error: $sql . <br> . $conn->error");location="signuppage.php";</script>';
		}
		$conn->close();
	}
?>