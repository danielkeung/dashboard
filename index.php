<html>
   
   <head>
      <title>Login</title>
      <link rel="stylesheet" type="text/css" href="css/loginpage/loginpage.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
   </head>
   
   <body>
      
      <h1>Hackathon</h1>
      <div class = "container form-signin">
         
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
            
               if ($_POST['username'] == 'Swapnil' && 
                  $_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'Swapnil';
                  
                  echo '<script language="javascript">alert("You have entered valid use name and password")</script>';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      <div class = "container">
         <form class = "form-signin" role = "form" 
            action = "logincheck.php"
             method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <div class="logininput">
               <input type = "text"
                  name = "username" placeholder = "Username" 
                  required autofocus>
               <input type = "password"
                  name = "password" placeholder = "Password" required>
            </div></br>
            </br>
            <INPUT type="submit" class="myButton" value="">
         </form>
         </br> 
         <p class="footer"><span>New to the Hackathon?</span><a href = "signuppage.php" tite = "signup">Sign up</a></p>
      </div> 
      
   </body>
</html>