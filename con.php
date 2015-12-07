<?php
session_start();
$_SESSION['username'] = $_POST['username'];
$_SESSION['ps'] = $_POST['password'];
die("success");
?>
