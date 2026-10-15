<?php 

// conn ???

session_start();
require_once('../inc/functions.php');
//destroy or unset foe sesion userid_ name 

// if(!isset($_SESSION['user_id'])){
//    header("location:login.php");
// }
require_login();

// unset($_SESSION['user_id']);
// unset($_SESSION['name']);

session_destroy();

// redirect login 
session_start();
$_SESSION['success'] =  "user logout success";
header("location:login.php");
