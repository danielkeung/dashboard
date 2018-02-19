<?php
	include "DB_config.php";
	$user_id = $_REQUEST['username'];
	$img = $_REQUEST['image'];
	$bool = 0;

	$conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	/* set autocommit to off */
	$conn->autocommit(FALSE);

	$sql = "INSERT INTO photo (user_id, img)
	VALUES ('$user_id', '$img');";

	if ($conn->query($sql) === TRUE) {
		$bool = 1;
	} else {
		$bool = 0;
		echo 'alert("Error: $sql . <br> . $conn->error");location="signuppage.php";';
	}

	/* commit or rollback transaction */
	if($bool) {
		echo 'alert("New photo is insert successfully");location="photopage.php";';
		$conn->commit();
	} else {
		echo 'alert("Error: $sql . <br> . $conn->error");location="photopage.php";';
		$conn->rollback();
	}

	/* close connection */
	$conn->close();
?>