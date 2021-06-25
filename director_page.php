<html>
	<head>
    <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
	<script type = "text/JavaScript">
	 <!--
		function AutoRefresh( t ) {
		   setTimeout("location.reload(true);", t);
		}
	 //-->
	</script>
	</head>
<h1> PAGE FOR DIRECTOR BOARD </h1>
<body onload = "JavaScript:AutoRefresh(<?php echo $sec*1000; ?>);">    
	<div class="header">     
      <div class="container">
          <div class="navbar">
           <div class="logo">
               <a href="index.php"><image src="toy1.png" width="125px"></image></a>
           </div>
           <nav>
               <ul id="MenuItems">
                   <li><a href="logout.php">Log Out</a></li>
               </ul>
           </nav>
              </div>
       <div class="row">
           <div class="col-2">
               <h1>ATN Toy Stores !</h1> 
               <p>It's the best toys store ever.</p>
               <a href="" class="btn"> &#9758; Explore Now </a>
           </div>
       </div>
      </div>
    </div> 
	<form action="" method="post">
         <select name = "refresh_time">
            <option value =10>10 second</option>
            <option value = 20>20 second</option>
            <option value = 30 selected>30 second</option>
         </select><br/>
		<input type="submit" name="timerButton" value="Set time"/>
    </form> 
	<?php
		$sec = 5;
		if(isset($_POST['timerButton'])) 
			{ 
				//get input text
				$sec = $_POST['refresh_time'];
			}
		echo "This page will reload itself in $sec second!";
	?>
	<form action="" method="post">
		<p> Select shop's database you want: <p/> 
         <select name = "db_selection">
            <option value = "SHOP_A" >Shop A</option>
            <option value = "SHOP_B">Shop B</option>
            <option value = "ALL" selected>All shops</option>
         </select><br/>
		<input type="submit" name="submitButton" value="Submit"/>
    </form>    

	<?php
		session_start();
		function exceptions_error_handler($severity, $message, $filename, $lineno) 
		{
			throw new ErrorException($message, 0, $severity, $filename, $lineno);
		}

		set_error_handler('exceptions_error_handler');
		$input = "ALL";
		$table_name = "product";
		include("local_config.php");
		include("db_display.php");
		//check if form was submitted
		if(isset($_POST['submitButton'])) 
		{ 
			//get input text
			$input = $_POST['db_selection'];
		}
		# Try to display SQL table
		try 
		{
			echo "<p> DATABASE FROM ".$input."</p>"; 
			$pg_heroku = pg_connect($conn_string);
											
			if ($input == "ALL")
			{
				# Get data by query
				$result = pg_query($pg_heroku, "select * from ".$table_name);
			}
		
	else 
			{
				$result = pg_query($pg_heroku, "select * from ".$table_name." where shop_name='$input'");
			}
			display_table($result);
			pg_close();
		}
		catch (Exception $e) 
		{
			#echo 'Caught exception: ',  $e->getMessage(), "\n";
			echo "Caught exception: <br/>", $e->getMessage(), "\n";
		}
	?>
	<br></br>
	 
	<br/>
	<?php
		
	if($_SESSION["name"]) {
	?>
	Click here to <a href="logout.php" title="Logout">Logout.
	<?php
	}else echo "<h1>Please login first .</h1>";
	?>
		<!---------------footer--------->
       <div class="footer">
           <div class="container">
               <div class="row">
                   <div class="footer-col-4">
                       <h3>Contatct Us</h3>
                       <ul>
                           <li>Feedback</li>
                           <li>Introduce</li>
                           <li>Advertisement</li>
                       </ul>
                   </div>
                   <div class="footer-col-2">
                       <p>Our Purpose is to Sustainably Make the Pleasure and Benefits of Foods Accesible to the Many.</p>
                   </div>
                   
                   <div class="footer-col-4">
                       <h3>Follow Us</h3>
                       <ul>
                           <li>Facebook</li>
                           <li>Instagram</li>
                           <li>Twitter</li>
                           <li>Youtube</li>
                       </ul>
                   </div>
               </div>
               <hr>
               <p class="copyright">Made by Nguyen Thach Bao Chung </p>
           </div>
       </div> 
</body>
</html>
