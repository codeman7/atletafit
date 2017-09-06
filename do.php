<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  //check if cookie is there and if so send off to profile
   $user_id = $_COOKIE['user_id'];
  /*if($user_id == NULL){
  		
	  header('Location: main.php');
	  mysql_close();
	  exit();
  }*/
  
  
   //get date
  $date = date("m-d-Y");
  
  //get table name
  $workoutTableName = "workout_" . $user_id . "_" . $date;
  
  //get workout query
  $selectSQL = "SELECT exercise_name, reps, set, weight, rest_period FROM $workoutTableName;";
  
  //run query
  $selectResult = mysql_query($selectSQL);
 
  
  
?>

<!DOCTYPE html>
<html>
	<head>
		<title>AtletaFit</title>
		<link rel="stylesheet" href="css/standard.css" type="text/css">
		<link rel="stylesheet" href="css/do.css" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<nav>
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
				<a href="do.php" id="active">
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
		<main>
			<div class="countdown" id='countdown'>
				<p id='counter'></p>
			</div>
			<div id="workout">
				<?php 
					$restArray = array();
					$iteration = 1;
					if($selectResult){
						(while($row = mysql_fetch_array($selectResult)){
							array_push($restArray, $row['rest_period']);
							if($iteration == 1){
								echo '<div class="exercise active" id="set' . $row['set'] . '"><p class="exerciseName>' . $row['exercise_name'] . '</p><p class="reps">Reps: ' . $row['reps'] . '</p><p class="weight">Weight: ' . $row['weight'] . '</p><div class="approval"><div class="badSet" id="badSet" title="Edit / Delete">X</div><div class="goodSet" id="goodSet" title="Good Set">&#10003;</div></div></div>';
							} else{
								echo '<div class="exercise" id="set' . $row['set'] . '"><p class="exerciseName">' . $row['exercise_name'] . '</p><p class="reps">Reps: ' . $row['reps'] . '</p><p class="weight">Weight: ' . $row['weight'] . '</p></div>';
							}
							$iteration++;
						}
					}
				
				?>
				<div class="exercise active" id="set1">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
					<div class="approval">
						<div class="badSet" id="badSet" title="Edit / Delete">X</div>
						<div class="goodSet" id='goodSet' title="Good Set">&#10003;</div>
					</div>
				</div>
				<div class="exercise" id="set2">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 15</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise" id="set3">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 20</p>
					<p class="weight">Weight: 225</p>
					
				</div>
				<div class="exercise" id="set4">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise" id="set5">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise" id="set6">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise" id="set7">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise" id="set8">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise" id="set9">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise" id="set10">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
				<div class="exercise lastSet" id="set11">
					<p class="exerciseName">Bench Press</p>
					<p class="reps">Reps: 12</p>
					<p class="weight">Weight: 225</p>
				</div>
			</div>
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
		<script type="text/javascript">
		
		var pageHeight = window.outerHeight;
		var height = pageHeight - 46;
		var marginHeight = height / 2;
		document.getElementById('countdown').style.height = height + 'px';
		//var restPeriods = [12, 100, 110];
		var restPeriods = [<?php echo json_encode($restArray) ?>]
		
		var i = 1;
		var goodSet = document.getElementById('goodSet');
		$(goodSet).click(function(){
			var currentSet = document.getElementById('set' + i);
			$(currentSet).removeClass('active').addClass('done');
			$('.approval').remove();
			$('.countdown').show();
			var x = i - 1;
			var count = restPeriods[x];
			var counter = setInterval(countdown, 1000);
			function countdown(){
			count=count-1;
			if(count < 0){
				clearInterval(counter);
				return;
			} else if (count == 0){
				document.getElementById('countdown').style.display = 'none';
			}
			var minutes = Math.floor(count / 60);
			var seconds = count % 60;
			if(seconds < 10){
				document.getElementById('countdown').innerHTML = '<p id="counter">' + minutes + ':0' + seconds + '</p>';
			} else{
				document.getElementById('countdown').innerHTML = '<p id="counter">' + minutes + ':' + seconds + '</p>';

			}
			document.getElementById('counter').style.height = height + 'px';
			document.getElementById('counter').style.lineHeight = height + 'px';
		}
			i++;
			var nextSet = document.getElementById('set' + i);
			$(nextSet).addClass('active');
			$(nextSet).append('<div class="approval"><div class="badSet" title="Edit / Delete">X</div><div class="goodSet" id="goodSet" title="Good Set">&#10003;</div></div>');
			
		});
		
		$('#workout').delegate('#goodSet', 'click', function(){
			var currentSet = document.getElementById('set' + i);
			$(currentSet).removeClass('active').addClass('done');
			$('.approval').remove();
			$('.countdown').show();
			var x = i - 1;
			var count = restPeriods[x];
			var counter = setInterval(countdown, 1000);
			function countdown(){
			count=count-1;
			if(count < 0){
				clearInterval(counter);
				return;
			} else if (count == 0){
				document.getElementById('countdown').style.display = 'none';
			}
			var minutes = Math.floor(count / 60);
			var seconds = count % 60;
			if(seconds < 10){
				document.getElementById('countdown').innerHTML = '<p id="counter">' + minutes + ':0' + seconds + '</p>';
			} else{
				document.getElementById('countdown').innerHTML = '<p id="counter">' + minutes + ':' + seconds + '</p>';

			}
			document.getElementById('counter').style.height = height + 'px';
			document.getElementById('counter').style.lineHeight = height + 'px';
		}
			i++;
			var nextSet = document.getElementById('set' + i);
			$(nextSet).addClass('active');
			$(nextSet).append('<div class="approval"><div class="badSet" title="Edit / Delete">X</div><div class="goodSet" id="goodSet" title="Good Set">&#10003;</div></div>');
		});
		
		
		//var count = restPeriods[0];
		//var counter=setInterval(countdown, 1000);
		/*function countdown(){
			count=count-1;
			if(count < 0){
				clearInterval(counter);
				return;
			} else if (count == 0){
				document.getElementById('countdown').style.display = 'none';
			}
			var minutes = Math.floor(count / 60);
			var seconds = count % 60;
			if(seconds < 10){
				document.getElementById('countdown').innerHTML = '<p id="counter">' + minutes + ':0' + seconds + '</p>';
			} else{
				document.getElementById('countdown').innerHTML = '<p id="counter">' + minutes + ':' + seconds + '</p>';

			}
			document.getElementById('counter').style.height = height + 'px';
			document.getElementById('counter').style.lineHeight = height + 'px';
		}
		*/
		
		
				
		</script>
	</body>
</html>