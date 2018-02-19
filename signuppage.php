<html>

   <head>
      <title>Sign Up</title>
      <link rel="stylesheet" type="text/css" href="css/registerpage/registerpage.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
      <script>
	      function addingPhoto(){
	      	var fileObj = document.getElementById('file-input');

	      	var divimageArea = document.getElementById('imageArea');
			if (fileObj) {
			    //document.getElementById('addedPhoto').src = fullPath;
			    document.getElementById('txtAddPhoto').hidden = true;

			    var oFReader = new FileReader();
				oFReader.readAsDataURL(fileObj.files[0]);

				oFReader.onloadend = function (oFREvent) {
				    src = oFREvent.target.result;
				    document.getElementById('addedPhoto').src = src;
				};

				oFReader.addEventListener('loadend', (e) => {
				  const blobTxt = e.srcElement.result;
			        var text = document.createElement('div');
				    text.innerHTML = "<input name='image' type='hidden' value='"+ blobTxt +"' />";
				    divimageArea.appendChild(text);
				});
			}
		  }
      </script>
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
			    	<div id="imageArea" class="container image-upload">
	    		      <label for="file-input">
						<img id="addedPhoto" name="addedPhoto" class="addedPhoto" src="../../Assets/Add_picture.png" alt="Norway"/>
					  </label>
					  <input id="file-input" class="file-input" type="file" accept="image/x-png,image/gif,image/jpeg" onchange="addingPhoto()"/>
					  <div id="txtAddPhoto" class="centered">Add photo</div>
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