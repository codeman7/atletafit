<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  //check if cookie is there and if so send off to profile
   $user_id = $_COOKIE['user_id'];
  if($user_id != NULL){
  		
	  header('Location: profile.php');
	  mysql_close();
	  exit();
  }
  
  if(isset($_POST['email'])){
  //if they try and login get creditials
  	$email = trim(strtolower($_POST['email']));
  	$password = trim(strtolower($_POST['password']));
  	$cryptPassword = crypt($password, $email);
  
  	$selectQuery = "SELECT user_id FROM users WHERE email='$email' AND password ='$cryptPassword';";
  	$result = mysql_query($selectQuery);
  	if(mysql_num_rows($result) == 1){
	   $result = mysql_fetch_array($queryResult);
			  $user_id = $result['user_id'];
			  setcookie('user_id', $user_id);
			  header('Location: profile.php');
			  mysql_close();
			  exit();
	} else {
	  $error = 'inline';
	}
  }

  mysql_close($conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/signIn.css" type="text/css">
		<title>AtletaFit</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<style type="text/css">
			#errorMessage{
				display: <?php echo $error ?>
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
						<a href="signUp.php" class="link">Sign Up</a>
					</li>
				</ul>
			</div>
		</header>
		<main>
			<p class="header">Sign In</p>
			<div id="form">
				<form action="signIn.php" method="post" name="signIn">
					<p>Email</p>
					<input type="email" placeholder="Email" id="emailInput" name="email">
					<p>Password</p>
					<input type="password" placeholder="Password" id="passwordInput" name="password">
					<input type="submit" id="submit" value="Sign In" name="submit">
				</form>
			</div>
			<div id="errorMessage">
				<p>
				Sorry we could not find a account with that email and password
				</p>
			</div>
		</main>
	</body>
</html>