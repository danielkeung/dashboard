<?php session_start(); ?>
<?php
   $csv = array();
   if($_SESSION['username']!=null) {
      if(!isset($_POST['teamname']))
      {
         if (($file = fopen('I1.csv', 'r')) === false)
         {
            throw new Exception('There was an error loading the CSV file.');
         }
         else
         {
            $row = 0;
            while (($line = fgetcsv($file, 1000)) !== false)
            {
               if($row!=0){
                  $csv['Date'][$row] = $line[1];
                  $csv['HomeTeam'][$row] = $line[2];
                  $csv['AwayTeam'][$row] = $line[3];
                  $csv['FTHG'][$row] = $line[4];
                  $csv['FTAG'][$row] = $line[5];
                  $csv['FTR'][$row] = $line[6];
               }
               $row++;
            }
            fclose($handle);
         }
      }
   } else {
      echo '<script language="javascript">alert("you don\'t have permission to access");location="index.php";</script>';
   }
?>

<html>
   
   <head>
      <title>Testing</title>
      <link rel="stylesheet" type="text/css" href="css/sport/sport.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
      <script>
          document.onkeydown=function(evt){
              var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
              if(keyCode == 13)
              {
                  //your function call here
                  document.test.submit();
              }
          }
      </script>
   </head>
	
   <body>
      <h1>Sport</h1></br>
      <form name="test" action="#" method="POST">
         <input type = "text"
                  name = "teamname" placeholder = "Input team name" 
                  required autofocus>
         <input type="hidden" name="csv" value="<?php echo htmlspecialchars(serialize($csv)); ?>">
      </form>
      <?php
         $teamlist = array();
         if(isset($_POST['teamname']))
         {
            //after enter pressed.
            //check team won.
            $teamname = $_POST['teamname'];
            $csv = unserialize($_POST['csv']);
            $cnt = 0;
            
            for ($x = 1; $x <= count($csv['Date']); $x++) {
                if($csv['HomeTeam'][$x]==$teamname||$csv['HomeTeam'][$x]==$AwayTeam){
                  if($csv['HomeTeam'][$x]==$teamname) {
                     if($csv['FTR'][$x]=='H') {
                        $teamlist[$cnt] = $csv['AwayTeam'][$x];
                        $cnt++;
                     }
                  } else {
                     if($csv['FTR'][$x]=='A') {
                        $teamlist[$cnt] = $csv['HomeTeam'][$x];
                        $cnt++;
                     }
                  }
                }
            }
            //display teamlist
            for ($y = 1; $y <= count($teamlist); $y++) {
               echo '<h5>'. $teamlist[$y] . '</h5>';
            }
         
         }
      ?>
   </body>
</html>