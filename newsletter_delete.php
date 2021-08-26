<?php
  require "templates/db_connect.php";
  $sub_id = $_GET['sub_id'];
  $sql = "DELETE FROM newsletter WHERE sub_id = $sub_id";
  $result = $db->query($sql);
  mysqli_close($db);
  $now = time();
  header("Location: newsletters_manage.php?t=$now&confirm=deleted");

  $confirm = $_GET['confirm'];

?>