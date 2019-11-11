<?php

    $username = $_POST['username'];

    $cipher_method = 'aes-128-ctr';
    $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
    $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
    $crypted_token = openssl_encrypt($username, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
    unset($token, $cipher_method, $enc_key, $enc_iv);

    require_once("../config/database.php");

    $res = $conn->prepare("SELECT * FROM users WHERE username = '$username'");
    $res->execute();
    $num = $res->rowCount();

    

     if ($num == 0)
        {
            echo "<div class='link'>Username doesn't exisit on our database</div>";
        } else {
        
        $query_CheckUserEmail = $conn->prepare("SELECT * FROM `users` WHERE username = '$username'");
        $query_CheckUserEmail->execute();

        while ($check = $query_CheckUserEmail->fetch(PDO::FETCH_ASSOC)) {

            $email           = $check['email'];
            
            $msg = " Forgot Password Request!

            Reset Your Password Here!
            <a href=\"http://127.0.0.1:8080/camagru/forgotPassword.php?reset=$crypted_token\"> Click Here</a>
                        
	                    ";
	
		  $msg = wordwrap($msg,1000);
          mail("$email","Forgot Passowrd",$msg);

          echo "<div class='link'>A link to change your password has been sent to your email.</div>";

        }
    }

?>