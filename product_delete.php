<?php
require "templates/db_connect.php";
$prod_id = $_GET['prod_id'];
$sql = "DELETE FROM products WHERE prod_id = $prod_id";
$result = $db->query($sql);
$sql = "DELETE FROM reviews WHERE prod_idFK = $prod_id";
$result = $db->query($sql);

mysqli_close($db);
$now = time();
header("Location: products.php?t=$now&confirm=deleted");

$confirm = $_GET['confirm'];

?>