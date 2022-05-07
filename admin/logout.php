<?php
//include const.php for SITEURL
include('../config/const.php');

//1.Destroy the session
session_destroy();

//2.Redirect to login page
header('location:'.SITEURL.'admin/login.php');
?>