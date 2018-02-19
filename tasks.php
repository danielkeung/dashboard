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
      <script type="text/javascript">
        function edittasks(id) {
          document.getElementById('selectedRow').value = id;
          if(id) {
            document.getElementById('editType').value = 'update';
          } else {
            document.getElementById('editType').value = 'create';
          }
          document.getElementById("submitForm").submit();
        }
      </script>
   </head>
  
   <body>
      <h1>Tasks</h1></br>
    <form id="submitForm" class = "form-signup" role = "form" 
      action = "edittasks.php" method = "post">
      <table align="center">
            <?php
               $tasks = array();
               include "DB_config.php";
               $user_id = $_SESSION['username'];

               // Create connection
               $conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
               // Check connection
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               } 
               $sql = "SELECT * FROM task where user_id='$user_id'";
               $result = $conn->query($sql);
               $cnt = 1;
               $row_cnt = $result->num_rows;
               $loop_ct = 0;
               if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                        $tasks['id'][$cnt] = $row["id"];
                        $tasks['task_name'][$cnt] = $row["task_name"];
                        $tasks['is_done'][$cnt] = $row["is_done"];
                        $cnt++;
                   }
               }
               $conn->close();

               //output the tasks by using for loop
               if(count($tasks)){
                  for ($y = 1; $y <= count($tasks['id']); $y++) {
                   if($tasks["id"][$y]){
                     $displaycheckbox = '<tr onclick="edittasks('. $tasks["id"][$y] .')">';
                     $displaycheckbox .='<td class="underline cursor" >'. $tasks["task_name"][$y] . '</td>';
                     if($tasks["is_done"][$y]) {
                         $displaycheckbox .= '<td class="checkbox cursor">&#10004;</td></tr>';
                     } else {
                         $displaycheckbox .= '<td class="checkbox cursor"></td></tr>';
                     }
                     echo $displaycheckbox;
                   }
                  }
               }
            ?>
            <tr><td><img class="addButton" src="../../Assets/Plus_button.png" alt="Norway"
              onclick="edittasks('')"></td></tr>
            <input id="selectedRow" name="selectedRow" type="hidden">
            <input id="editType" name="editType" type="hidden">
      </table>
    </form>
   </body>
</html>
