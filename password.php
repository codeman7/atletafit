<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  
  $error = $_REQUEST['error'];
  if($error == 1){
	  $errorMessage = 'inline';
	  $errorText = 'We could not find any accounts with that email, we appologize';
  } else if ($error == 2){
	  $errorMessage = 'inline';
	  $errorText = 'Something went wrong. We apologize for the inconvenience, and have a team working on this issue';
  }
  

  mysql_close($conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/signUp.css" type="text/css">
		<title>AtletaFit</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<style type="text/css">
			#errorMessage{
				display: <?php echo $errorMessage ?>
			}
		</style>
	</head>
	<body>
		<header>
			<div id="imageWrapper">
				<a href="main.php">
					<img src="images/logo.png" title="AtletaFit" alt="AtletaFit">
				</a>
			</div>
			<div id="linksNav">
				<ul>
					<li>
						<a href="signIn.php" class="link">Sign In</a>
					</li>
				</ul>
			</div>
		</header>
		<main>
			<p class="header">Reset Your Password</p>
			<div id="form">
				<form action="resetPassword.php" method="post" name="password">
					<input type="email" placeholder="Email" name="email" id="emailInput">
					<input type="submit" value="Reset" name="submit" id="submit">
				</form>
			</div>
			<div id="errorMessage">
				<p><?php echo $errorText ?></p>
			</div>
		</main>
	</body>
</html>