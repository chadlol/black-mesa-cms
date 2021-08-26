<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <title>
        rainbows
    </title>
</head>
<body>

<?php
$red = 0;
$green = 0;
$blue = 0;

while ( $red <= 255 ){
    $red++;
    echo "<hr style='display: block; height: 1px;
    border: 0; border-top: 1px solid rgb($red,0,0);
    margin: 0; padding: 0;'>";
}

while ( $green <= 255 ){
    $green++;
    echo "<hr style='display: block; height: 1px;
    border: 0; border-top: 1px solid rgb(255,$green,0);
    margin: 0; padding: 0;'>";
}

while ( $blue <= 255 ){
    $blue++;
    echo "<hr style='display: block; height: 1px;
    border: 0; border-top: 1px solid rgb(255,255,$blue);
    margin: 0; padding: 0;'>";
}

?>



</body>
</html>

