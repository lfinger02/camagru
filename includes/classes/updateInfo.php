<?php

    $old_Username     = $_POST['previousUsername'];
    $new_Username     = $_POST['username'];
    $new_Email        = $_POST['email'];
    $new_Password     = hash("sha512", $_POST['password']);
    $mail_preference  = $_POST['mail_preference'];

    


    if ($mail_preference == 'true') {
        $mail_preference = "Yes";
    } else if ($mail_preference == 'false') {
        $mail_preference = "No";
    }

   

    require_once("../config/database.php");

    if ($old_Username != $new_Username) {
        
        $res = $conn->prepare("SELECT * FROM users WHERE username = '$new_Username'");
        $res->execute();
        $num = $res->rowCount();

        if ($num != 0)
        {
            echo "<div class='updated_Notsuccessfully'>Username already Taken</div>";
        } else {
            $query = $conn->prepare("UPDATE `users` SET `username` = '$new_Username', `email` = '$new_Email', `password` = '$new_Password', `mail_preference` = '$mail_preference' WHERE `users`.`username` = '$old_Username'");
            $query->execute();

            if ($query)
            {
                echo "<div class='updated_successfully'>Updated</div>";
            }
        }
        
    } else {
        $query = $conn->prepare("UPDATE `users` SET `username` = '$new_Username', `email` = '$new_Email', `password` = '$new_Password', `mail_preference` = '$mail_preference' WHERE `users`.`username` = '$old_Username'");
            $query->execute();

            if ($query)
            {
                echo "<div class='updated_successfully'>Updated</div>";
        }
    }

    

?>