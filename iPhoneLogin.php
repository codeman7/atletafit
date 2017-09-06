<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  $email = strtolower(trim($_GET['email']));
  $password = strtolower(trim($_GET['password']));
  
  $cryptPassword = crypt($password, $email);
  
  date_default_timezone_set('America/Los_Angeles');
  $dayOfWeek = date('D');
  if ($dayOfWeek == 'Mon'){
	  $day = 'monday';
  } else if($dayOfWeek == 'Tue'){
	  $day = 'tuesday';
  } else if ($dayOfWeek == 'Wed'){
	  $day = 'wednesday';
  } else if ($dayOfWeek == 'Thu'){
	  $day = 'thursday';
  } else if ($dayOfWeek == 'Fri'){
	  $day = 'friday';
  } else if ($dayOfWeek == 'Sat'){
	  $day = 'saturday';
  } else if ($dayOfWeek == 'Sun'){
	  $day = 'sunday';
  }
  
  
  //select query
  $selectSQL = "SELECT user_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM users WHERE email = '$email' AND password = '$password';";
  
  $resultQuery = mysql_query($selectSQL);
  if($resultQuery){
	  $row = mysql_fetch_array($resultQuery);
	  $user_id = $row['user_id'];
	  $monday = $row['monday'];
	  $tuesday = $row['tuesday'];
	  $wednesday = $row['wednesday'];
	  $thursday = $row['thursday'];
	  $friday = $row['friday'];
	  $saturday = $row['saturday'];
	  $sunday = $row['sunday'];
	  $dayResult = $row[$day];
	  $array = array('user_id' => $user_id, 
	  				 'monday' => $monday, 
	  				 'tuesday' => $tuesday, 
	  				 'wednesday' => $wednesday, 
	  				 'thursday' => $thursday, 
	  				 'friday' => $friday, 
	  				 'saturday' => $saturday, 
	  				 'sunday' => $sunday,
	  				 'today' => $dayResult);
	  echo json_encode($array);
  }




?>