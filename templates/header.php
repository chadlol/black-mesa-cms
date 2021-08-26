<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <title>
        <?php
        if (isset($title)) echo $title;
        else echo "Black Mesa Research Facility";
        ?>
    </title>
</head>
<body>

<header> <img src='images/head_text.png' alt="Black Mesa Reseach Facility"> </header>