<?php

session_start();
$_SESSION['name'] = "Monster";

$name = $_SESSION['name'];

echo $name;

$_SESSION['name'] = null;

print_r($_SESSION);