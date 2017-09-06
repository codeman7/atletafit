<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  //check if cookie is there and if so send off to profile
   $user_id = $_COOKIE['user_id'];
  if($user_id == NULL){
  		
	  header('Location: main.php');
	  mysql_close();
	  exit();
  }
  
  //get date variables
  $year = $_POST['year'];
  $month = $_POST['month'];
  $day = $_POST['day'];
  $date = $month . "-" . $day . "-" . $year;
  if($day == NULL){
	  $date = date("m-d-Y");
  }
  
  //get workout table with that date
  $workoutTableName = "workout_" . $user_id . "_" . $date;
  
  //get contents of workout sql statement
  $workoutContents = "SELECT exercise_name, set, reps, weight FROM $workoutTableName;";
  
  $SQLResult = mysql_query($workoutContents);
  mysql_close($conn);
  
 ?>

<!DOCTYPE html>
<html>
	<head>
		<title>AtletaFit</title>
		<link rel="stylesheet" href="css/standard.css" type="text/css">
		<link rel="stylesheet" href="css/workout.css" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<nav class="navigation">
				<a href="log.php">
					<p>
						Log
					</p>
				</a>
				<a href="profile.php">
					<p>
						Home
					</p>
				</a>
				<a href="do.php">
					<p>
						Do
					</p>
				</a>
			</nav>
			<div id='imageWrapper'>
				<img src='images/logo.png'>
			</div>
			<a href="settings.php" class='settings'>
				<p>
					Settings
				</p>
			</a>
		</header>
		<main id="main">
			<div class="container">
				<span class="headerLeft"><p>
				<span>4/24/14</span> Workout
				</p></span>
				<span class="headerRight">
				<p>Change Date</p>
					<form>
						<input type="text" name="month" id="month" value="4">/
						<input type="text" name="day" id="day" value="24">/
						<input type="text" name="year" id="year" value="14">
						<input type="submit" value="Submit" id="submit">
					</form>
				</span>
				<table>
					<tr>
						<td class="exerciseName">Exercise Name</td>
						<td>Set</td>
						<td>Reps</td>
						<td>Weight</td>
					</tr>
					<?php  
					
					if($SQLResult){
						while($row = mysql_fetch_array($SQLResult)){
							echo "<tr>";
							echo "<td class='exerciseName'>" . $row['exercise_name'] . "</td>";
							echo "<td>" . $row['set'] . "</td>";
							echo "<td>" . $row['reps'] . "</td>";
							echo "<td>" . $row['weight'] . "</td>";
							echo "</tr>";
						}
					}
					
					?>
					<tr>
						<td class="exerciseName">Squat</td>
						<td>1</td>
						<td>12</td>
						<td>225 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Squat</td>
						<td>2</td>
						<td>12</td>
						<td>235 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Squat</td>
						<td>3</td>
						<td>12</td>
						<td>245 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Squat</td>
						<td>4</td>
						<td>12</td>
						<td>255 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Deadlift</td>
						<td>1</td>
						<td>8</td>
						<td>275 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Deadlift</td>
						<td>2</td>
						<td>8</td>
						<td>295 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Deadlift</td>
						<td>3</td>
						<td>8</td>
						<td>315 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Leg Extension</td>
						<td>1</td>
						<td>10</td>
						<td>60 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Leg Extension</td>
						<td>2</td>
						<td>10</td>
						<td>70 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Leg Extension</td>
						<td>3</td>
						<td>10</td>
						<td>70 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Leg Curl</td>
						<td>1</td>
						<td>10</td>
						<td>70 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Leg Curl</td>
						<td>2</td>
						<td>10</td>
						<td>80 lbs</td>
					</tr>
					<tr>
						<td class="exerciseName">Leg Curl</td>
						<td>3</td>
						<td>10</td>
						<td>90 lbs</td>
					</tr>
				</table>
			</div>
		</main>
		<footer>
			<div id="ad1" align="center">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- largeBanner -->
			<ins class="adsbygoogle"
				style="display:inline-block;width:728px;height:90px"
				data-ad-client="ca-pub-3067703544770074"
				data-ad-slot="6348404408"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			</div>
			<div align="center" id="ad2">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- smallBanner -->
			<ins class="adsbygoogle"
				style="display:inline-block;width:468px;height:60px"
				data-ad-client="ca-pub-3067703544770074"
				data-ad-slot="5705616008"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</footer>
		<script type="text/javascript">
		var height = new function(){
		var innerHeight = window.innerHeight;
		var mainHeight = innerHeight - 155;
		document.getElementById("main").style.height = mainHeight + "px";
	}
		</script>
	</body>
</html>