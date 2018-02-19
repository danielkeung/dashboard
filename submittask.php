<?php session_start(); ?>
<?php
	include "DB_config.php";
	$task_name = $_POST['task_name'];
	$isDone = $_POST['isDone'];
	$id = $_POST['id'];
	$user_id = $_SESSION['username'];
	$updateCreateDelete = $_POST['updateCreateDelete'];
	$sql = "";
	$bool = 0;

	$conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	/* set autocommit to off */
	$conn->autocommit(FALSE);

	//create the edit type insert delete or upert
	if($updateCreateDelete=="update"){
		$sql = "UPDATE task  set task_name = '$task_name', is_done = '$isDone'
		Where id='$id';";
	} else if ($updateCreateDelete=="create") {
		$sql = "INSERT INTO task (task_name, is_done, user_id)
		VALUES ('$task_name', '$isDone', '$user_id');";
	} else if ($updateCreateDelete=="delete") {
		$sql = "Delete from task where id = '$id'";
	}

	if ($conn->query($sql) === TRUE) {
		$bool = 1;
	} else {
		$bool = 0;
		echo '<script>alert("Error: $sql . <br> . $conn->error");location="tasks.php";</script>';
	}

	/* commit or rollback transaction */
	if($bool) {
		if($updateCreateDelete=="update"){
			echo '<script>alert("New Task is updated successfully");location="tasks.php";</script>';
		} else if ($updateCreateDelete=="create") {
			echo '<script>alert("New Task is created successfully");location="tasks.php";</script>';
		} else if ($updateCreateDelete=="delete") {
			echo '<script>alert("New Task is deleted successfully");location="tasks.php";</script>';
		}
		$conn->commit();
	} else {
		echo '<script>alert("Error: $sql . <br> . $conn->error");location="tasks.php";</script>';
		$conn->rollback();
	}

	/* close connection */
	$conn->close();
?>