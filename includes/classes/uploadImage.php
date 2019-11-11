<?php

require_once("../config/database.php"); //Contains all connections to database
require_once("Account.php"); //Contains all register and Login Classes

$username = $_POST['login_username'];
echo $hash_imageName;

$account = new Account($conn); //Connects to account class

$wasSuccessful = $account->uploadImage($username);

if (!$wasSuccessful)
{
    echo "Image Uploaded Successfully";
}
    else    
        echo "Something went wrong";


?>