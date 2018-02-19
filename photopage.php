<?php session_start(); ?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php

	if($_SESSION['username']!=null) {

	} else {
		echo '<script language="javascript">alert("you don\'t have permission to access");location="index.php";</script>';
	}
	
?>

<html>

   <head>
      <title>Photo</title>
      <link rel="stylesheet" type="text/css" href="css/photopage/photopage.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script type="text/javascript">
      		//add photo from local file
	      function addingPhoto(){
	      	var fileObj = document.getElementById('file-input');

			if (fileObj) {
			    var oFReader = new FileReader();
				oFReader.readAsDataURL(fileObj.files[0]);

				oFReader.onloadend = function (oFREvent) {
				    src = oFREvent.target.result;
				};
				
				oFReader.addEventListener('loadend', (e) => {
				  const blobTxt = e.srcElement.result;
				  $.post("createphoto.php", { image: blobTxt, username: '<?php echo $_SESSION['username'] ?>' } ,
                  function(data) {
                     eval(data);
                  });
				});
			}
		  }
      </script>
   </head>

    <body>
      	<h1>Photos</h1>
	 	<table class="photoTable" width="100%">
	 		<tr>
	 			<td width="33%">
	 			</td>
				<td width="33%">
	 			</td>
				<td width="33%">
	 			</td>
	 		</tr>
		 	<?php 
				include "DB_config.php";
				// Create connection
				$conn = new mysqli($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				} 

				$sql = "SELECT user_id, img FROM photo WHERE user_id = '" . $_SESSION['username'] . "'";
				$result = $conn->query($sql);
               	$img = array();
               	$cnt = 1;
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
                       $img[$cnt] = $row["img"];
                       $cnt++;
				    }
				}

				$num = 0;
				// output all the photos by using looping
		 		for ($x = 1; $x <= (count($img) + 1); $x++) {		 		
					if($x==1) {
						echo "<tr>";
						echo '<td>';
						echo '<div class="containerfirst">';
						echo '<label for="file-input">';
						echo '<img id="addedPhoto" name="addedPhoto" class="addingfirst" src="../../Assets/Plus_button.png" alt="Norway"/>';
						echo '</label>';
						echo '<input id="file-input" class="file-input" type="file" accept="image/x-png,image/gif,image/jpeg" onchange="addingPhoto()"/>';
						echo "</div>";
						echo "</td>";
					} else if( ($x - 1) % 3 == 0  && $x != 1) {
						echo "<tr>";
						echo '<td>';
						echo '<div class="container">';
						echo '<img id="img'. $num . '" class="adding" src="" alt="Norway">';
						echo "</div>";
						echo "</td>";
					} else if( $x % 3 == 0) {
						echo '<td>';
						echo '<div class="container">';
						echo '<img id="img'. $num . '" class="adding" src="" alt="Norway">';
						echo "</div>";
						echo "</td>";
						echo "</tr>";
					} else {
						echo '<td>';
						echo '<div class="container">';
						echo '<img id="img'. $num . '" class="adding" src="" alt="Norway">';
						echo "</div>";
						echo "</td>";
						if($x==5) {
							echo "</tr>";
						}
					}
					
					$num++;
				}
		 	?>
		</table>
		<script>
			var imgArr = $.map(<?php echo json_encode($img); ?>, function(value, index) {
			    return [value];
			});

			//displaying photo using encode/decode
			if (imgArr) {
			    var imgid = 1;
			    for(var i = 0; i < imgArr.length; i++) {
				    var oFReader = new FileReader();
			    	oFReader.readAsDataURL(Base64ToBlob(imgArr[i]));
					oFReader.onloadend = function (oFREvent) {
				    	src = oFREvent.target.result;
				    	document.getElementById('img'+ imgid).src = src;
						imgid++;
					};
			    }
			}

		    function Base64ToBlob(b64Data, contentType = "image/png", sliceSize = 512)
		    {
		        const byteCharacters = atob(b64Data.split(",").pop());
		        const byteArrays = [];

		        for (let offset = 0; offset < byteCharacters.length; offset += sliceSize)
		        {
		            const slice = byteCharacters.slice(offset, offset + sliceSize);
		            const byteNumbers = new Array(slice.length);

		            for (let i = 0; i < slice.length; i++)
		            {
		                byteNumbers[i] = slice.charCodeAt(i);
		            }

		            const byteArray = new Uint8Array(byteNumbers);
		            byteArrays.push(byteArray);
		        }

		        const blob = new Blob(byteArrays, { type: contentType });
		        return blob;
		    }
		</script>
    </body>
 </html>