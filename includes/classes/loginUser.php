<?php

	require_once("FormSanitizer/FormSanitizer.php"); //Sanitizes the form before inserts
	require_once("../config/database.php"); //Contains all connections to database
	require_once("Constants.php"); //Contains all error outputs in a class.
	require_once("Account.php"); //Contains all register and Login Classes

		$username = FormSanitizer::sanitizeFormUsername($_POST['login_username']);
     	$password = FormSanitizer::sanitizeFormPassword($_POST['login_password']);

     	$account = new Account($conn); //Connects to account class

	    $wasSuccessful = $account->login($username, $password);

     if($wasSuccessful) {

     	  $_SESSION["userLoggedIn"] = $username;

          //$cookie_name = "user";
          //$cookie_value = $_SESSION["userLoggedIn"];
		  //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		  
		  
     	
     	

     	echo "You are logined in successful";

     }

?>