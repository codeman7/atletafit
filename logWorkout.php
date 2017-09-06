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
  
  //get array of sets as string
  $setsAndExerciseCount = $_POST['setsAndReps'];
  
  //place array into php array
  $myArray = explode(',', $setsAndExerciseCount);
  //myArray length
  $myArrayLength = count($myArray);
  
  //get date
  $date = date("m-d-Y");
  
  //workout table name
  $workoutTableName = "workout_" . $user_id . "_" . $date;
  
  // all workouts table
  $user_id . "_all_workouts";
  
  //create table
  $createTableSQL = "CREATE TABLE $workoutTableName (setCount INT PRIMARY KEY AUTO_INCREMENT, exercise_name VARCHAR(50), set INT, reps INT, weight INT, rest_period INT, workout_number);";
  
    //check for workout number and table already there
	//select statement
	$selectSQL = "SELECT 1 FROM $workoutTableName";
	$checkTable = mysql_query($selectSQL);
	if($checkTable !== FALSE){
		//table exist
		//get workout number for that day
		$getWorkoutNumber = "SELECT workout_number FROM $workoutTableName ORDER BY setCount DESC LIMIT 1";
		$workoutNumberResult = mysql_query($getWorkoutNumber);
		if($workoutNumberResult){
			$row = mysql_fetch_array($workoutNumberResult);
			$workoutNumber = $row['workout_number'];
			$workout_number++;
			
			  //loop threw the length of the array which is the number of exercises
			  for ($x = 1; $x <= $myArrayLength; $x++){
  		
				  //exercise name variable
  				$exerciseName = $_REQUEST['exercise' . $x . 'Set1Name'];
  		
  				//loop threw array number of sets each exercise
  				for ($y = 1; $y <= $myArray[$x - 1]; $y++){
	  	
	  				//reps variables
	  			$reps = $_REQUEST['exercise' . $x . 'Set' . $y . 'Reps'];
	  			if(!is_int($reps)){
		  			$reps = '0';
	  			}
	  			
	  			//rest variables
	  			$rest = $_REQUEST['exercise' . $x . 'Set' . $y . 'Rest'];
		
	  			//weight varibles
	  			$weight = $_REQUEST['exercise' . $x . 'Set' . $y . 'Weight'];
		 
	  			//sets variable
	  			$sets = $y;
		
	  			// MySQL insert statement which runs however many times the loop runs
	  			$insertWorkoutStatement = "INSERT INTO $workoutTableName (exercise_name, set, reps, weight, rest_period, workout_number) VALUES ('{$exerciseName}', '{$sets}', '{$reps}', '{$weight}', '{$rest}', '{$workout_number}');";
		
	  			//MySQL query for insert into workout table
	  			mysql_query($insertWorkoutStatement);
		 
		 
		 
	  			// MySQL insert statement which runs however many times the loop runs
	  			$insertAllWorkouts = "INSERT INTO $allWorkoutsTableName (exercise_name, set, reps, weight, rest_period, date) VALUES ('{$exerciseName}', '{$sets}', '{$reps}', '{$weight}', '{$rest}', '{$date}');";
		
	  			//MySQL query for insert into userId_all_workouts 
	  			mysql_query($insertAllWorkouts);
		
		
	  			}
	 
	  		}
			
		}
		
	} else{
		  mysql_query($createTableSQL);
		  
		  //loop threw the length of the array which is the number of exercises
			  for ($x = 1; $x <= $myArrayLength; $x++){
  		
				  //exercise name variable
  				$exerciseName = $_REQUEST['exercise' . $x . 'Set1Name'];
  		
  				//loop threw array number of sets each exercise
  				for ($y = 1; $y <= $myArray[$x - 1]; $y++){
	  	
	  				//reps variables
	  			$reps = $_REQUEST['exercise' . $x . 'Set' . $y . 'Reps'];
	  			if(!is_int($reps)){
		  			$reps = '0';
	  			}
		
	  			//rest variables
	  			$rest = $_REQUEST['exercise' . $x . 'Set' . $y . 'Rest'];
		
	  			//weight varibles
	  			$weight = $_REQUEST['exercise' . $x . 'Set' . $y . 'Weight'];
		 
	  			//sets variable
	  			$sets = $y;
		
	  			// MySQL insert statement which runs however many times the loop runs
	  			$insertWorkoutStatement = "INSERT INTO $workoutTableName (exercise_name, set, reps, weight, rest_period, workout_number) VALUES ('{$exerciseName}', '{$sets}', '{$reps}', '{$weight}', '{$rest}', '1');";
		
	  			//MySQL query for insert into workout table
	  			mysql_query($insertWorkoutStatement);
		 
		 
		 
	  			// MySQL insert statement which runs however many times the loop runs
	  			$insertAllWorkouts = "INSERT INTO $allWorkoutsTableName (exercise_name, set, reps, weight, rest_period, date) VALUES ('{$exerciseName}', '{$sets}', '{$reps}', '{$weight}', '{$rest}', '{$date}');";
		
	  			//MySQL query for insert into userId_all_workouts 
	  			mysql_query($insertAllWorkouts);
		
		
	  			}
	 
	  		}

	}
  
  
  
?>