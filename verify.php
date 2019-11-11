<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="css/style.css">

    <title>BubbleShare</title>
  </head>
  <body>

<?php

    $crypted_token = $_GET['token'];

    include_once("includes/config/database.php");

    list($crypted_token, $enc_iv) = explode("::", $crypted_token);;
    $cipher_method = 'aes-128-ctr';
    $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
    $token = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
    unset($crypted_token, $cipher_method, $enc_key, $enc_iv);

    $verifyUser = $conn->prepare("SELECT * FROM users WHERE username = '$token'");
    $verifyUser->execute();
    $num = $verifyUser->rowCount();

    if ($num == 1)
        {
           
            $checkIfUserIsVerifyied = $conn->prepare("SELECT * FROM users WHERE username = '$token' AND verified = 'No'");
            $checkIfUserIsVerifyied->execute();
            $num2 = $checkIfUserIsVerifyied->rowCount();

            if ($num2 == 1)
            {
                
                $verifyUser = $conn->prepare("UPDATE `users` SET `verified` = 'Yes' WHERE `users`.`username` = '$token'");
                $verifyUser->execute();

                if ($verifyUser){
                    echo "<div class='Verify'>Account has now been verified</div>";
                }

            }
            else {
                echo "<div class='Verify'>Already verified</div>";
                echo "<a class='loginUser' href='index.php'>Login</a>";
            }

        }
        else {
            echo "<div class='Verify'>Access denied</div>";
            header("Location: index.php");
            die();
        }

?>

    </body>
    </html>