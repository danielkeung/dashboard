<?php session_start(); ?>
<?php
   if($_SESSION['username']==null) {
      echo '<script language="javascript">alert("you don\'t have permission to access");location="index.php";</script>';
   }
?>

<html>
   
   <head>
      <title>Edit Task</title>
      <link rel="stylesheet" type="text/css" href="css/tasks/tasks.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
      <script type="text/javascript">
        //click checkbox change to tick/untick
        function chkBox() {
          if(document.getElementById("isDoneTd").innerHTML) {
            document.getElementById("isDoneTd").innerHTML = "";
            document.getElementById("isDone").value = "0";
          } else {
            document.getElementById("isDoneTd").innerHTML = "&#10004;";
            document.getElementById("isDone").value= "1";
          }
        }

        function submittask() {
          document.getElementById("submitForm").submit();
        }

        function deletetask() {
          document.getElementById("updateCreateDelete").value = 'delete';
          document.getElementById("submitForm").submit();
        }
      </script>
   </head>
  
   <body>
      <h1>Tasks</h1></br>
    <form id="submitForm" class = "form-signup" role = "form" 
      action = "submittask.php" method = "post">
      <table align="center">
            <?php
               $tasks = array();
               include "DB_config.php";
               $selectedId = $_POST['selectedRow'];
               $editType = $_POST['editType'];
               $tasks["task_name"][1] = "";
               $tasks["is_done"][1] = "0";

               // Create connection
               $conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
               // Check connection
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               } 

               $sql = "SELECT task_name, is_done FROM task where id = '$selectedId'";

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

               //load task record
                $displaycheckbox = '<tr><td class="underline"><input class="taskinput" type="text" name="task_name" placeholder="Task name" value ="'. $tasks["task_name"][1] . '" required></td>';
                if($tasks["is_done"][1]) {
                    $displaycheckbox .= '<td id="isDoneTd" onclick="chkBox()" class="checkbox">&#10004;</td></tr>';
                } else {
                    $displaycheckbox .= '<td id="isDoneTd" onclick="chkBox()" class="checkbox"></td></tr>';
                }
                $displaycheckbox .= '<td><input id="isDone" type="hidden" name="isDone" value="'.$tasks["is_done"][1].'"></td>';
                echo $displaycheckbox;
            ?>
            <tr><td><img class="submitButton" src="../../Assets/Register_submit.png" alt="Norway"
              onclick="submittask()">&nbsp
              <?php if($editType=='update'){
                echo '<img class="submitButton" src="../../Assets/Register_delete.png" alt="Norway"
                onclick="deletetask()">';
              }?>
              </td></tr>
            <input id="id" name="id" type="hidden" value='<?php echo $selectedId; ?>'>
            <input id="updateCreateDelete" name="updateCreateDelete" type="hidden" value='<?php echo $editType; ?>'>
      </table>
    </form>
   </body>
</html>