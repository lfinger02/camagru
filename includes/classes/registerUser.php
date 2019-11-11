<?php

/*
	including all the dependencies that we need in the program.
*/

require_once("FormSanitizer/FormSanitizer.php"); //Sanitizes the form before inserts
require_once("../config/database.php"); //Contains all connections to database
require_once("Constants.php"); //Contains all error outputs in a class.
require_once("Account.php"); //Contains all register and Login Classes


/*
	Sanitizing all the inputs from the user in order words ensuring that user
	does not insert funny stuff :) in the form. ErrorHandling.
*/

$regName = FormSanitizer::sanitizeFormString($_POST["regName"]);
$regEmail = FormSanitizer::sanitizeFormString($_POST["regEmail"]);
$regUsername = FormSanitizer::sanitizeFormEmail($_POST["regUsername"]);
$regPassword = FormSanitizer::sanitizeFormUsername($_POST["regPassword"]);
$regRepassword = FormSanitizer::sanitizeFormPassword($_POST["regRepassword"]);


/*
 	initializing the variable account to a new object called Account which is our class that we created
 	in the directory ./Account.php this class all functions that allow us to register the user.
*/

$account = new Account($conn); //Connects to account class

/*
		initializing $wasSuccessful to the function called regsiter inside the Account class.
		This regsiter function takes 7 arguments and excutes the prepare statement or query to insert
		passed parameters into the database.

		if the query was excuted successfully we
		  - Hide the show_3 class
		  - Hide Welcome class header
		  - Set an Interval of 5 seconds when that 5 seconds ends
		     - Show the exam-login model
		     - Hide the exam-signup model

		Then echo style success message to user

		else Notify the user that he/she was not successfully registered.
*/

$wasSuccessful = $account->register($regName, $regEmail, $regUsername, $regPassword, $regRepassword);



if ($wasSuccessful) {

    //$_SESSION["userLoggedIn"] = $username;
    //header("Location: main.php");

    //echo this when insert to the database was successful

    /*echo " <script>

        $('.show_3').hide()
    $('.welcome').hide();

    setInterval(function() {
        $('#exam-login').modal('show');
        $('#exam-signup').modal('hide');

    }, 5000);

    </script>";*/

	echo "<div class='successful_register'>You were registered successfully <b>Please login</b></div>";
	
  $cipher_method = 'aes-128-ctr';
  $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
  $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
  $crypted_token = openssl_encrypt($regUsername, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
  unset($token, $cipher_method, $enc_key, $enc_iv);

	
	
	$msg = "
	
	Verify your email address!
	
	Dear $regName, 
	
	Thank you for using BubbleShare! If you haven't done so already, please confirm that
	you want to use this address in your BubbleShare Account. Once you verifyied you can begin to share photos. <br>

	Username : $regUsername

	http://127.0.0.1:8080/camagru/verify.php?token=$crypted_token
	
	";
	
		  $msg = wordwrap($msg,1000);
		  mail("lfinger33@gmail.com","Verify",$msg);

} else {
    echo "<div class='error_registerMessage registerPrevent'>You were not registered</div>";
}



?>