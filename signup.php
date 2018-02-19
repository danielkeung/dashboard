<?php
	include "DB_config.php";
	$user_id = $_POST['username'];
	$pw = $_POST['password'];
	$conpw = $_POST['confirmpassword'];
	$email = $_POST['email'];
	$img = $_POST['image'];
	$bool = 0;

	if (!($pw === $conpw)) {
		echo '<script language="javascript">alert("The passwords are not same.");location="signuppage.php";</script>';
	}
	else {
		$conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
	}

	/* set autocommit to off */
	$conn->autocommit(FALSE);

	/* Insert some values */
	$sql = "INSERT INTO login_user (login_id, password, email)
	VALUES ('$user_id', '$pw', '$email');";

	if ($conn->query($sql) === TRUE) {
		$bool = 1;
	} else {
		$bool = 0;
		echo '<script language="javascript">alert("Error: $sql . <br> . $conn->error");location="signuppage.php";</script>';
	}

	$sql2 = "INSERT INTO photo (user_id, img)
	VALUES ('$user_id', '$img');";

	if ($conn->query($sql2) === TRUE) {
		$bool = 1;
	} else {
		$bool = 0;
		echo '<script language="javascript">alert("Error: $sql . <br> . $conn->error");location="signuppage.php";</script>';
	}

	/* commit or rollback transaction */
	if($bool) {
		echo '<script language="javascript">alert("New record is create successfully");location="index.php";</script>';
		$conn->commit();
	} else {
		echo '<script language="javascript">alert("Error: $sql . <br> . $conn->error");location="signuppage.php";</script>';
		$conn->rollback();
	}

	/* close connection */
	$conn->close();
?>