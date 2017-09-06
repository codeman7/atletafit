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

?>

<!DOCTYPE html>
<html>
	<head>
		<title>AtletaFit</title>
		<link rel="stylesheet" href="css/standard.css" type="text/css">
		<link rel="stylesheet" href="css/log.css" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<nav>
				<a href="log.php" id="active">
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
			<form method="post" name="logForm" action="logWorkout.php">
				<input type="text" name="setsAndReps" id='setsCount'>
				<table id="newSet" class="container">
					<tr id="firstRow">
						<td class="exercise">Exercise Name</td>
						<td class="sets">Set</td>
						<td class="reps">Reps</td>
						<td class="weight">Weight</td>
						<td class="rest">Rest Period</td>
					</tr>
					<tr>
						<td class="exercise">
							<input type="text" placeholder="Exercise Name" name="exercise1Set1Name" class="exerciseNameInput" id="exercise1NameSet1">
						</td>
						<td class="sets" id='exercise1Set1'>1</td>
						<td class="reps">
							<input type="text" placeholder="Number of Reps" name="exercise1Set1Reps" class='exerciseReps' id="exercise1RepsSet1">
						</td>
						<td class="weight">
							<input type="number" placeholder="Weight Used" name="exercise1Set1Weight" class='exerciseWeight' id="exercise1RestSet1">
						</td>
						<td class="rest">
							<input type='number' placeholder="Number of Seconds" name="exercise1Set1Rest" class='exerciseRest' id="exercise1WeightSet1">
						</td>
					</tr>
				</table>
				<div id="buttons">
					<div id="addSet" class="exerciseAddSet">
						<p>Add Set</p>
					</div>
					<div id="addExercise" class="addExerciseButton">
						<p>Add Exercise</p>
					</div>
				</div>
			</form>
		</main>
		<footer>
			<div align="center" id="ad1">
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
	// function to set height of body
	var height = new function(){
		var innerHeight = window.innerHeight;
		var mainHeight = innerHeight - 155;
		document.getElementById("main").style.height = mainHeight + "px";
	}
	
	
	
	
	var setsAndReps = [];
	
		$('#form').submit(function() {
			setsAndReps.push(newSetCount);
			document.getElementById('setsCount').value = setsAndReps;
  
  		});
		
	
			
		// i = exercise count
		var i = 1;
		var addSetMargin = 0;
		//function to raise exercise count and write new section for new exercise
		$('.addExerciseButton').click(function(){
			//fast enumeration of i
			i++;
			//what to html to add to input new exercise
			$('table').append('<tr><td class=\'exercise\'><input type=\'text\' placeholder=\'Exercise Name\' class=\'exerciseNameInput\' id=\'exercise' + i + 'NameSet1\' name=\'exercise' + i + 'Set1Name\'></td><td class=\'sets\'>1</td><td class=\'reps\'><input type=\'text\' placeholder=\'Number of Reps\' class=\'repsInput\' name=\'exercise' + i + 'Set1Reps\' id=\'exercise' + i + 'RepsSet1\'></td><td class=\'weight\'><input type=\'number\' placeholder=\'Weight Used\' class=\'weightInput\' name=\'exercise' + i + 'Set1Weight\' id=\'exercise' + i + 'WeightSet1\'></td><td class=\'rest\'><input type=\'number\' placeholder=\'Rest Period\' class=\'restInput\' name=\'exercise' + i + 'Set1Rest\' id=\'exercise' + i + 'RestSet1\'></td></tr>');
			setsAndReps.push(newSetCount);
			//if setsAndReps starts with 1 then replace it with 1
			if(setsAndReps[0] == 1){
				setsAndReps[0] = '1';
			}
			//set repsAndSets to setsCount input and retrieve in next page
			document.getElementById('setsCount').value = setsAndReps;
			//reset set count back to 1 after new exercise is added
			newSetCount = 1;
			
		});
		
			




			//add set on click + button
		var newSetCount = document.getElementById('exercise' + i + 'Set1').innerHTML;
		var oldSetCount = newSetCount;
		$('.exerciseAddSet').click(function(){
			//set count fast enumeration
			newSetCount++;
			
			//get exercise value
			//have to use eval to create dynamic variable names
			var exerciseName = document.getElementById('exercise' + i + 'NameSet1').value;
			var exerciseReps = document.getElementById('exercise' + i + 'RepsSet1').value;
			var exerciseRest = document.getElementById('exercise' + i + 'RestSet1').value;
			var exerciseWeight = document.getElementById('exercise' + i + 'WeightSet1').value;

			//html to add
			$('table').append('<tr><td class=\'exercise\'>' + exerciseName + '</td><td class=\'sets\'>' + newSetCount + '</td><td class=\'reps\'><input type=\'text\' placeholder=\'Number of Reps\' class=\'repsInput\' name=\'exercise' + i + 'Set' + newSetCount + 'Reps\' id=\'exercise' + i + 'RepsSet' + newSetCount + '\' value=\'' + exerciseReps + '\'></td><td class=\'weight\'><input type=\'number\' placeholder=\'Weight Used\' class=\'weightInput\' name=\'exercise' + i + 'Set' + newSetCount + 'Weight\' id=\'exercise' + i + 'WeightSet' + newSetCount + '\' value=\'' + exerciseWeight + '\'></td><td class=\'rest\'><input type=\'number\' placeholder=\'Rest Period\' class=\'restInput\' name=\'exercise' + i + 'Set' + newSetCount + 'Rest\' id=\'exercise' + i + 'RestSet' + newSetCount + '\' value=\'' + exerciseRest + '\'></td></tr>');
			
			
		});	
	
	</script>
</html>