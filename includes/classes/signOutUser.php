<?php

session_start();
unset($_SESSION['userLoggedIn']);
session_destroy();
unset($_COOKIE['user']);
setcookie("user", "", time() -3600, "/");

echo "Out";

?>