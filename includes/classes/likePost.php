<?php

    $post_id  = $_POST['post_id'];
    $username = $_POST['username'];
    require_once("../config/database.php");

    //echo $post_id . " <br>" . $username;

    $query = $conn->prepare("SELECT * FROM `likes` WHERE post_id='$post_id' AND liked_by='$username'");
    $query->execute();
    if($query->rowCount() >= 1) {
        echo "Liked Before";
        //DELETE FROM `likes` WHERE `likes`.`id` = 1;

        $query = $conn->prepare("DELETE FROM `likes` WHERE `likes`.`post_id`='$post_id'");
        $query->execute();

    }   else {
       
        $query = $conn->prepare("INSERT INTO `likes` (`post_id`, `liked_by`) VALUES ('$post_id', '$username')");
        $query->execute();
        echo "Post Liked";
    }


?>