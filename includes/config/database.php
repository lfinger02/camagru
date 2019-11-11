<?php
//error_reporting(0);error_reporting(E_ERROR | E_PARSE);
ob_start();
session_start();


date_default_timezone_set('Africa/Johannesburg'); //Setting Default timezone to the Af

DEFINE('DATABASE_CREDENTIALS', array(
    'camagru', 	 //Database_name
    'localhost', //Hosts_name
    'root', 	 // root_name /username
    '0733156355', 		 //password
));


// Catches any for errors when connecting to the database.
try {

 //Successfully connected to the Database
   $conn = new PDO("mysql:dbname=".DATABASE_CREDENTIALS[0].";host=".DATABASE_CREDENTIALS[1], DATABASE_CREDENTIALS[2], DATABASE_CREDENTIALS[3]);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
   


}
catch(PDOException $e) 
{
//If Code fails to connect to the Database echo this message
echo "Connection failded:" . $e;
}

?>