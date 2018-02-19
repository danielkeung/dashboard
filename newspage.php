<?php session_start(); ?>
<?php
   if($_SESSION['username']!=null) {
      $img = $_GET['img'];
      $description = $_GET['description'];
   } else {
      echo '<script language="javascript">alert("you don\'t have permission to access");location="index.php";</script>';
   }
?>

<html>
   
   <head>
      <title>BBC News</title>
      <link rel="stylesheet" type="text/css" href="css/news/news.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
   </head>
   
   <body>
      <h1>News</h1></br>
      <img class="center" src="<?php echo $img;?>" height="200" width="400"></br>
      <h1>News Headline</h1>
      <h3><?php echo $description ?></h3>
   </body>
</html>