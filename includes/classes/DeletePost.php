<?php

$post_id  = $_POST['post_id'];
require_once("../config/database.php");

//echo $post_id . " <br>" . $username;

$query = $conn->prepare("DELETE FROM `post` WHERE `post`.`post_id` = '$post_id'");
$query->execute();



?>