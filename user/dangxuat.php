<?php
include("../includes/definition.php");
if(!isset($_SESSION)) session_start(); 

if (isset($_SESSION['login'])) {
  session_unset();
  session_destroy(); 
  header("location:".BASE_URL."/index.php");
} else {
  header("location:index.php");
} 
