<?php 
//Including constant.php for SITEURL
include('config/constants.php');
//en cas de deconnexion destruction de la session en cours
//1. Destroy the session 

//session_destroy();
unset($_SESSION['user']);

//2. Redirect to login page

header('location:'.SITEURL.'index.php');

?>