<?php
  $title = "Manage Newsletters";
  require "templates/header.php";
  require "templates/navigation.php";
  require "templates/db_connect.php";
  $confirm = $_GET['confirm'];
?>

  <section id='main'>
    <?php
      if ($_SESSION['name']) {

        $sql = 'SELECT * FROM newsletter';
        $result = $db->query($sql);
        if ($db->error) {
          $message = $db->error;
        }

        echo "
        <article id='main_1'>
        <h2>Manage Subscriptions</h2>
        <a href='newsletter_add.php'>Add Subscription</a>
        <table id='articles'>
        <tr>
        <td>First</td>
        <td>Last</td>
        <td>Email</td>
        <td>Newsletter</td>
        <td>Notify</td>
        </tr>";




        while(list($f_name,$l_name,$email,$newsletter,$notify,$sub_id)=$result->fetch_row()){
          echo "<tr>
                      <td>$sub_id</td>
                      <td>$f_name</td>
                      <td>$l_name</a></td>
                      <td>$email</td>
                      <td>$newsletter</td>
                      <td>$notify</td>
                      <td><a href='newsletter_delete.php?sub_id=$sub_id'>Delete Subscription</a></td>
            </tr>
";
        }

        echo "</table>";

        if ( $confirm == "deleted" ){
          $confirm = "Subscription successfully deleted";
        }
        else {
          $confirm = "";
        }

        echo "<h4>$confirm</h4>";

        echo    "</article>";


      }
      else {
        echo "<p>You're not allowed to be here...</p>";
      }

    ?>

  </section>
<?php require "templates/footer.php"; ?>