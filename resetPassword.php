<?php
		//connection to cloudsql on google app engine using host name is ':/cloudsql/tidy-bliss-523:atleta-fit' and password is ''
  $conn = mysql_connect('localhost', 'root', 'root');
  mysql_connect($conn);
  //select database
  mysql_select_db('atletafit_db');
  
  $email = trim(strtolower($_POST['email']));
  
  //select user id query
  $selectQuery = "SELECT user_id FROM users WHERE email='$email';";
  
  $queryResult = mysql_query($getUserId);
 if($queryResult){
	 $row = mysql_fetch_array($queryResult);
	 $user_id = $row['user_id'];
	 if ($user_id == NULL){
		 mysql_close($conn);
		 header('Location: password.php?error=1');
		 exit();
	 }
	 } else {
	 mysql_close($conn);
	 header('Location: password.php?error=1');
	 exit();
 }
 
  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

 
  $password = generateRandomString();
  
  $password = trim(strtolower($password));
  
  $cryptPassword = crypt($password, $email);
  
  //update user table to have new password
  $updateSQL = "UPDATE users SET password = '$newPassword' WHERE userId = '$user_id';";
  
  //create variable for email message
  $emailMessage = "We have reset your password to " . $password;
  
  
  //create variable for email subject
  $emailSubject = "New Password AtletaFit";
  
  //sql statement
  $check = mysql_query($updateSQL);
  if($check){
	  mail($email, $emailSubject, $emailMessage);
	  
  } else {
	  mysql_close($conn);
	  header('Location: password.php?error=2');
	  exit();
  }
  
    mysql_close($conn);
  header('Location: main.php');
  exit();


?>