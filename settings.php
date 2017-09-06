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
  
  //get user default values
  $selectSQL = "SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM users WHERE user_id='$user_id';";
  $sqlResult = mysql_query($selectSQL);
  if($sqlResult){
	  $row = mysql_fetch_array($sqlResult);
	  $monday = $row['monday'];
	  $tuesday = $row['tuesday'];
	  $wednesday = $row['wednesday'];
	  $thursday = $row['thursday'];
	  $friday = $row['friday'];
	  $saturday = $row['saturday'];
	  $sunday = $row['sunday'];
  }
  
  $error = $_REQUEST['error'];
  if ($error == 1){
	  $errorMessage = 'inline';
  }
  
?>

<!DOCTYPE html>
<html>
	<head>
		<title>AtletaFit</title>
		<link rel="stylesheet" href="css/signUp.css" type="text/css">
		<link rel="stylesheet" href="css/standard.css" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<style type="text/css">
			#errorMessage{
				display: <?php echo $errorMessage ?>
			}
		</style>
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
			<a href="settings.html" class='settings' id='active'>
				<p>
					Settings
				</p>
			</a>
		</header>
		<main id="main">
		<p class="header">Edit your account</p>
			<div id="form">
				<form action="editUser.php" onsubmit="return formCheck()" name="signUp" method="post">
					<p class="headers">
					Basics
					</p>
					<input type="radio" name="scale" value="Kilos" style="margin-left: 5%"><label>KG</label>
					<input type="radio" name="scale" value="Pounds" checked style="margin-left: 30%"><label>LB</label>
					<p class="headers">Change Password</p>
					<input type="password" name="oldPassword" placeholder="Current Password" id="currentPassword">
					<input type="password" name="newPassword1" placeholder="New Password" id="newPassword1">
					<input type="password" name="newPassword2" placeholder="Confirm Password" id="newPassword2">
					<p class="passwordError" id="password2Error">Your passwords don't match</p>
					<p style="margin-top: 40px;" class="headers">What days do you train and what muscles do you train on those days <span>(i.e. chest, back, biceps, full body, etc.)</span>
					</p>
					<div class="buttons">
						<div id="button1" class="end">Mo</div>
						<div id="button2">Tu</div>
						<div id="button3">We</div>
						<div id="button4">Th</div>
						<div id="button5">Fr</div>
						<div id="button6">Sa</div>
						<div id="button7" class="end">Su</div>
					</div>
					<div class="daysInput">
						<input type="text" value="<?php echo $monday ?>" placeholder="Monday Workout" name="monday" id="mondayInput">
						<input type="text" value="<?php echo $tuesday ?>" placeholder="Tuesday Workout" name="tuesday" id="tuesdayInput">
						<input type="text" value="<?php echo $wednesday ?>" placeholder="Wednesday Workout" name="wednesday" id="wednesdayInput">
						<input type="text" value="<?php echo $thursday ?>" placeholder="Thursday Workout" name="thursday" id="thursdayInput">
						<input type="text" value="<?php echo $friday ?>" placeholder="Friday Workout" name="friday" id="fridayInput">
						<input type="text" value="<?php echo $saturday ?>" placeholder="Saturdayday Workout" name="saturday" id="saturdayInput">
						<input type="text" value="<?php echo $sunday ?>" placeholder="Sunday Workout" name="sunday" id="sundayInput">
					</div>
						<input type="submit" value="Sign Up" name="submit" id="submit">
				</form>
			</div>
			<div id="errorMessage">
				<p>Sorry you entered the incorrect password for this account</p>
			</div>
		</main>
	</body>
	<script type="text/javascript">
	var height = new function(){
		var innerHeight = window.innerHeight;
		var mainHeight = innerHeight - 55;
		document.getElementById("main").style.height = mainHeight + "px";
	}
	
	
			//what days to show on form
			$('.buttons #button1').click(function (){
				$('.buttons #button1').toggleClass('clicked');
				$('.daysInput #mondayInput').toggle();
			});
			
			$('.buttons #button2').click(function (){
				$('.buttons #button2').toggleClass('clicked');
				$('.daysInput #tuesdayInput').toggle();
			});
			
			$('.buttons #button3').click(function (){
				$('.buttons #button3').toggleClass('clicked');
				$('.daysInput #wednesdayInput').toggle();
			});
			
			$('.buttons #button4').click(function (){
				$('.buttons #button4').toggleClass('clicked');
				$('.daysInput #thursdayInput').toggle();
			});
			
			$('.buttons #button5').click(function (){
				$('.buttons #button5').toggleClass('clicked');
				$('.daysInput #fridayInput').toggle();
			});
			
			$('.buttons #button6').click(function (){
				$('.buttons #button6').toggleClass('clicked');
				$('.daysInput #saturdayInput').toggle();
			});
			
			$('.buttons #button7').click(function (){
				$('.buttons #button7').toggleClass('clicked');
				$('.daysInput #sundayInput').toggle();
			});

			//form check values
			function formCheck(){
				var password = document.getElementById('newPassword1').value;
				var password2 = document.getElementById('newPassword2').value;
				if (password2 != password){
					document.getElementById('password2Error').style.display = "block";
					return false;
				}
			};
			
	</script>
</html>