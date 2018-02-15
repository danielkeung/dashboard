<?php session_start(); ?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
	require("getBBCNewsFeed.php");
	//get news
	$bbcJson = getFeed("http://feeds.bbci.co.uk/news/rss.xml");
	$title = $bbcJson['title'];
	$img = $bbcJson['img'];
	$description = $bbcJson['description'];

	if($_SESSION['username']!=null) {
		//here tohardcode the ip first.
	    $ipAddress = "86.18.75.149";
		//$ipAddress = get_client_ip();
	    $ip_key = "2b62443142178e882ef6389d97b6c4b0df2414add4683649bb337c8d2f4f8b35";

	    $query = "http://api.ipinfodb.com/v3/ip-city/?key=" . $ip_key . "&ip=" . $ipAddress . "&format=json";
	    $json = file_get_contents($query);
	    $data = json_decode($json, true);
	     //get JSON
		 $json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?lat=' . $data['latitude'] . '&lon=' . $data['longitude'] . '&appid=2fe7c5e39a9419bbb2da7d3f59363ac7');
		 $data = json_decode($json,true);

		 //show data
		 //var_dump($data);

		 //description
		 $weather = $data['weather'][0]['main'];
		 $city = $data['name'];
		 $temp = $data['main']['temp'];
	} else {
		echo '<script language="javascript">alert("you don\'t have permission to access");location="index.php";</script>';
	}
	
    function get_client_ip() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    echo $ip;
	    return $ip;
	}
?>

<html>

   <head>
      <title>Testing</title>
      <link rel="stylesheet" type="text/css" href="css/hmpage/hmpage.css">
      <link rel="stylesheet" type="text/css" href="css/bgimage.css">
	    <!--Load the AJAX API-->
	    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <script type="text/javascript">

	      // Load the Visualization API and the corechart package.
	      google.charts.load('current', {'packages':['corechart']});

	      // Set a callback to run when the Google Visualization API is loaded.
	      google.charts.setOnLoadCallback(drawChart);

	      // Callback that creates and populates a data table,
	      // instantiates the pie chart, passes in the data and
	      // draws it.
	      function drawChart() {
		        // Create the data table.
		        var data = new google.visualization.DataTable();
		        data.addColumn('string', 'Topping');
		        data.addColumn('number', 'Slices');
		        data.addRows([		<?php
			$payload = array();
	      	$json = file_get_contents('https://therapy-box.co.uk/hackathon/clothing-api.php?username=swapnil');
			$obj = json_decode($json);
			$arr = $obj->payload;
			$cnt = 1;
			foreach ($arr as $key => $val) {
				foreach ($val as $key2 => $val2) {
					if($key2=="clothe") {
						$payload[$cnt] = $val2;
						$cnt++;
					}
				}
			}

			$i = 0;
			$len = count(array_count_values($payload));
			foreach (array_count_values($payload) as $key3 => $value3) {
				if ($i == $len - 1) {
					echo '["'. $key3 . '", '. $value3 .' ]';
			    } else {
			    	echo '["'. $key3 . '", '. $value3 .' ],';
			    }
			    $i++;
			}

		?>
		        ]);

		        // Set chart options
		        var options = {'title':'',
		                       'width':300,
		                       'height':220};

		        // Instantiate and draw our chart, passing in some options.
		        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		        chart.draw(data, options);
	      }
	    </script>
   </head>

    <body>
      	<h1>Good Day <?php echo $_SESSION['username']?></h1>
	 	<table class="mainpagecontainer">
		  <tr>
		    <td>
		    	<div class="container">
	    		  <img id="weather" src="../../Assets/Container.png" alt="Norway" style="width:100%;"
	    		  onclick="">
			      <div class="bottom"><?php echo $city ?></div>
				  <div class="top">Weather</div>
				  <div class="right"><?php echo $temp ?> </br> degrees</div>
				  <div class="left">
				  	<?php 
				  		if($weather==='Clouds')
				  			echo "<img src=\"../../Assets/Clouds_icon.png\" alt=\"Norway\" style=\"width:100%;\"";
				  		else if($weather==='Rain')
				  			echo "<img src=\"../../Assets/Rain_icon.png\" alt=\"Norway\" style=\"width:100%;\"";
				  		else
				  			echo "<img src=\"../../Assets/Sun_icon.png\" alt=\"Norway\" style=\"width:100%;\"";
				  	?>
				  </div>
				</div>
		    </td>
		    <td>               
		    	<div class="container">
	    		  <img id="weather" src="../../Assets/Container.png" alt="Norway" style="width:100%;"
	    		  onclick="document.location.href='newspage.php?description=<?php echo $description; ?>&img=<?php echo $img; ?>'">
				  <div class="top">News</div>
			      <div class="center">News headline</div>
				  <div class="centerbottom"><?php echo $title ?></div>
				</div>
	      	</td> 
		    <td>               
		    	<div class="container">
	    		  <img id="weather" src="../../Assets/Container.png" alt="Norway" style="width:100%;"
	    		  onclick="document.location.href='sport.php'">
	  			  <div class="top">Sport</div>
			      <div class="center">Sport headline</div>
				  <div class="centerbottom">A team did very well at something. They scored 3 goals.</div>
				</div>
	      	</td> 
		  </tr>
		  <tr>
		    <td>
		    	<div class="container">
	    		  <img id="weather" src="../../Assets/Container.png" alt="Norway" style="width:100%;"
	    		  onclick="">
				  <div class="top">Photos</div>
				</div>
		    </td>
		    <td>               
		    	<div class="container">
	    		    <img id="weather" src="../../Assets/Container.png" alt="Norway" style="width:100%;"
	    		    onclick="document.location.href='tasks.php'">
				    <div class="top">Tasks</div>
			  		<div class="tdlt">
			  			Task 1
			  		</div>
			  		<div class="tdrt">
			  			<img src="../../Assets/Plus_button_small.png" alt="Norway" height="30" width="30">
			  		</div>
			  		<div class="tdlt2">
			  			Task 2
			  		</div>
			  		<div class="tdrt2">
			  			<img src="../../Assets/Plus_button_small.png" alt="Norway" height="30" width="30">
			  		</div>
			  		<div class="tdlt3">
			  			Task 3
			  		</div>
			  		<div class="tdrt3">
			  			<img src="../../Assets/Plus_button_small.png" alt="Norway" height="30" width="30">
			  		</div>
			  	</div>
	      	</td> 
		    <td>               
		    	<div class="container">
	    		  <img id="weather" src="../../Assets/Container.png" alt="Norway" style="width:100%;"
	    		  onclick="">
				  <div class="top">Clothes</div>
				  <div class="whole" id="chart_div"></div>
				</div>
	      	</td> 
		  </tr>
		</table>
    </body>
 </html>