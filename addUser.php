<?php
		//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  //get variables
  $email = trim(strtolower($_POST['email']));
  $password = trim(strtolower($_POST['password']));
  $cryptPassword = crypt($password, $email);
  
  if($email == NULL || $password == NULL){
  	header('Location: signUp.php?error=1');
  	mysql_close($conn);
  	exit();
  }
  
  $scale = $_POST['scale'];
  $monday = $_POST['monday'];
  $tuesday = $_POST['tuesday'];
  $wednesday = $_POST['wednesday'];
  $thursday = $_POST['thursday'];
  $friday = $_POST['friday'];
  $saturday = $_POST['saturday'];
  $sunday = $_POST['sunday'];
  
  //if day is null make it a rest day
  function nullOrRest($day){
	  if($day == NULL){
	  	$day = 'rest';
	  }
  }
  //run function on everyday of the week
  nullOrRest($monday);
  nullOrRest($tuesday);
  nullOrRest($wednesday);
  nullOrRest($thursday);
  nullOrRest($friday);
  nullOrRest($saturday);
  nullOrRest($sunday);
  
  //check if email already in use
  $selectEmailQuery = "SELECT user_id FROM users WHERE email ='$email';";
  $doubleEmail = mysql_query($selectEmailQuery);
  if(mysql_num_rows($doubleEmail) != 0){
	  header('Location: signUp.php?error=2');
	  mysql_close($conn);
	  exit();
  }
  
  //insert user into database
  $insertUser = "INSERT INTO users (email, password, total_workouts, monday, tuesday, wednesday, thursday, friday, saturday, sunday, kilo_lb) VALUES ('$email', '$cryptPassword', '1', '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday', '$scale');";
  
  mysql_query($insertUser) or die(mysql_error());
  
  //get user id to set cookie
  $selectQuery = "SELECT user_id FROM user WHERE email='$email' AND password = '$cryptPassword';";
  $user_idResult = mysql_query($selectQuery);
  if($user_idResult){
	  $row = mysql_fetch_array($user_idResult);
	  $user_id = $row['user_id'];
	  setcookie('user_id', $user_id);
  }
  
  //isnert user into groups table
  $insertUserIntoGroups = "INSERT INTO groups (group_id, user_id) VALUES ('1', '$user_id');";
  mysql_query($insertUserIntoGroups);
  
  
  
  //create all workouts table
  
  //table name
  $allWorkoutsTableName = $user_id . "_all_workouts";
  $createSQL = "CREATE TABLE $allWorkoutsTableName (exercise_name VARCHAR(50), set INT, rep INT, weight INT, rest_period INT, date VARCHAR(10));";
  
  mysql_query($createSQL);
  
  header('Location: profile.php');
  mysql_close($conn);
  exit();
  
?>