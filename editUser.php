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
  
  //get variables
  $password = trim(strtolower($_POST['newPassword1']));
  $monday = $_POST['monday'];
  $tuesday = $_POST['tuesday'];
  $wednesday = $_POST['wednesday'];
  $thursday = $_POST['thursday'];
  $friday = $_POST['friday'];
  $saturday = $_POST['saturday'];
  $sunday = $_POST['sunday'];
  
  //get email to encrypt password
  $emailSQL = "SELECT email FROM users WHERE user_id = '$user_id';";
  $emailResult = mysql_query($emailSQL);
  if($emailResult){
	  $row = mysql_fetch_array($emailResult);
	  $email = $row['email'];
  }
  
  
  if($password != NULL){
  	  $oldPassword = trim(strtolower($_POST['oldPassword']));
   	  $cryptOldPassword = crypt($oldPassword, $email);
  
  	  //check to make sure password is right
  	  $selectUser = "SELECT user_id FROM users WHERE email = '$email' AND password = '$cryptOldPassword';";
      $userResult = mysql_query($selectUser);
      if(mysql_num_rows($userResult) == 0){
	      header('Location: settings.php?error=1');
	      mysql_close($conn);
	      exit();
      }
      //crypt the new password
       $cryptPassword = crypt($password, $email);
       //update statement
       $updateSQL = "UPDATE users SET password='$cryptPassword', monday='$monday', tuesday='$tuesday', wednesday='$wednesday', thursday='$thursday', friday='$friday', saturday='$saturday', sunday='$sunday' WHERE user_id = '$user_id';";
       mysql_query($updateSQL);

  }
  
  header('Location:settings.php');
  mysql_close($conn);
  exit();
  
?>