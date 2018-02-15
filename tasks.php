<?php session_start(); ?>
<?php
   if($_SESSION['username']==null) {
      echo '<script language="javascript">alert("you don\'t have permission to access");location="index.php";</script>';
   }
?>

<html>
   
   <head>
      <title>Testing</title>
      <link rel="stylesheet" type="text/css" href="css/tasks/tasks.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
   </head>
	
   <body>
      <h1>Tasks</h1></br>
      <table align="center">
            <?php
               $tasks = array();
               include "DB_config.php";
               $user_id = $_POST['username'];
               $pw = $_POST['password'];

               // Create connection
               $conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
               // Check connection
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               } 

               $sql = "SELECT task_name, is_done FROM task";
               $result = $conn->query($sql);
               $cnt = 1;
               if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                       $tasks['task_name'][$cnt] = $row["task_name"];
                       $tasks['is_done'][$cnt] = $row["is_done"];
                       $cnt++;
                   }
               }
               $conn->close();

               for ($y = 1; $y <= count($tasks); $y++) {
                  echo '<tr><td>'. $tasks["task_name"][$y] . '</td><td>'. $tasks["is_done"][$y] . '</td></tr>';
               }
            ?>
            <tr><td><img id="weather" src="../../Assets/Plus_button.png" alt="Norway" style="width:100%;"
              onclick=""></td></tr>
      </table>
   </body>
</html>