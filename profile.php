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
  
  //get the date
  $date = date("m-d-Y");
  //get workout table with that date
  $workoutTableName = "workout_" . $user_id . "_" . $date;
  
 ?>

<!DOCTYPE html>
<html>
	<head>
		<title>AtletaFit</title>
		<link rel="stylesheet" href="css/standard.css" type="text/css">
		<link rel="stylesheet" href="css/profile.css" type="text/css">
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
				<a href="profile.php" id="active">
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
			<div class="workout">
				<p class="left">Today's Workout <span>Legs</span></p>
				<table>
					<tr>
						<td>Exercise Name</td>
						<td>Set</td>
						<td>Reps</td>
						<td>Weight</td>
					</tr>
					<?php  
						
						//workout SQL
						$getWorkoutContents = "SELECT exercise_name, set, reps, weight FROM $workoutTableName;";
						$workoutResult = mysql_query($getWorkoutContents);
						if($workoutResult){
							while($row = mysql_fetch_array($workoutResult)){
								echo "<tr>";
								echo "<td>" . $row['exercise_name'] . "</td>";
								echo "<td>" . $row['set'] . "</td>";
								echo "<td>" . $row['reps'] . "</td>";
								echo "<td>" . $row['weight'] . "</td>";
							}
						}
						
					?>
				</table>
			</div>
			<div class="pastWorkouts">
				<a href="workout.php">Past Workouts</a>
			</div>
			<div class="schedule">
				<p class="right">Week's Schedule</p>
				<table><?php
					//get week schedule
					 $selectQuery = "SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM user WHERE user_id = '$user_id';";
					 $weekResult = mysql_query($selectQuery);
					 if($weekResult){
						 $row = mysql_fetch_array($weekResult);
						 $monday = $row['monday'];
						 $tuesday = $row['tuesday'];
						 $wednesday = $row['wednesday'];
						 $thursday = $row['thursday'];
						 $friday = $row['friday'];
						 $saturday = $row['saturday'];
						 $sunday = $row['sunday'];
					 }

				
				?>
					<tr id="monday">
						<td>Monday</td>
						<td><?php echo $monday ?></td>
					</tr>
					<tr id="tuesday">
						<td>Tuesday</td>
						<td><?php echo $tuesday ?></td>
					</tr>
					<tr id="wednesday">
						<td>Wednesday</td>
						<td><?php echo $wednesday ?></td>
					</tr>
					<tr id="thursday">
						<td>Thursday</td>
						<td><?php echo $thursday ?></td>
					</tr>
					<tr id="friday">
						<td>Friday</td>
						<td><?php echo $friday ?></td>
					</tr>
					<tr id="saturday">
						<td>Saturday</td>
						<td><?php echo $saturday ?></td>
					</tr>
					<tr id="sunday">
						<td>Sunday</td>
						<td><?php echo $sunday ?></td>
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
	</body>
	<script type="text/javascript">
	var height = new function(){
		var innerHeight = window.innerHeight;
		var mainHeight = innerHeight - 155;
		document.getElementById("main").style.height = mainHeight + "px";
	}
	
	var date = new Date();
	var day = date.getDay();
	if(day == 1){
		$('#monday').addClass('day');
	} else if (day == 2){
		$('#tuesday').addClass('day');
	} else if (day == 3){
		$('#wednesday').addClass('day');
	} else if (day == 4){
		$('#thursday').addClass('day');
	} else if (day == 5){
		$('#friday').addClass('day');
	} else if (day == 6){
		$('#saturday').addClass('day');
	} else if (day == 7){
		$('#sunday').addClass('day');
	}
	
	/*var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var day = date.getDate();
	
	function daysInMonth(month, year){
		return new Date(year, month, 0).getDate();
	}
	var days = daysInMonth(month, year);
	/*
	for(var i = 1; i <= days; i++){
		if (i === day) {
			$('#calender').append('<div class="day active"><a href="workout.php?date=' +  month + '-' + i + '-' + year +'">' + i + '</a></div>');
			continue;
		}
		$('#calender').append('<div class="day"><a href="workout.php?date=' + month + '-' + i + '-' + year +'">' + i + '</a></div>');
		
	}
	
	var daysPlusOne = days + 1;
	var daysWidth = 100 / daysPlusOne; 
	var daysWidthPercent = daysWidth + "%";
	$(".day").css('width', daysWidthPercent);
	var dayHeight = $(".day").width();
	var dayHeightPixels = dayHeight + 'px';
	$(".day a").css('height', dayHeightPixels);
	$(".day a").css('line-height', dayHeightPixels);
	*/
	</script>
</html>