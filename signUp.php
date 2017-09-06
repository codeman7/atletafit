<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  
  $error = $_REQUEST['error'];
  if($error == 1){
	  $errorMessage = 'inline';
	  $errorText = 'Sorry you did not fill out every part of the form';
  } else if ($error == 2){
	  $errorMessage = 'inline';
	  $errorText = 'Sorry that email is already assigned to an account <br><a href="password.php">Reset Password</a>';
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
			<p class="header">Create your account</p>
			<div id="form">
				<form action="addUser.php" onsubmit="return formCheck()" name="signUp" method="post">
					<p class="headers">
					Basics
					</p>
					<input type="email" placeholder="Email" name="email" id="emailInput">
					<p class="emailError" id="emailError">Please fill out the email field</p>
					<input type="password" placeholder="Password" name="password" id="passwordInput">
					<p class="passwordError" id="password1Error">Please fill out the password field</p>
					<input type="password" placeholder="Confirm Password" name="password2" id="password2Input">
					<p class="passwordError" id="password2Error">Your passwords don't match</p>
					<input type="radio" name="scale" value="k" style="margin-left: 5%"><label>KG</label>
					<input type="radio" name="scale" value="l" checked style="margin-left: 30%"><label>LB</label>
					<p style="margin-top: 30px;" class="headers">
					What days do you train and what muscles do you train on those days <span>(i.e. chest, back, biceps, full body, etc.)</span>
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
						<input type="text" placeholder="Monday Workout" name="monday" id="mondayInput">
						<input type="text" placeholder="Tuesday Workout" name="tuesday" id="tuesdayInput">
						<input type="text" placeholder="Wednesday Workout" name="wednesday" id="wednesdayInput">
						<input type="text" placeholder="Thursday Workout" name="thursday" id="thursdayInput">
						<input type="text" placeholder="Friday Workout" name="friday" id="fridayInput">
						<input type="text" placeholder="Saturdayday Workout" name="saturday" id="saturdayInput">
						<input type="text" placeholder="Sunday Workout" name="sunday" id="sundayInput">
					</div>
						<input type="submit" value="Sign Up" name="submit" id="submit">
				</form>
			</div>
			<div id="errorMessage">
				<p><?php echo $errorText ?></p>
			</div>
		</main>
		<script type="text/javascript">
		
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
				var email = document.getElementById('emailInput').value;
				var password = document.getElementById('passwordInput').value;
				var password2 = document.getElementById('password2Input').value;
				if (email == null || email == ""){
					document.getElementById('emailError').style.display = "block";
					document.getElementById('password1Error').style.display = "none";
					document.getElementById('password2Error').style.display = "none";
					return false;
				} else if (password == null || password == ""){
					document.getElementById('emailError').style.display = "none";
					document.getElementById('password1Error').style.display = "block";
					document.getElementById('password2Error').style.display = "none";
					return false;
				} else if (password2 != password){
					document.getElementById('emailError').style.display = "none";
					document.getElementById('password1Error').style.display = "none";
					document.getElementById('password2Error').style.display = "block";
					return false;
				}
			};
		</script>
	</body>
</html>