<?php

    $username       = $_POST['username'];
    $new_Password   = hash("sha512", $_POST['password']);

    require_once("../config/database.php");

    $query = $conn->prepare("UPDATE `users` SET `password` = '$new_Password' WHERE `users`.`username` = '$username'");
    $query->execute();

    if ($query)
    {
        echo "redirecting";
    }

?>