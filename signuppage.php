<html>

   <head>
      <title>Sign Up</title>
      <link rel="stylesheet" type="text/css" href="css/signuppage/signuppage.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
   </head>

    <body>
      	 <h1>Hackathon</h1>
         <form class = "form-signup" role = "form" 
            action = "signup.php" method = "post">
			<table class="signuptable">
			  <tr>
			    <td>
	               <input class="signupinput" type = "text"
	                  name = "username" placeholder = "Username" 
	                  required autofocus>
			    </td>
			    <td>               
			    	<input class="signupinput" type = "email"
                  name = "email" placeholder = "Email" required>
              	</td> 
			  </tr>
			  <tr>
			    <td>
	               <input class="signupinput" type = "password"
	                  name = "password" placeholder = "Password" 
	                  required autofocus>
			    </td>
			    <td>               
			    	<input class="signupinput" type = "password"
                  name = "confirmpassword" placeholder = "Confirm password" required>
              	</td> 
			  </tr>
			  <tr>
			    <td colspan="2">
			    	<div class="container">
		    		  <img id="addedPhoto" src="../../Assets/Add_picture.png" alt="Norway"
		    		  onclick="">
					  <div class="centered">Add photo</div>
					</div>
			    </td>
			  </tr>
			  <tr>
			    <td colspan="2">
					<INPUT type="submit" class="myButton" value="">
			    </td>
			  </tr>
			</table>
         </form>
    </body>
 </html>