<?php

    require_once("FormSanitizer/FormSanitizer.php");
    
    $post_id  = $_POST['post_id'];
    $username = $_POST['username'];
    $message  = FormSanitizer::sanitizeComment($_POST['message']);

    require_once("../config/database.php");

    $query = $conn->prepare("INSERT INTO `comments` (`post_id`, `comment`, `comment_by`) VALUES ('$post_id', '$message', '$username')");
    $query->execute();

    $query_notify = $conn->prepare("SELECT * FROM `post` WHERE post_id = '$post_id'");
    $query_notify->execute();

    while ($who = $query_notify->fetch(PDO::FETCH_ASSOC)) {
            $username_who = $who['upload_by'];

        $query_CheckUserEmail = $conn->prepare("SELECT * FROM `users` WHERE username = '$username_who'");
        $query_CheckUserEmail->execute();

        while ($check = $query_CheckUserEmail->fetch(PDO::FETCH_ASSOC)) {

            $email           = $check['email'];
            $mail_preference = $check['mail_preference'];

            if ($mail_preference == "Yes"){
                $msg = " $username commented on your post :

                        $message
                        
	                    ";
	
		  $msg = wordwrap($msg,1000);
          mail("$email","Comment",$msg);
          
          
            }

        }

    }


    if ($query)
        {
            $query_fetchComment = $conn->prepare("SELECT * FROM `comments` WHERE post_id='$post_id' ORDER BY post_id DESC");
            $query_fetchComment ->execute();
    
            
            while ($results = $query_fetchComment->fetch(PDO::FETCH_ASSOC)) {
                $comment    = $results['comment'];
                $comment_by = $results['comment_by'];
    
                echo "<div class='comment_fromUsers'>
                <span class='usernameofcommenter'>$comment_by</span>  
                $comment
                </div>";
            }
        }
        else {
            echo "Failed to send";
        }


?>