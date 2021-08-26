<?php
session_start();
$_SESSION['name'] = null;
$_POST['logged'] = false;
header("Location: index.php");
?>