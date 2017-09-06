<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  $user_id = $_COOKIE['user_id'];
  if($user_id != NULL){
	  header('Location: profile.php');
	  mysql_close();
	  exit();
  }
  

  mysql_close($conn);
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<title>AtletaFit</title>
	</head>
	<body>
		<header>
			<div id="imageWrapper">
				<img src="images/logo.png" title="AtletaFit" alt="AtletaFit">
			</div>
			<div id="linksNav">
				<ul>
					<li id="signUp">
						<a href="signUp.php" class="link">Sign Up</a>
					</li>
					<li>
						<a href="signIn.php" class="link">Sign In</a>
					</li>
				</ul>
			</div>
		</header>
		<main>
			<div id="screenshot">
				<div id="leftScreenshot">
					<p>Take your workouts with you, on the go you can still track your workouts and track your progress.</p>
					<img src="images/appleBadge.png" title="Download iOS App">
				</div>
				<div id="rightScreenshot">
					<img src="images/iPhone.png" title="iOS App">
				</div>
			</div>
			<div id="features">
				<p id="header">Welcome to AtletaFit</p>
				<div>
					<p class="featureHeader">Calendar</p>
					<p class="featureExplaination">The calendar is a way of looking at your workouts from the past and being able to look at what workouts you have planned tomorrow, next week, or next month.</p>
				</div>
				<div>
					<p class="featureHeader">Log</p>
					<p class="featureExplaination">Plan your workouts for later or log one from the past. So you won't have to wonder what you did last time you were at the gym or carry around a notepad.</p>
				</div>
				<div>
					<p class="featureHeader">Mobile</p>
					<p class="featureExplaination">Take AtletaFit with you on your iOS device. So you can do your workout, log a workout during your day or check to see what you have planned on your way to the gym.</p>
				</div>
				<div>
					<p class="featureHeader">Do</p>
					<p class="featureExplaination">AtletaFit allows you to do you workout and track your rest periods each set, how many sets left, what weight to use, what exercise is up next, and much more.</p>
				</div>
			</div>
		</main>
		<!--<footer>
			<a href="about.html">About</a>
			<a href="contact.html">Contact</a>
			<a href="blog.php">Blog</a>
		</footer>-->
	</body>
</html>