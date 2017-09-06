<?php

		//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  $email = strtolower(trim($_GET['email']));
  
  $password = strtolower(trim($_GET['password']));
  
  $cryptPassword = crypt($password, $email);
  
  $query = "INSERT INTO users (email, password, total_workouts) VALUES ('$email', '$cryptPassword', '1');";

  mysql_query($query);


?>