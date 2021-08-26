<?php

$name = "Monster";
$value = 30;
$expire = time() + (60 * 60 * 24 * 7);


setcookie($name, null, time() - 5000);


$name = $_COOKIE['test'];



echo "<pre>";
print_r($_COOKIE);
echo "</pre>";


