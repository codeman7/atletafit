<?php
	//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  
  $array = array('monday' => 'Legs', 'tuesday' => 'Chest', 'wednesday' => 'Back', 'thursday' => 'Shoulders', 'friday' => 'Arms', 'saturday' => 'calves & abs');
  
  
  echo json_encode($array);
  
?>