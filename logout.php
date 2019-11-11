<?php

session_start();
unset($_SESSION['userLoggedIn']);
session_destroy();
header("Location: index.php");

?>