<?php
require "templates/db_connect.php";
$news_id = $_GET['news_id'];
$sql = "DELETE FROM articles WHERE news_id = $news_id";
$result = $db->query($sql);
mysqli_close($db);
$now = time();
header("Location: articles.php?t=$now&confirm=deleted");

$confirm = $_GET['confirm'];

?>